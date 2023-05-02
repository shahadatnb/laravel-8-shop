<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Coupon;
use App\Models\Product;
use App\Facades\Wishlist;

class MiniCart extends Component
{
    public $cartItems = [], $coupon_code = '', $wishlist = '';
    protected $listeners = ['setCoupon','addToCart','addToWishlist'];

    public function mount()
    {
        
    }

    public function addToWishlist($id){
        if(!auth('customer')){
            return redirect()->route('login');
        }
        $this->wishlist = Wishlist::addToWishlist($id);
    }

    public function setCoupon($coupon_code=''){
        if($coupon_code ==''){
            $coupon_code =  $this->coupon_code;
        }
        //dd($coupon_code);
        $this->cart->coupon_code =$coupon_code;

        $coupon = Coupon::where('coupen_code',$coupon_code)->first();
        //dd($coupon);
        $active = 0;
        if($coupon){
            if($active == 1){
                if($coupon->is_percentage == 1){
                    $discount = $coupon->discount/100 * $this->cart->subTotal();
                }else{
                    $discount = $coupon->discount;
                }

                $this->cart->discount = $discount;
                $this->cart->save();
                $this->cart->refresh();
                session()->flash('success', 'Coupon successfully added.');
            }
        }else{
            session()->flash('warning', 'Coupon not found.');
        }
    }

    public function addToCart($arg){ 
        $cart = Wishlist::addToCart($arg['id'],$arg['qty']);
        if( $cart == 'redirect'){
            //dd(route('singleProduct',$arg['id']));
            return redirect()->route('singleProduct',$arg['id']);
        }else{
            $this->cart = $cart;
        }

        if($this->cart != ''){
            $this->cartCount = $this->cart->cartItems->count();
        }

    }

    public function render()
    {
        //dd(auth('customer')->user());
        if(auth('customer')->user()){
            $this->wishlist = Wishlist::getWishlistCount();
        }
        $this->cartItems = \Cart::getContent()->toArray();
        return view('livewire.mini-cart');
    }
}
