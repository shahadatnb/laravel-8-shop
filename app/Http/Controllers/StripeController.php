<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Stripe;

class StripeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function makePayment(Request $request)
    {
        Stripe\Stripe::setApiKey(config('services.stripe.secret'));
        Stripe\Charge::create ([
            "amount" => 120 * 100,
            "currency" => "USD",
            "source" => $request->stripeToken,
            "description" => "Make payment and chill."
        ]);

        Session::flash('success', 'Payment successfully made.');

        return back();
    }
}
