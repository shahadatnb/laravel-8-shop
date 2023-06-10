<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Traits\userTrait;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use PDF;

class OrderController extends Controller
{
    use userTrait;

    public function index(Request $request)
    {
        $orders = Order::latest();
        $data = array('per_page'=>50,'startDate'=>'','endDate'=>'' ); //,'startDate'=>date('m-d-Y'),'endDate'=>date('m-d-Y')
        
        if(!empty($request->startDate && $request->endDate )){
            $from_date = Carbon::createFromFormat('m-d-Y', $request->startDate)->format('Y-m-d').' 00:00:00';
            $to_date = Carbon::createFromFormat('m-d-Y', $request->endDate)->format('Y-m-d').' 23:59:59';
            $orders = $orders->whereBetween('created_at', array($from_date, $to_date));
            $data['startDate'] = $request->startDate;
            $data['endDate'] = $request->endDate;
        }
        if(!empty($request->per_page)){
            $data['per_page'] = $request->per_page;
        }

        $orders = $orders->paginate($data['per_page']);

        return view('admin.order.order',compact('orders','data'));
    }

    private function orderStatus(){
        return ['Processing'=>'Processing','Pending payment'=>'Pending payment','On hold'=>'On hold','Completed'=>'Completed','Refunded'=>'Refunded','Cancelled'=>'Cancelled','Failed'=>'Failed'];
    }


    public function productArray() {
        $productAll = Product::whereNull('parent_id')->orderBy('title')->get();
        $products=array();
        foreach ($productAll as $data) {
            $products[$data->id]= $data->title;
        }
        return $products;
    }

    public function productSellView(Request $request)
    {
        $products = $this->productArray();
        $data = array('per_page'=>50,'startDate'=>'','endDate'=>'' ); //,'startDate'=>date('m-d-Y'),'endDate'=>date('m-d-Y')
        $sizes = array();
        $colors = array();
        $orders = array();
        $product = array();


        if(!empty($request->product)){
            //$orders = $orders->where('club_id',$request->club);
            //$teams = $this->teams($request->size);
            $data['product'] = $request->product;
            $product = Product::where('parent_id',$request->product)->where('size',$request->size)->where('color',$request->color)->first();
            //return $product;
        }

        if(!empty($request->size)){
            //$orders = $orders->where('club_id',$request->club);
            $main_product = Product::where('id',$request->product)->first();
            foreach(array_unique($main_product->childs->pluck('size')->toArray()) as $s){
                $sizes[$s] = $s;
            }
            $data['size'] = $request->size;
        }

        if(!empty($request->color)){
            //$orders = $orders->where('club_id',$request->club);
            $main_product = Product::where('id',$request->product)->first();
            foreach(array_unique($main_product->childs->pluck('color')->toArray()) as $s){
                $colors[$s] = $s;
            }
            $data['color'] = $request->color;
        }

        if(!empty($request->startDate && $request->endDate )){
            $from_date = Carbon::createFromFormat('m-d-Y', $request->startDate)->format('Y-m-d').' 00:00:00';
            $to_date = Carbon::createFromFormat('m-d-Y', $request->endDate)->format('Y-m-d').' 23:59:59';
            //$orders = $orders->whereBetween('created_at', array($from_date, $to_date));
            $data['startDate'] = $request->startDate;
            $data['endDate'] = $request->endDate;
        }



        if($product){
            $orders = Order::whereHas('orderItems', function ($query) use ($product) {
                $query->where('product_id',$product->id);
            })->latest();

            if(!empty($request->per_page)){
                $data['per_page'] = $request->per_page;
            }
        }

      if($orders){
        $orders = $orders->paginate($data['per_page']);
      }
        return view('admin.order.product-sell-view',compact('products','orders','data','sizes','colors'));

    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Order $order)
    {
        $status = $this->orderStatus();
        return view('admin.order.invoice',compact('order','status'));
    }

    public function invoicePDF(Order $order)
    {
        set_time_limit(500);
        $pdf = PDF::loadView('admin.order.invoicePDF', compact('order'));
        return $pdf->download('Invoice-'.$order->id.'.pdf');
        //return view('admin.order.invoicePDF', compact('order'));
    }

    public function edit(Order $order)
    {
        //
    }

    public function update(Request $request, Order $order)
    {
        $order->status = $request->status;
        $order->save();

        //Mail::to($order->customer_email)->send(new NewUserRegistered($order));

        session()->flash('success', "Order updated.");
        return redirect()->back();
    }

    public function destroy(Order $order)
    {
        //
    }
}
