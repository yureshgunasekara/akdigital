<?php

namespace App\Http\Controllers\Gateways;

use App\Http\Controllers\Controller;
use App\Models\PaymentGateway;
use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use App\Models\User;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;


class PaypalController extends Controller
{
    public function paypal_config()
    {
        $paypal = PaymentGateway::where('name', 'paypal')->first();
    
        config(['paypal.mode' => 'live']); // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
        config(['paypal.sandbox.client_id' => $paypal->key]);
        config(['paypal.sandbox.client_secret' => $paypal->secret]);
        config(['paypal.live.client_id' => $paypal->key]);
        config(['paypal.live.client_secret' => $paypal->secret]);

        $config = [
            'mode'    => 'live', // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
            'sandbox' => [
                'client_id'     => $paypal->key,
                'client_secret' => $paypal->secret,
                'app_id'        => 'APP-80W284485P519543T',
            ],
            'live' => [
                'client_id'     => $paypal->key,
                'client_secret' => $paypal->secret,
                'app_id'        => '',
            ],
            'payment_action' => 'Sale', // Can only be 'Sale', 'Authorization' or 'Order'
            'currency'       => 'USD',
            'notify_url'     => '', // Change this accordingly for your application.
            'locale'         => 'en_US', // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
            'validate_ssl'   => true, // Validate SSL when creating api client.
        ];

        return $config;
    }


    // Paypal payment 
    public function payment(Request $request)
    {
        $billing_type = $request->billing_type;
        $plan = SubscriptionPlan::where('id', $request->plan_id)->first();
        $price = $billing_type == 'monthly' ? $plan->monthly_price :  $plan->yearly_price;
        $config = $this->paypal_config();

        $provider = new PayPalClient;
        $provider->setApiCredentials($config);
        $accessToken = $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('paypal.success'),
                "cancel_url" => route('paypal.cancel'),
            ],
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => strtolower($plan->currency),
                        "value" => $price
                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {
            session()->put('plan_id', $plan->id);
            session()->put('billing_type', $billing_type);

            foreach ($response['links'] as $link) {
                if ($link['rel'] == 'approve') {
                    return redirect()->away($link['href']);
                }
            }
        } else {
            return redirect()->route('paypal.cancel');
        }
    }


    // Paypal payment success
    public function success(Request $request)
    {
        try {
            $user = User::where('id', auth()->user()->id)->first();
            $plan_id = session()->get('plan_id');
            $plan = SubscriptionPlan::where('id', $plan_id)->first();
            $billing_type = session()->get('billing_type');
            $nextPayment = $billing_type == 'monthly' ? date('Y-m-d', strtotime('+1 month')) : date('Y-m-d', strtotime('+1 year'));
            $config = $this->paypal_config();

            $provider = new PayPalClient;
            $provider->setApiCredentials($config);
            $accessToken = $provider->getAccessToken();
            $response = $provider->capturePaymentOrder($request->token);

            if (isset($response['status']) && $response['status'] == 'COMPLETED') {
                $subscription = Subscription::create([
                    'user_id' => $user->id,
                    'method' => 'stripe',
                    'billing' => $billing_type,
                    'transaction_id' => $response['id'],
                    'subscription_plan_id' => $plan->id,
                    'total_price' => $response['purchase_units'][0]['payments']['captures'][0]['amount']['value'],
                    'currency' => 'ZAR',
                ]);
    
                $user->next_payment = $nextPayment;
                $user->subscription_id = $subscription->id;
                $user->subscription_plan_id = $plan->id;
                $user->recurring = $billing_type;
                $user->save();

                return redirect()->route('plans.current')->with('success', 'Congratulation! Your payment have completed');
            } else {
                return redirect()->route('paypal.cancel');
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('plans.select')->with('error', $th->getMessage());
        }
    }


    // Paypal payment cancel
    public function cancel()
    {
        return redirect()->route('plans.select')->with('error', 'Your payment have failed, please try again later.');
    }
}
