<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Coupon extends Model
{
    use HasFactory;

    public function setStartsFromAttribute( $value ) {
        $this->attributes['starts_from'] = Carbon::createFromFormat('m-d-Y', $value)->format('Y-m-d');
      }
      
    public function setEndsTillAttribute( $value ) {
        $this->attributes['ends_till'] = Carbon::createFromFormat('m-d-Y', $value)->format('Y-m-d');
      }

    public function getStartsFromAttribute($value)
    {//starts_from
        return Carbon::parse($value)->format('m/d/Y');
    }

    public function getEndsTillAttribute($value)
    {//ends_till
        return Carbon::parse($value)->format('m/d/Y');
    }

    public function teams(){
        return $this->belongsToMany(User::class, 'users_coupons', 'coupon_id','user_id');
    }

    public function clubInfo(){
    	return $this->hasOne(User::class,'id','club');
    }

    public function teamHas($team)
    {
        if($this->teams()->where('id',$team)->first()){
            return true;
        }
        return false;
    }
}
