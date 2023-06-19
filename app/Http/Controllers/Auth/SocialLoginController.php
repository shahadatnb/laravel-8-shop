<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\SocialAccount;

class SocialLoginController extends Controller
{
    public function redirectToProvider(String $provider){
        return \Socialite::driver($provider)->redirect();
    }

    public function providerCallback(String $provider){
        try{
            $social_user = \Socialite::driver($provider)->user();
            // First Find Social Account
            $account = SocialAccount::where([
                'provider_name'=>$provider,
                'provider_id'=>$social_user->getId()
            ])->first();

            // If Social Account Exist then Find User and Login
            if($account){
                auth('customer')->login($account->customer);
                return redirect()->route('customer./');
            }

            // Find User
            $user = Customer::where([
                'email'=>$social_user->getEmail()
            ])->first();
            

            // If User not get then create new user
            if(!$user){
                $user = Customer::create([
                    'email'=>$social_user->getEmail(),
                    'first_name'=>$social_user->getName()
                ]);
            }

           //dd($user);exit;

            // Create Social Accounts
            $user->socialAccounts()->create([
                'provider_id'=>$social_user->getId(),
                'provider_name'=>$provider
            ]);

            // Login
            auth('customer')->login($user);
            return redirect()->route('customer./');

        }catch(\Exception $e){
            return redirect()->route('customer.login');
        }
        
    }   
}
