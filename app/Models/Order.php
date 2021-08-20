<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class,'order_id','id');
    }

    public function customer()
    {
        return $this->hasOne(Customer::class,'id','customer_id');
    }

    public function shippingAddress()
    {
        return $this->hasOne(OrderAddress::class,'order_id','id')->where('address_type','shipping');//
    }


}
