<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Coupon;
use App\Facades\Cart;

class MiniCart extends Component
{
    public $cart = [], $cartCount = '', $coupon_code = '', $wishlist = '';
    protected $listeners = ['setCoupon','addToCart','addToWishlist'];

    public function mount()
    {
        //  dd(auth('customer')->user()); exit;
		//if(auth('customer')->user()->id){
            $this->cart = Cart::getCart();
            $this->wishlist = Cart::getWishlistCount();
            //dd($this->wishlist);
            if($this->cart != ''){
                $this->cartCount = $this->cart->cartItems->count();
                $this->coupon_code = $this->cart->coupon_code;
            }

		//}

    }

    public function addToWishlist($id){
        if(!auth('customer')){
            return redirect('/login');
        }
        $this->wishlist = Cart::addToWishlist($id);
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
            //dd($coupon->teams->where('id',auth('customer')->user()->team_id)); exit;
            //$coupon->teamHas(auth('customer')->user()->team_id); exit;
            if($coupon->club == ''){
                $active = 1;
            }elseif($coupon->teams->count() == 0){
                if($coupon->club == auth('customer')->user()->team->club->id){
                    $active = 1;
                }
            }elseif($coupon->teams->where('id',auth('customer')->user()->team_id)->first()){
                $active = 1;
            }else{
                session()->flash('warning', 'Coupon not allow for you.');
            }
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
        dd(auth('customer'));
        if(!auth('customer')){
            return redirect('/login');
        }
        $cart = Cart::addToCart($arg['id'],$arg['qty']);
        if( $cart == 'redirect'){
            return redirect()->route('singleProduct',$arg['id']);
        }else{
            $this->cart = $cart;
        }

        if($this->cart != ''){
            $this->cartCount = $this->cart->cartItems->count();
        }

        /*
        $product = Product::find($id)->first();
        //dd($this->user->id);
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


        $this->cart = CartModel::firstOrCreate(
            [
                'customer_id' => auth('customer')->user()->id,
                'is_active'=>1
            ],
            [
                'customer_id' => auth('customer')->user()->id,
                'is_active'=>1
            ]
        );


        $cartItem = new CartItem;
        $cartItem->cart_id = $this->cart->id;
        $cartItem->quantity = $qty;
        $cartItem->sku = $product->sku;
        $cartItem->product_id = $product->id;
        $cartItem->parent_id = $product->parent_id;
        $cartItem->name = $productTitle;
        $cartItem->price = $price;
        $cartItem->total = $price*$qty;
        $cartItem->save();

        $this->cart->refresh();
        $this->cartCount = $this->cart->cartItems->count();
        session()->flash('success','Cart Added');

        */
    }

    public function render()
    {
        return view('livewire.mini-cart');
    }
}
