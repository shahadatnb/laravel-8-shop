<?php

namespace App\Http\Livewire;

use Livewire\Component;
//use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Coupon;
use Cart;

class CheckoutCart extends Component
{
    public $cartItems, $quantity=[], $coupon_code, $user;

    public function mount()
    {              
        $this->user = auth()->user();
        //dd(\Cart::getContent());
        foreach(Cart::getContent() as $item){
            $this->quantity[$item->id] = $item->quantity;
        }
        //dd($this->quantity);
    }

    public function itemRemove($id){
        Cart::remove($id);
    }

    public function setCoupon(){
        $this->emit('setCoupon',$this->coupon_code);
        //$this->emitTo('setCoupon',$this->coupon_code);//'checkout-cart',
        $this->cart->refresh();
    }


    protected function quantityUpdate($id, $qty){
        Cart::update($id, array(
            'quantity' => $qty,
        ));
    }    

    public function quantityminus($id)
    {
        if(Cart::get($id)->quantity > 1){
            --$this->quantity[$id];
            $this->quantityUpdate($id, -1);
        }
    }

    public function quantityplus($id)
    {   
        ++$this->quantity[$id];
        //dd($qty); exit;
        $this->quantityUpdate($id, 1);
    }

    public function render()
    {
        $this->cartItems = Cart::getContent();
        return view('livewire.checkout-cart');
    }
}
