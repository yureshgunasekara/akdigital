<?php

namespace App\Http\Controllers\Gateways;

use App\Http\Controllers\Controller;
use App\Models\PaymentGateway;
use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use App\Models\User;
use Illuminate\Http\Request;

class StripeController extends Controller
{
    // Stripe payment 
    public function payment(Request $request)
    {
        $billing_type = $request->billing_type;
        $stripe = PaymentGateway::where('name', 'stripe')->first();
        $plan = SubscriptionPlan::where('id', $request->plan_id)->first();
        $price = $billing_type == 'monthly' ? $plan->monthly_price :  $plan->yearly_price;

        \Stripe\Stripe::setApiKey($stripe->secret);
        $response = \Stripe\Checkout\Session::create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => strtolower($plan->currency),
                        'product_data' => [
                            'name' => $plan->title,
                        ],
                        'unit_amount' => $price * 100,
                    ],
                    'quantity' => 1,
                ]
            ],
            'mode' => 'payment',
            'success_url' => route('stripe.success'),
            'cancel_url' => route('stripe.cancel'),
        ]);

        session()->put('plan_id', $plan->id);
        session()->put('stripe_id', $response->id);
        session()->put('billing_type', $billing_type);
        
        return redirect()->away($response->url);
    }


    // Stripe payment success
    public function success(Request $request)
    {
        try {
            $user = User::where('id', auth()->user()->id)->first();
            $stripe = PaymentGateway::where('name', 'stripe')->first();
            $plan_id = session()->get('plan_id');
            $plan = SubscriptionPlan::where('id', $plan_id)->first();
            $stripe_id = session()->get('stripe_id');
            $billing_type = session()->get('billing_type');

            \Stripe\Stripe::setApiKey($stripe->secret);
            $order = \Stripe\Checkout\Session::retrieve($stripe_id);
            $nextPayment = $billing_type == 'monthly' ? date('Y-m-d', strtotime('+1 month')) : date('Y-m-d', strtotime('+1 year'));

            $subscription = Subscription::create([
                'user_id' => $user->id,
                'method' => 'stripe',
                'billing' => $billing_type,
                'transaction_id' => $order->payment_intent,
                'subscription_plan_id' => $plan->id,
                'total_price' => $order->amount_total / 100,
                'currency' => $plan->currency,
            ]);

            $user->next_payment = $nextPayment;
            $user->subscription_id = $subscription->id;
            $user->subscription_plan_id = $plan->id;
            $user->recurring = $billing_type;
            $user->save();
            
            return redirect()->route('plans.current')->with('success', 'Congratulation! Your payment have completed');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('plans.select')->with('error', $th->getMessage());
        }
    }


    // Stripe payment cancel
    public function cancel()
    {
        return redirect()->route('plans.select')->with('error', 'Your payment have failed, please try again later.');
    }
}
