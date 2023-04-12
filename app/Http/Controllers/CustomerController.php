<?php

namespace App\Http\Controllers;

use App\Http\Traits\locTrait;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CustomerSibling;
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
            'first_name'=>'required|string|max:100',
            'last_name'=>'required|string|max:100',
            'jersey_name'=>'required|string|max:100',
            'jersey_no' =>['required','string','max:3',
                Rule::unique('customers')->where(function ($query) use($customer){
                return $query->where('team_id', $customer->team_id);
            })->ignore($customer->id)],
            'email'=>[
                'required','email','max:100',
                Rule::unique('customers')->ignore($customer->id),
            ],
            'FatherName'=>'nullable|string|max:100',
            'FatherEmail'=>[
                'nullable','email','max:100',
                //Rule::unique('customers')->ignore($customer->id),
            ],
            'MotherName'=>'nullable|string|max:100',
            'MotherEmail'=>[
                'nullable','email','max:100',
                //Rule::unique('customers')->ignore($customer->id),
            ],
            'gender'=>'required|string|max:100',
            'date_of_birth'=>'required|date|max:100',

            'SiblingsName[]'=>'nullable|string|max:100',
            'SiblingsEmail[]'=>'nullable|email|max:100',
        ));


        //$dob = Carbon::createFromFormat('d-mY', $request->date_of_birth)->format('Y-m-d');
        $dob = Carbon::createFromFormat('Y-m-d', $request->date_of_birth)->toDateString();;

        $customer->first_name = $request->first_name;
        $customer->last_name = $request->last_name;
        $customer->jersey_name = $request->jersey_name;
        $customer->email = $request->email;
        $customer->FatherName = $request->FatherName;
        $customer->FatherEmail = $request->FatherEmail;
        $customer->MotherName = $request->MotherName;
        $customer->MotherEmail = $request->MotherEmail;
        $customer->gender = $request->gender;
        $customer->date_of_birth = $dob;
        $customer->address1 = $request->address1;
        $customer->city = $request->city;
        $customer->state = $request->state;
        $customer->country = $request->country;
        $customer->postcode = $request->postcode;
        $customer->phone = $request->phone;

        if($customer->jersey_name == ''){
            $customer->jersey_name = $request->jersey_name;
        }
        if($customer->jersey_no == ''){
            $customer->jersey_no = $request->jersey_no;
        }

        $customer->save();

        /*

        $CustomerAddress = CustomerAddress::where('customer_id',$customer->id)->first();
        $CustomerAddress->address1 = $request->address1;
        $CustomerAddress->city = $request->city;
        $CustomerAddress->state = $request->state;
        $CustomerAddress->postcode = $request->postcode;
        $CustomerAddress->save();
*/
        if($request->SiblingsName[0] != '' && $request->SiblingsEmail[0] != '' ){
            for ($i=0; $i < count($request->SiblingsName); $i++) {
                $user = new CustomerSibling;
                $user->customer_id =  $customer->id;
                $user->SiblingsName = $request->SiblingsName[$i];
                $user->SiblingsEmail = $request->SiblingsEmail[$i];
                $user->save();
            }
        }

        Session::flash('success','Successfully Save');
        return redirect()->back();
    }

    public function removeSibling($id){
        $sibling = CustomerSibling::where('id',$id)->where('customer_id',auth('customer')->user()->id)->first();
        if($sibling){
            $sibling->delete();
            Session::flash('success','Successfully removed');
        }

        return redirect()->back();
    }

    public function wishlist()
    {
        $wishlist = \Cart::getWishlist();
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
