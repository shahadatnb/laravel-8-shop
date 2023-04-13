<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
//use App\Models\CustomerAddress;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;
use App\Mail\CustomerRegister;
use App\Http\Traits\userTrait;
use Session;
use Auth;

class CustomerRegisterController extends Controller
{
    use userTrait;

    public function showRegisterForm(){
        return view('auth.customer.register');
    }

    public function register(Request $request){
        $this->validate($request, array(
            'first_name'=>'required|string|max:100',
            'last_name'=>'required|string|max:100',
            'mobile'=>'required|string|max:15',
            //'gender'=>'required|string|max:255',
            'email'=>'required|email|max:100|unique:customers,email',
            'password'=>'required|string|min:6|confirmed',
        ));

        $customer = new Customer;
        $customer->first_name = $request->first_name;
        $customer->last_name = $request->last_name;
        $customer->mobile = $request->mobile;
        //$customer->gender = $request->gender;
        $customer->email = $request->email;
        $customer->password = Hash::make($request->password);
        $customer->otp = rand(000000,999999);
        $customer->save();

            //Mail::to($user->email)->send(new CustomerRegister($user));
        

        //event(new NewUserRegistered($user));
        if (Auth::guard('customer')->attempt(['email'=>$request->email,'password'=>$request->password])) {
            // Authentication passed...
            return redirect()->route('customer./');
        }
        return redirect()->back();
    }


    public function update(Request $request, $id){
        $user = Customer::find($id);
        
        $this->validate($request, array(
            'first_name.*'=>'required|string|max:100',
            'last_name.*'=>'required|string|max:100',
            'gender'=>'required|string|max:255',
            'email.*'=>'required|email|max:100|unique:customers,email',$id,
        ));

                    
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->gender = $request->gender;
        $user->email = $request->email;
        $user->save();

        Session::flash('success','Successfully Save');

        return redirect()->route('player.index');
    }


    public function confirm(Request $request){
        if ($request->isMethod('GET')) {
            return view('auth.customer.confirm');
        }
        if ($request->isMethod('POST')) {
            //dd($request->otp); exit;
            $this->validate($request, array(
                'otp'=>'required|string|max:8|exists:customers,otp',
                'password' => ['required', 'string', 'min:6', 'confirmed'],
            ));

            $user = Customer::where('otp',$request->otp)->first();
            $user->password = Hash::make($request->password);
            $user->otp = null;
            $user->save();

            if (Auth::guard('customer')->attempt(['email'=>$user->email,'password'=>$request->password])) {
                // Authentication passed...
                return redirect()->route('customer./');
            }

            return redirect()->back();
        }
    }
    
    public function destroy($id)
    {
        $customer = Customer::find($id);
        //return $customer->orders;
        if($customer->orders->count() > 0){
            Session::flash('warning','Can`t deleted.');
        }else{
            $customer->roles()->detach();
            $customer->permissions()->detach();
            $customer->delete();
        }

        return redirect()->back();
    }

}
