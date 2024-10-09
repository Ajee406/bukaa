<?php

namespace App\Http\Services\Payment;

use Illuminate\Support\Facades\Log;
use Stripe\StripeClient;

class StripeService extends BasePaymentService
{
    public  $stripClient;

    public function __construct($method, $object)
    {
        parent::__construct($method, $object);
        $this->stripClient = new StripeClient($this->gateway->key);
    }

    public function makePayment($amount)
    {
        $this->setAmount($amount);
        $data['success'] = false;
        $data['redirect_url'] = '';
        $data['payment_id'] = '';
        $data['message'] = SOMETHING_WENT_WRONG;

        $payment = $this->stripClient->checkout->sessions->create([
            'success_url' => $this->callbackUrl,
            'cancel_url' => $this->callbackUrl,
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => $this->currency,
                        'product_data' => [
                            'name' => 'Amount',
                        ],
                        'unit_amount' => $this->amount * 100,
                    ],
                    'quantity' => 1,
                ]
            ],
            'mode' => 'payment',
        ]);

        try {
            Log::info(json_encode($payment));
            if ($payment->status == 'open') {
                $data['payment_id'] = $payment->id;
                $data['success'] = true;
                $data['redirect_url'] = $payment->url;
            }

            return $data;
        } catch (\Exception $ex) {
            $data['message'] = $ex->getMessage();
        }
        return $data;
    }

    public function paymentConfirmation($payment_id)
    {
        $data['data'] = null;
        Log::info("------payment----");
        Log::info($payment_id);
        $payment = $this->stripClient->checkout->sessions->retrieve($payment_id, []);
        Log::info(json_encode($payment));
        if ($payment->payment_status == 'paid') {
            $data['success'] = true;
            $data['data']['amount'] = $payment->amount_total / 100;
            $data['data']['currency'] = $payment->currency;
            $data['data']['payment_status'] =  'success';
            $data['data']['payment_method'] = STRIPE;
        } else {
            $data['success'] = false;
            $data['data']['amount'] = $payment->amount_total /100;
            $data['data']['currency'] = $payment->currency;
            $data['data']['payment_status'] =  'unpaid';
            $data['data']['payment_method'] = STRIPE;
        }

        return $data;
    }
}
