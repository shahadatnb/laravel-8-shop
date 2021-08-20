<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable; // for auth
use Illuminate\Foundation\Auth\User as Authenticatable; // for auth

class Customer extends Authenticatable // for auth Model //
{
    use HasFactory;
    use Notifiable; // for auth
    //protected $guard = 'customer'; // for auth

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function team(){
    	return $this->hasOne(User::class,'id','team_id');
    }

    public function orders(){
    	return $this->hasMany(Order::class,'customer_id','id');
    }

    public function siblings(){
    	return $this->hasMany(CustomerSibling::class,'customer_id','id');
    }

    public function address(){
    	return $this->hasMany(CustomerAddress::class,'customer_id','id');
    }

    public function reviews()
    {
        return $this->hasMany(ProductReview::class);
    }
}
