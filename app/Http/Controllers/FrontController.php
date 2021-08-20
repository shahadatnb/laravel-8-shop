<?php

namespace App\Http\Controllers;

use App\Models\ProductReview;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Product;
use Session;
use Auth;

class FrontController extends Controller
{
    public function index()
    {
        return view('frontend.pages.index');
    }

    public function store()
    {
        //return Auth::user()->team_id;
        $store = User::find(auth('customer')->user()->team_id);
        if($store){
            //$products = Product::whereNull('parent_id')->where('store_id',$store->id)->where('status',1)->latest()->paginate(20);
            //return view('frontend.pages.store',compact('store','products'));
            return view('frontend.pages.store',compact('store'));
        }

    }

    public function page($slug){
        $page = Post::where('slug',$slug)->first();
        if($page){
            return \View::first(["frontend.pages.single-{$page->post_type}","frontend.pages.single-{$page->slug}",'frontend.pages.single'],compact('page'));
        }

        return $this->notFound();
    }

    public function productSingle($id)
    {
        $product = Product::find($id);

        if ($product) {
            $related_products = Product::whereHas('categories', function ($q) use ($product) {
                $q->whereIn('id', $product->categories->pluck('id'));
            })->whereNull('parent_id')->latest()->limit(15)->get();

            $recommended_products = Product::whereHas('categories', function ($q) use ($product) {
                $q->whereIn('id', $product->categories->pluck('id'));
            })->whereNull('parent_id')->inRandomOrder()->limit(15)->get();

            return view('frontend.pages.product-single', compact('product', 'related_products', 'recommended_products'));
        } else {
            return redirect()->route('/');
        }

    }

}
