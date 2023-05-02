<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart as Wishlist;
use App\Models\CartItem;
use Session;
use Auth;

use Illuminate\Support\Facades\Log;

class WishlistController extends Controller
{

    public function __construct()
    {
        // if($this->get() === null)
        //     $this->set($this->empty());
        //$this->user = Auth::user();
    }

    public function getWishlistCount(){
        $wishlist =  Wishlist::where('customer_id',auth('customer')->user()->id)->where('cartType','wishlist')->first();
        if($wishlist){
            return $wishlist->cartItems->count();
        }else{
            return null;
        }
    }

    public function getWishlist(){
        return  Wishlist::where('customer_id',auth('customer')->user()->id)->where('cartType','wishlist')->first();
    }

    public function removeWishlist($id){
        CartItem::destroy($id);
        return  redirect()->back();
    }

    public function addToWishlist($id){

        $product = Product::find($id)->first();
        if($product){
            if($product->parent_id != null){
                $productTitle = $product->parent->title.' '.$product->size.' '.$product->color;
            }else{
                $productTitle = $product->title;
            }

            if ($product->special_price > 0) {
                $price = $product->special_price;
            } else {
                $price = $product->price;
            }


            $wishlist = Wishlist::firstOrCreate(
                [
                    'customer_id' => auth('customer')->user()->id,
                    'cartType'=>'wishlist'
                ],
                [
                    'customer_id' => auth('customer')->user()->id,
                    'cartType'=>'wishlist'
                ]
            );

            $check =  CartItem::where('cart_id',$wishlist->id)->where('product_id',$product->id)->first();
            if($check){
                session()->flash('success', 'Already added.');
            }else{
                $cartItem = new CartItem;
                $cartItem->cart_id = $wishlist->id;
                $cartItem->quantity = 1;
                $cartItem->sku = $product->sku;
                $cartItem->product_id = $product->id;
                $cartItem->parent_id = $product->parent_id;
                $cartItem->name = $productTitle;
                $cartItem->price = $price;
                $cartItem->total = 0;
                $cartItem->save();
                session()->flash('success', 'Wishlist added.');
            }

            return $wishlist->cartItems->count();
        }else{
            return null;
        }

    }

    public function addToCart($id,$qty=1){
        $product = Product::find($id);
        //dd($product); exit;
        if($product){
            if($product->type == 'variant' ){
                return 'redirect';
            }

            if($product->parent_id != null){
                //$parent = $product->parent->title;
                $productTitle = $product->parent->title.' '.$product->size.' '.$product->color;
            }else{
                $productTitle = $product->title;
            }

            if ($product->special_price > 0) {
                $price = $product->special_price;
            } else {
                $price = $product->price;
            }

            \Cart::add([
                'id' => $product->id,
                'name' => $productTitle,
                'price' => $price,
                'quantity' => $qty,
                'attributes' => array(
                    'image' => '',
                    'sku' => $product->sku,
                    'parent_id' => $product->parent_id,
                )
            ]);

            session()->flash('success','Cart Added');
        }else{
            session()->flash('warning','Product not found');
        }
    }

    public function singleAddToCart(Request $request){

    }
}
