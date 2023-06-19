<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Password;

class CustomerForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    protected function broker()
    {
        return Password::broker('customers');
    }

    public function showLinkRequestForm()
    {   
        return view('auth.customer.passwords.email');
    }
}
