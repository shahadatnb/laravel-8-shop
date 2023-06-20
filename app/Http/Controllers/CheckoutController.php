<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart as Wishlist;
use App\Models\CartItem;
use App\Http\Traits\locTrait;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderAddress;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderSubmited;
use Stripe;

class CheckoutController extends Controller
{
    use locTrait;


    public function index(){
        $cartItems = \Cart::getContent();
        //dd($cartItems);exit;
        if($cartItems){
            $user = auth('customer')->user();
            $countries = $this->countryArray();
            $states = array();
            if ($user->country != ''){
                $states = $this->stateArray($user->country);
            }
            return view('frontend.checkout.checkout',compact('countries','states','user','cartItems'));
        }else{
            return redirect()->route('/');
        }
    }


    public function cart(){
        return view('frontend.pages.cart');
    }

    /*
    <option value="wc-pending">Pending payment</option>
    <option value="wc-processing">Processing</option>
    <option value="wc-on-hold" selected="selected">On hold</option>
    <option value="wc-completed">Completed</option>
    <option value="wc-cancelled">Cancelled</option>
    <option value="wc-refunded">Refunded</option>
    <option value="wc-failed">Failed</option>
    */

    public function checkout(Request $request){
        //return $request->all();
        $this->validate($request, array(
            'first_name'=>'required|string|max:100',
            'last_name'=>'required|string|max:100',
            'address1'=>'required|string|max:255',
            'address2'=>'nullable|string|max:255',
            'city'=>'required|string|max:255',
            'state'=>'required|string|max:255',
            'country'=>'required|string|max:255',
            'postcode'=>'required|numeric',
            //'cart_id'=>'required|numeric',
        ));

        $cartItems = \Cart::getContent()->toArray();

        $payment_method = 'Cash on Delivery'; //'paypal'

        $order = new Order;
        //$order->cart_id = $cart->id;
        $order->status = 'Processing';
        $order->coupon_code = '';//$cart->coupon_code;
        $order->tax_amount = 0;//$cart->tax_total;
        $order->discount_amount = 0;// $cart->discount;
        $order->payment_method = $payment_method;
        $order->customer_id = auth('customer')->user()->id;
        //$order->shipping_method = $request->email;
        $order->customer_first_name = $request->first_name;
        $order->customer_last_name = $request->last_name;
        $order->customer_email = $request->email;
        $order->total_item_count = \Cart::getTotalQuantity();
        $order->total_qty_ordered = \Cart::getTotalQuantity();
        $order->sub_total = \Cart::getTotal();
        $order->grand_total = \Cart::getTotal();
        $order->save();

        foreach($cartItems as $item){
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'parent_id'=>$item['attributes']['parent_id'],
                'image'=>$item['attributes']['image'],
                'sku' => $item['attributes']['sku'],
                'name' => $item['name'],
                'price' => $item['price'],
                'qty_ordered' => $item['quantity'],
                'total' => $item['price']*$item['quantity'],
            ]);
        }

        $address = new OrderAddress;
        $address->first_name = $request->first_name;
        $address->last_name = $request->last_name;
        $address->email = $request->email;
        $address->address1 = $request->address1;
        $address->address2 = $request->address2;
        $address->country = $request->country;
        $address->state = $request->state;
        $address->city = $request->city;
        $address->postcode = $request->postcode;
        $address->phone = $request->phone;
        $address->address_type = 'shipping';
        $address->order_id = $order->id;
        $address->customer_id = auth('customer')->user()->id;
        $address->save();
        
        \Cart::clear();
        //Mail::to($order->customer_email)->send(new OrderSubmited($order));
/*
        if($payment_method == 'paypal'){
            session()->put('order_id', $order->id);
            return  redirect()->route('paypal');
        }
*/
        session()->flash('success','Order placed');
        return redirect()->route('customer.orders');

    }




}
