<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Product;
use App\Models\Category;

class FrontController extends Controller
{
    public function index()
    {
        $categories = Category::where('status',1)->whereNull('parent_id')->get();
        $feature_products = Product::whereNull('parent_id')->where('status',1)->latest()->paginate(20);
        return view('frontend.pages.index', compact('categories','feature_products'));
    }

    public function shop()
    {
        $products = Product::whereNull('parent_id')->where('status',1)->latest()->paginate(20);
        return view('frontend.pages.shop',compact('products'));

    }

    public function productByCat($slug)
    {
        $category = Category::where('slug',$slug)->first();
        if($category){
            return view('frontend.pages.productByCat',compact('category'));
        }else{
            return redirect()->route('/');
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
