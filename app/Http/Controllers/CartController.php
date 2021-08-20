<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;
use Session;
use Auth;

use Illuminate\Support\Facades\Log;

class CartController extends Controller
{

    public function __construct()
    {
        // if($this->get() === null)
        //     $this->set($this->empty());
        //$this->user = Auth::user();
    }

    public function getCart(){
        return Cart::where('customer_id',auth('customer')->user()->id)->where('is_active',1)->first();
    }

    public function getWishlistCount(){
        $wishlist =  Cart::where('customer_id',auth('customer')->user()->id)->where('cartType','wishlist')->first();
        if($wishlist){
            return $wishlist->cartItems->count();
        }else{
            return null;
        }
    }

    public function getWishlist(){
        return  Cart::where('customer_id',auth('customer')->user()->id)->where('cartType','wishlist')->first();
    }

    public function removeWishlist($id){
        CartItem::destroy($id);
        return  redirect()->back();
    }

    public function index(){
        return view('frontend.pages.cart');
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


            $wishlist = Cart::firstOrCreate(
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

            $cart = Cart::firstOrCreate(
                [
                    'customer_id' => auth('customer')->user()->id,
                    'is_active'=>1
                ],
                [
                    'customer_id' => auth('customer')->user()->id,
                    'is_active'=>1
                ]
            );

            $check =  CartItem::where('cart_id',$cart->id)->where('product_id',$product->id)->first();
            if($check){
                $qty = $check->quantity+$qty;
                $check->quantity = $qty;
                $check->total = $price*$qty;
                $check->save();
            }else{
                $cartItem = new CartItem;
                $cartItem->cart_id = $cart->id;
                $cartItem->quantity = $qty;
                $cartItem->sku = $product->sku;
                $cartItem->product_id = $product->id;
                $cartItem->parent_id = $product->parent_id;
                $cartItem->name = $productTitle;
                $cartItem->price = $price;
                $cartItem->total = $price*$qty;
                $cartItem->save();
            }
            session()->flash('success','Cart Added');
        }else{
            session()->flash('warning','Product not found');
        }
        return $cart;
    }

    public function singleAddToCart(Request $request){

    }
}
