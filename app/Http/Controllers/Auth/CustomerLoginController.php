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

    
    public function loginStep2(Request $request){
        if ($request->isMethod('GET')) {
            //Session::flash('success','Successfully Save');
            return view('auth.customer.login');
        }
        if ($request->isMethod('POST')) {
            $this->validate($request, array(
                'email'=>'required|email|max:255|exists:customers,email',
            ));
            $email = $request->email;
            return view('auth.customer.loginStep2',compact('email'));
        }
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
