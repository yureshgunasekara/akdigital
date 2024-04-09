<?php

namespace App\Http\Controllers\Gateways;

use App\Http\Controllers\Controller;
use App\Models\PaymentGateway;
use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaystackController extends Controller
{
    public function paystack_redirect(Request $request)
    {
        $user = auth()->user();
        $billing_type = $request->billing_type;
        $plan = SubscriptionPlan::where('id', $request->plan_id)->first();
        $price = $billing_type == 'monthly' ? $plan->monthly_price :  $plan->yearly_price;
        $paystack = PaymentGateway::where('name', 'paystack')->first();

        session()->put('plan_id', $plan->id);
        session()->put('billing_type', $billing_type);

        return view('pages.gateways.paystack-redirect', compact('user', 'plan', 'price', 'paystack'));
    }


    public function verify_transaction(Request $request)
    {
        try {
            $user = User::where('id', auth()->user()->id)->first();
            $paystack = PaymentGateway::where('name', 'paystack')->first();
            $plan_id = session()->get('plan_id');
            $plan = SubscriptionPlan::where('id', $plan_id)->first();
            $billing_type = session()->get('billing_type');
            $nextPayment = $billing_type == 'monthly' ? date('Y-m-d', strtotime('+1 month')) : date('Y-m-d', strtotime('+1 year'));

            $reference = $request->reference;
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.$paystack->secret
            ])->get("https://api.paystack.co/transaction/verify/$reference");

            $payment = json_decode($response);

            if($payment->status == true){
                $subscription = Subscription::create([
                    'user_id' => $user->id,
                    'method' => 'stripe',
                    'billing' => $billing_type,
                    'transaction_id' => $payment->data->id,
                    'subscription_plan_id' => $plan->id,
                    'total_price' => $payment->data->amount / 100,
                    'currency' => 'ZAR',
                ]);
    
                $user->next_payment = $nextPayment;
                $user->subscription_id = $subscription->id;
                $user->subscription_plan_id = $plan->id;
                $user->recurring = $billing_type;
                $user->save();

                return redirect()->route('plans.current')->with('success', 'Congratulation! Your payment have completed');
            }else{
                return redirect()->route('paypal.select')->with('error', 'Your payment have failed, please try again later.');
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('plans.select')->with('error', $th->getMessage());
        }
    }
}
