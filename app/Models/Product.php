<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory,SoftDeletes;
/*
    public static function boot() {
        parent::boot();
        self::created(function ($model) {
            $stock = new ProductStock();
            $model->stock()->save($stock);
        });
    }
*/
    protected $fillable = ['sku','barcode','type','parent_id','status','user_id','title','slug','short_description','description','thumbnail','qty','price','cost','special_price','special_price_from','special_price_to','weight','color','color_label','size','size_label','trackQuantity','stockOutSell','readyToShipping','noShappingCharge'];//,'store_id'

    public function stock()
    {
        return $this->hasOne(ProductStock::class);
    }

    public function categories(){
        return $this->belongsToMany(Category::class, 'product_categories','product_id', 'category_id');
    }

    public function attributes(){
        return $this->belongsToMany(Attribute::class, 'product_attributes','product_id', 'attribute_id');
    }

    public function attributeOptions(){
        return $this->belongsToMany(AttributeOption::class, 'product_attribute_options','product_id', 'attribute_option_id');
    }

    public function allphotos()
    {
        return $this->hasMany(ProductImage::class,'product_id','id');
    }
    public function reviews()
    {
        return $this->hasMany(ProductReview::class);
    }

    public function childs()
    {
        return $this->hasMany(Product::class,'parent_id','id');
    }

    public function cartItem()
    {
        return $this->hasMany(CartItem::class,'product_id','id');
    }

    public function orderItem()
    {
        return $this->hasMany(OrderItem::class,'product_id','id');
    }

    public function parent()
    {
        return $this->hasOne(Product::class,'id','parent_id');
    }

}
