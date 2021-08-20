<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PayPalController extends Controller
{
    public function payment()
    {
        /*
        $data = [];
        $data['items'] = [
            [
                'name' => 'codechief.org',
                'price' => 100,
                'desc'  => 'Description goes herem',
                'qty' => 1
            ]
        ];

        $data['invoice_id'] = 1;
        $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
        $data['return_url'] = route('payment.success');
        $data['cancel_url'] = route('payment.cancel');
        $data['total'] = 100;

        $provider = new PayPalClient;
        $provider->setCurrency('USD');

        $provider->createOrder([
            "intent"=> "CAPTURE",
            "purchase_units"=> [
                0 => [
                    "amount"=> [
                        "currency_code"=> "USD",
                        "value"=> "100.00"
                    ]
                ]
            ]
        ]);

        $provider->capturePaymentOrder(1);

        //$products = $provider->listProducts();
        $data =  json_decode('{
              "name": "Video Streaming Service",
              "description": "Video streaming service",
              "type": "SERVICE",
              "category": "SOFTWARE",
              "image_url": "https://example.com/streaming.jpg",
              "home_url": "https://example.com/home"
            }', true);

        //$product = $provider->createProduct($data);

        //$response = $provider->setExpressCheckout($data);

        //$response = $provider->setExpressCheckout($data, true);

        return redirect($response['paypal_link']);
        */

    }

    public function cancel()
    {
        dd('Sorry you payment is canceled');
    }

    public function success(Request $request)
    {
        $response = $provider->getExpressCheckoutDetails($request->token);

        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            dd('Your payment was successful. You can create success page here.');
        }

        dd('Something is wrong.');
    }
}
