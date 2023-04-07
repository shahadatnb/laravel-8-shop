<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Http\Traits\userTrait;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    use userTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $dashboard = array(); $orders=[]; $order_items=[]; $orders_last_month=[];

        if(auth()->user()->hasAnyRole(['staff','admin'])):
            $dashboard['total-products'] = Product::whereNull('parent_id')->count();
            $dashboard['total-orders'] = Order::count();
/*
            for ($i = 6; $i >= 1; $i--) {
                $months[] = date("M", strtotime( date( 'Y-m-01' )." -$i months"));
            }
*/

/******* 
            $date1 = date('Y-m-1 00:00:00',strtotime( date( 'Y-m-01' )." -12 months"));
            $date2 = date('Y-m-31 23:59:59',strtotime( date( 'Y-m-01' )." -1 months"));
            $orders = Order::select(
                DB::raw('sum(grand_total) as sums'),
                //DB::raw("DATE_FORMAT(created_at,'%M %Y') as months")
                DB::raw("DATE_FORMAT(created_at,'%M') as months")
            )
                ->groupBy('months')
                ->whereBetween('created_at', array($date1, $date2))
                ->orderBy('created_at','asc')
                ->get();

            $dates['first'] = date('Y-m-1 00:00:00',strtotime( date( 'Y-m-01' )." -2 months"));
            $dates['last'] = date('Y-m-31 23:59:59',strtotime( date( 'Y-m-01' )." -1 months"));
            $orders_last_month = Order::select(
                DB::raw('sum(grand_total) as sums'),
                //DB::raw("DATE_FORMAT(created_at,'%M %Y') as months")
                DB::raw("DATE_FORMAT(created_at,'%D') as days")
            )
                ->groupBy('days')
                ->whereBetween('created_at', array($dates['first'], $dates['last']))
                ->orderBy('created_at','asc')
                ->get();
*/
/*
            $order_items = OrderItem::whereHas('order', function($q) use ($dates){
                $q->whereBetween('updated_at', array($dates['first'], $dates['last']));//->where('status', 'Completed')
            })
            ->select('product_id',DB::raw('sum(qty_ordered) as Sold'),DB::raw('sum(total) as total_amount')) //
            ->groupBy('product_id')
            ->orderBy('Sold','desc')
            ->take(5)
            ->get();
*/

/**************
        elseif(auth()->user()->hasAnyRole(['club'])):
            $teams = $this->teamList(auth()->user()->id);
            $dashboard['total-teams'] = $teams ? $teams->count() : 0;
            $players = $this->customerList(auth()->user()->id);
            $dashboard['total-players'] = $players ? $players->count() : 0;
        
        */
endif;

/*
        $sales = OrderItem::whereHas('roles', function($q){
            $q->where('slug', $acType);
        })->get();
*/
        //return $orders_last_month;
        return view('admin.pages.dashboard',compact('dashboard'));//,'orders','order_items','orders_last_month'

    }
}
