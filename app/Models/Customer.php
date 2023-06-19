<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable; // for auth
use Illuminate\Foundation\Auth\User as Authenticatable; // for auth
use App\Notifications\customPasswordResetNotification;
use Illuminate\Auth\Notifications\ResetPassword;

class Customer extends Authenticatable // for auth Model //
{
    use HasFactory;
    use Notifiable; // for auth
    //protected $guard = 'customer'; // for auth

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
    ];

    /*
    public static function boot() {
        parent::boot();
        self::created(function ($model) {
            $profile = new UserProfile();
            $model->profile()->save($profile);
        });
    }*/

    public function sendPasswordResetNotification($token)
    {
        ResetPassword::$createUrlCallback = function ($user, $token) {
            return url("password/reset/$token");
        };
        $this->notify(new ResetPassword($token));
    }

/*
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new customPasswordResetNotification($token));
    }
*/

    public function socialAccounts(){
        return $this->hasMany(socialAccount::class);
    }

    public function orders(){
    	return $this->hasMany(Order::class,'customer_id','id');
    }

    public function address(){
    	return $this->hasMany(CustomerAddress::class,'customer_id','id');
    }

    public function reviews()
    {
        return $this->hasMany(ProductReview::class);
    }
}
