<?php

namespace App\Http\Livewire;

use App\Models\TaxRate;
use Livewire\Component;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Coupon;
use Session;
use Auth;

class CheckoutCheckout extends Component
{

    public $cart = [], $countries, $states, $tax_total, $coupon_code, $user, $country='', $state='';

    protected $listeners = ['setTax'];

    public function mount()
    {
        $this->cart = Cart::where('customer_id',$this->user->id)->where('is_active',1)->first();
        $this->coupon_code = $this->cart->coupon_code;
    }

    public function setCoupon(){
        $this->cart->discount = $discount;
        $this->cart->save();
        $this->cart->refresh();
    }

    public function setTax(){
        if($this->country != '' && $this->state != ''){
            $taxrate = TaxRate::where('country',$this->country)->where('state',$this->state)->first();
            //dd($taxrate);
            if($taxrate){
                $this->tax_total = $taxrate->tax_rate / 100 * $this->cart->subTotal();
            }else{
                $this->tax_total = 0;
            }
            $this->cart->tax_total = $this->tax_total;
            $this->cart->save();
            $this->cart->refresh();
        }
    }

/*
    public function setCoupon($coupon_code=''){
        if($coupon_code ==''){
            $coupon_code =  $this->coupon_code;
        }
        //dd($coupon_code);
        $this->cart->coupon_code =$coupon_code;
        //dd($this->user);
        $coupon = Coupon::where('title',$coupon_code)->first();
        $active = 0;
        if($coupon){
            if($coupon->club == ''){
                $active = 1;
            }elseif($coupon->teams->count() == 0){
                if($coupon->club == $this->user->team->club->id)
                $active = 1;
            }elseif($coupon->teamHas($this->user->team_id)){
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
*/
    public function render()
    {
        return view('livewire.checkout-checkout');
    }
}
