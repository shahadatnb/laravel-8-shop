<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Customer;
use Auth;

class CustomerLoginController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = '/customer';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:customer')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.customer.login');
    }


    public function username()
    {
        return 'email';
    }
    protected function guard()
    {
        return Auth::guard('customer');
    }
}
