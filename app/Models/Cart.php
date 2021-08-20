<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id','is_active','cartType'];

    public function cartItems()
    {
        return $this->hasMany(CartItem::class,'cart_id','id');
    }

    public function subTotal()
    {
        return $this->hasMany(CartItem::class,'cart_id','id')->sum('total');
    }

}
