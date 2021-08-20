<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = ['order_id','product_id','parent_id','sku','name','price','qty_ordered','total'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function product()
    {
        return $this->hasOne(Product::class,'id','product_id');
    }

    public function parentProduct()
    {
        return $this->hasOne(Product::class,'id','parent_id');
    }


}
