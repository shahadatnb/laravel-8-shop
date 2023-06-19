<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Auth;
use Password;

class CustomerResetPasswordController extends Controller
{
    use ResetsPasswords;
    protected $redirectTo = '/customer';

    protected function broker()
    {
        return Password::broker('customers');
    }

    protected function guard()
    {
        return Auth::guard('customer');
    }

    public function __construct()
    {
    //$this->middleware('customer');
    }

    public function showResetForm(Request $request, $token = null)
    {   
        return view('auth.customer.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }
}
