<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Product;
use App\Models\Category;
use App\Models\Homepage;

class FrontController extends Controller
{
    public function index()
    {
        $sections = [];
        $categories = Category::where('status',1)->whereNotNull('parent_id')->get();
        //$feature_products = Product::whereNull('parent_id')->where('status',1)->latest()->paginate(20);
        $product_sections = Homepage::where('status',1)->orderBy('sl','ASC')->get();
        foreach($product_sections as $item){
            $sections[$item->id] = ['title'=> $item->title, 'product'=>Product::whereHas('hompage', function($q) use($item){
                $q->where('homepage_id',$item->id);
            })->get()];
        }
        //dd($sections); exit;
        return view('frontend.pages.index', compact('categories','sections'));
    }

    public function shop()
    {
        $products = Product::whereNull('parent_id')->where('status',1)->latest()->paginate(20);
        return view('frontend.pages.shop',compact('products'));

    }

    public function search(Request $request)
    {
        $request->search = htmlspecialchars($request->search); //e()
        $products = Product::whereNull('parent_id')->where('status',1)->where('title','LIKE','%'.$request->search.'%')->latest()->paginate(20);
        
        return view('frontend.pages.search',compact('products'));
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

    public function productSingle($id,$slug=null)
    {
        $product = Product::find($id);

        if ($product) {
            $related_products = Product::whereHas('categories', function ($q) use ($product) {
                $q->whereIn('id', $product->categories->pluck('id'));
            })->whereNull('parent_id')->latest()->limit(5)->get();

            $recommended_products = Product::whereHas('categories', function ($q) use ($product) {
                $q->whereIn('id', $product->categories->pluck('id'));
            })->whereNull('parent_id')->inRandomOrder()->limit(5)->get();

            return view('frontend.pages.product-single', compact('product', 'related_products', 'recommended_products'));
        } else {
            return redirect()->route('/');
        }

    }

}
