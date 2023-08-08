<?php

namespace App\Http\Controllers;

use App\Http\Traits\locTrait;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CustomerAddress;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Session;

class CustomerController extends Controller
{
    use locTrait;

    public function __construct()
    {
        //$this->middleware('auth:customer');
    }
    public function index()
    {
        $total_orders = Order::where('customer_id',auth('customer')->user()->id)->count();
        $total_completed = Order::where('status','Completed')->where('customer_id',auth('customer')->user()->id)->count();
        $total_processing = Order::where('status','Processing')->where('customer_id',auth('customer')->user()->id)->count();
        return view('frontend.customer.dashboard', compact('total_orders','total_processing','total_completed'));
    }

    public function profile()
    {
        $user = auth('customer')->user();
        $countries = $this->countryArray();
        $states = array();
        if ($user->country != ''){
            $states = $this->stateArray($user->country);
        }
        return view('frontend.customer.profile',compact('user','countries','states'));
    }

    public function profileUpdate(Request $request,Customer $customer)
    {
        $this->validate($request, array(
            'first_name'=>'required|string|regex:/^[\pL\s\-]+$/u|max:25',
            'last_name'=>'required|string|regex:/^[\pL\s\-]+$/u|max:25',
            'phone'=>'required|regex:/^([0-9\-\+\(\)]*)$/|max:15',
            'email'=>'required','email','max:50','unique:customers,email,'.$customer->id,
            'gender'=>'required|string|max:100',
            'date_of_birth'=>'required|date|max:100',
        ));


        //$dob = Carbon::createFromFormat('d-mY', $request->date_of_birth)->format('Y-m-d');
        $dob = Carbon::createFromFormat('Y-m-d', $request->date_of_birth)->toDateString();;

        $customer->first_name = $request->first_name;
        $customer->last_name = $request->last_name;
        $customer->email = $request->email;
        $customer->gender = $request->gender;
        $customer->date_of_birth = $dob;
        $customer->address1 = $request->address1;
        $customer->city = $request->city;
        $customer->state = $request->state;
        $customer->country = $request->country;
        $customer->postcode = $request->postcode;
        $customer->phone = $request->phone;
        $customer->save();

        /*

        $CustomerAddress = CustomerAddress::where('customer_id',$customer->id)->first();
        $CustomerAddress->address1 = $request->address1;
        $CustomerAddress->city = $request->city;
        $CustomerAddress->state = $request->state;
        $CustomerAddress->postcode = $request->postcode;
        $CustomerAddress->save();
*/

        Session::flash('success','Successfully Save');
        return redirect()->back();
    }

    public function wishlist()
    {
        $wishlist = \Wishlist::getWishlist();
        return view('frontend.customer.wishlist',compact('wishlist'));
    }

    public function orders()
    {
        $orders = Order::where('customer_id',auth('customer')->user()->id)->latest()->get();
        return view('frontend.customer.orders',compact('orders'));
    }

    public function orderShow($id)
    {
        $order = Order::where('customer_id',auth('customer')->user()->id)->where('id',$id)->first();
        return view('frontend.customer.orderView',compact('order'));
    }

    public function orderRefund($id)
    {
        $order = Order::where('customer_id',auth('customer')->user()->id)->where('id',$id)->first();
        return view('frontend.customer.orderRefund',compact('order'));
    }
    public function orderItemRefund(Request $request,$id)
    {
        $orderItem = OrderItem::find($id);
        $orderItem->qty_refunded = $request->qty_refunded;
        $orderItem->save();

        $order = Order::find($orderItem->order_id);
        $order->refund_status =1;
        $order->save();

        session()->flash('success', 'Coupon successfully refunded.');

        return redirect()->back();
    }

    protected function guard()
    {
        return Auth::guard('customer');
    }
}
