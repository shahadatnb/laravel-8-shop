<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Coupon;
use Auth;

class CheckoutCart extends Component
{
    public $cartItems, $coupon_code, $user;

    public function mount()
    {
              
        $this->user = auth()->user();

    }

    public function itemRemove($id){
        CartItem::destroy($id);
        $this->cart->refresh();
        $this->cartItems = CartItem::where('cart_id',$this->cart->id)->get();
    }

    public function save(){
        
    }

    public function setCoupon(){
        $this->emit('setCoupon',$this->coupon_code);
        //$this->emitTo('setCoupon',$this->coupon_code);//'checkout-cart',
        $this->cart->refresh();
    }

    public function quantityminus($id)
    {
        if($this->quantity[$id] > 1){
            $this->quantity[$id]--;
            $cartItem = CartItem::find($id);
            $cartItem->quantity = $this->quantity[$id];
            $cartItem->total = $cartItem->price*$this->quantity[$id];
            $cartItem->save();
            $this->cart->refresh();
        }
    }

    public function quantityplus($id)
    {
        $this->quantity[$id]++;
        $cartItem = CartItem::find($id);
        $cartItem->quantity = $this->quantity[$id];
        $cartItem->total = $cartItem->price*$this->quantity[$id];
        $cartItem->save();
        $this->cart->refresh();
    }

    public function render()
    {
        $this->cartItems = \Cart::getContent()->toArray();
        return view('livewire.checkout-cart');
    }
}
