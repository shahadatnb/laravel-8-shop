<?php

namespace App\Models;

use App\Traits\HasRolesAndPermissions;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;

class User extends Authenticatable //implements MustVerifyEmail
{
    use HasFactory, Notifiable,HasRolesAndPermissions, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function club(){
    	return $this->hasOne(User::class,'id','club_id');
    }

    public function teams(){
    	return $this->hasMany(User::class,'club_id','id');
    }

    public function customers(){
    	return $this->hasMany(Customer::class,'team_id','id');
    }

    public function profile(){
    	return $this->hasOne(UserProfile::class,'user_id','id');
    }

    public function role()
    {
        return $this->belongsToMany(Role::class, 'users_roles');
    }

    public function hasAnyRole($roles)
    {
        if(is_array($roles))
        {
            foreach ($roles as $role) {
                if($this->hasRole($role)){
                    return true;
                }
            }
        }else{
            if($this->hasRole($roles)){
                return true;
            }
        }
        return false;
    }

    public function hasRole($role)
    {
        if($this->roles()->where('slug',$role)->first()){
            return true;
        }
        return false;
    }
}
