<?php

namespace App\Http\Controllers\Gateways;

use App\Http\Controllers\Controller;
use App\Models\PaymentGateway;
use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use App\Models\User;
use Illuminate\Http\Request;
use Razorpay\Api\Api;

class RazorpayController extends Controller
{
    public function show_form(Request $request)
    {
        $billing_type = $request->billing_type;
        $plan = SubscriptionPlan::where('id', $request->plan_id)->first();
        $price = $billing_type == 'monthly' ? $plan->monthly_price :  $plan->yearly_price;
        $razorpay = PaymentGateway::where('name', 'razorpay')->first();

        return view('pages.gateways.razorpay-form', compact('plan', 'price', 'billing_type', 'razorpay'));
    }


    public function payment(Request $request)
    {
        try {
            $billing_type = $request->billing_type;
            $user = User::where('id', auth()->user()->id)->first();
            $razorpay = PaymentGateway::where('name', 'razorpay')->first();
            $plan = SubscriptionPlan::where('id', $request->plan_id)->first();
            $nextPayment = $billing_type == 'monthly' ? date('Y-m-d', strtotime('+1 month')) : date('Y-m-d', strtotime('+1 year'));

            $api = new Api($razorpay->key, $razorpay->secret);
            $payment = $api->payment->fetch($request->razorpay_payment_id);

            if ($request->has('razorpay_payment_id') && $request->filled('razorpay_payment_id')) {
                $order = $api->payment->fetch($request->razorpay_payment_id)->capture(['amount' => $payment['amount']]);

                $subscription = Subscription::create([
                    'user_id' => $user->id,
                    'method' => 'stripe',
                    'billing' => $billing_type,
                    'transaction_id' => $order->id,
                    'subscription_plan_id' => $plan->id,
                    'total_price' => $order->amount / 100,
                    'currency' => $plan->currency,
                ]);
    
                $user->next_payment = $nextPayment;
                $user->subscription_id = $subscription->id;
                $user->subscription_plan_id = $plan->id;
                $user->recurring = $billing_type;
                $user->save();

                return redirect()->route('plans.current')->with('success', 'Congratulation! Your payment have completed');
            } else {
                return redirect()->route('plans.select')->with('error', 'Your payment have failed, please try again later.');
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('plans.select')->with('error', $th->getMessage());
        }
    }
}
