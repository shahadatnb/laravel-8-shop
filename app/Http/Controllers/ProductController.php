<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use App\Http\Traits\userTrait;
use Session;
use Auth;

class ProductController extends Controller
{
    use userTrait;

    public function index(Request $request)
    {
        $products = Product::whereNull('parent_id')->latest();
        $data = array('per_page'=>50);
        $teams = array();
        if(!empty($request->club)){
            $products = $products->where('club_id',$request->club);
            $teams = $this->teams($request->club);
            $data['club'] = $request->club;
        }
        if(!empty($request->team)){
            $products = $products->where('store_id',$request->team);
            $data['team'] = $request->team;
        }
        if(!empty($request->category)){
            $category = $request->category;
            $products = $products->whereHas('categories', function($q) use ($category){ $q->where('id', $category); });
            $data['category'] = $request->category;
        }
        if(!empty($request->product_title)){
            $products = $products->where('title','like','%'.$request->product_title.'%');
            $data['product_title'] = $request->product_title;
        }
        if(!empty($request->per_page)){
            $data['per_page'] = $request->per_page;
        }

        $clubs = $this->usersArray('club');
        $categories = $this->catArray();

        $products = $products->paginate($data['per_page']);
        return view('admin.product.product',compact('products','categories','clubs','teams','data'));
    }

    public function storeManagement(Request $request){
        $data = array('per_page'=>50,'club'=>'','team'=>'');
        $clubs = $this->usersArray('club');
        $categories = $this->catArray();
        $teams = array();
        $products = array();
        $profile = array();

        $products = Product::whereNull('parent_id');

        if ($request->isMethod('GET')) {
            if(!empty($request->per_page)){
                $data['per_page'] = $request->per_page;
            }

            if(!empty($request->club)){
                $products = $products->where('club_id',$request->club);
                $teams = $this->teams($request->club);
                $data['club'] = $request->club;
            }

            if(!empty($request->team)){
                $profile = UserProfile::where('user_id', $request->team)->first();
                $products = $products->where('store_id',$request->team);
                $teams = $this->teams($request->club);
                $data['team'] = $request->team;
            }

            if(!empty($request->category)){
                $category = $request->category;
                $products = $products->whereHas('categories', function($q) use ($category){ $q->where('id', $category); });
                $data['category'] = $request->category;
            }
            if(!empty($request->product_title)){
                $products = $products->where('title','like','%'.$request->product_title.'%');
                $data['product_title'] = $request->product_title;
            }
            $products = $products->latest()->paginate($data['per_page']);

            return view('admin.product.storeManagement',compact('profile','products','categories','clubs','teams','data'));
        }
        if ($request->isMethod('POST')) {
            $this->validate($request, array(
                'banner'=>['required','mimes:jpg,jpeg,png','max:5000'],
            ));

            $profile = UserProfile::find($request->id);
            $photo_banner = $request->file('banner');
            if ($photo_banner) {
                $filename_banner = auth()->user()->id.'.'.$photo_banner->extension();
                $full_path_banner = 'users/banner/'.$filename_banner;
                $photo_banner->storeAs('public/users/banner/', $filename_banner);
                $profile->banner = $full_path_banner;
            }

            $profile->save();
            Session::flash('success','Successfully updated.');

            return redirect()->back();
        }
    }

    private function catArray(){
        //$datas = Category::whereNull('parent_id')->where('status',1)->get();
        $datas = Category::whereNotNull('parent_id')->where('status',1)->get();
        $cats =array();
        foreach ($datas as $key => $value) {
            $cats[$value->id] = $value->title;
        }
        return $cats;
    }

    public function productInventory(Request $request)
    {
        $products = Product::where('type','!=','variant')->latest();
        $data = array('per_page'=>50);
        $teams = array();
        if(!empty($request->club)){
            $products = $products->where('club_id',$request->club);
            $teams = $this->teams($request->club);
            $data['club'] = $request->club;
        }
        if(!empty($request->team)){
            $products = $products->where('store_id',$request->team);
            $data['team'] = $request->team;
        }
        if(!empty($request->per_page)){
            $data['per_page'] = $request->per_page;
        }
        if(!empty($request->player_name)){
            //$products = $products->where('team_id',$request->team);
            $data['product_title'] = $request->product_title;
        }
        $clubs = $this->usersArray('club');
        $categories = $this->catArray();

        $products = $products->paginate($data['per_page']);

        //$datas = Product::where('type','!=','variant')->latest()->paginate(50);
        return view('admin.product.productInventory',compact('products','categories','clubs','teams','data'));
    }

    public function productInventoryUpdate(Request $request)
    {
        $this->validate($request, array(
            'quantity'=>'required|numeric|max:99999999|min:0',
        ));
//dd($request->all());
        $product = Product::find($request->id);
        if(isset($request->add)){
           $qty =  $product->qty + $request->quantity;
        }else{
            $qty =  $request->quantity;
        }
        $product->qty = $qty;
        $product->save();
        return \Response::json($product);
    }

    public function trashedProduct()
    {
        $products = Product::onlyTrashed()->whereNull('parent_id')->latest()->paginate(20);
        return view('admin.product.product',compact('products'));
    }

    private function colorAtt(){
        $color = Attribute::where('code','color')->first()->attoption;
        $colors = array();
        foreach ($color as $c){
            $colors[$c->name] = $c->name;
        }
        return $colors;
    }

    public function create()
    {
        //$categories = $this->catArray();
        $clubs = $this->usersArray('club');
        $categories = Category::with('child')->where('status',1)->whereNull('parent_id')->get();

        $colors = $this->colorAtt();
        $sizes = ['S'=>'S','M'=>'M','L'=>'L'];
        $mode='create';
        $store = array();
        //return view('admin.product.createOrEdit',compact('mode','store','categories','clubs'));
        return view('admin.product.create',compact('mode','store','categories','clubs','colors','sizes'));
    }


    private function productSlug($slug){
        $slug = Str::slug($slug, '-');
        $count = Product::where('slug','like',$slug.'%')->count();
        $suffix = $count ? $count+1 : '';
        $slug .= $suffix;
        return $slug;
    }


    public function store(Request $request)
    {
        //
    }


    public function show(Product $product)
    {
        // If Ajax
        if (request()->ajax()) {

        }

    }

    public function productSize(Request $request)
    {
        if(!empty($request->input('option'))){
            $input = $request->input('option');
            $product = Product::where('id',$input)->first();
            //return $product->childs;
            $colors = array_unique($product->childs->pluck('size')->toArray());
            return \Response::make($colors);
        }
    }

    public function productColor(Request $request)
    {
        if(!empty($request->input('option'))){
            $input = $request->input('option');
            $product = Product::where('id',$input)->first();
            //return $product->childs;
            $colors = array_unique($product->childs->pluck('color')->toArray());
            return \Response::make($colors);
        }
    }


    public function edit(Product $product)
    {
        $clubs = $this->usersArray('club');
        $colors = $this->colorAtt();
        $categories = Category::with('child')->where('status',1)->whereNull('parent_id')->get();
        $mode='edit';
        $store = array();
        if($product->store_id != null ){
            $store[$product->store_id] = $product->store->name;
        }
        //return $store;
        return view('admin.product.createOrEdit',compact('mode','categories','clubs','store','product','colors'));
    }


    public function update(Request $request, Product $product)
    {
        $this->validate($request, array(
            'title'=>[
                'required','max:255',
                Rule::unique('products')->ignore($product->id),
            ],
        ));
        //$this->validate($request, $this->InsValidator($request));
        //return $request->all();

        //$request['type'] = $request->type == 'variant' ? 'variant' : 'simple';
        //$request['user_id'] = Auth::user()->id;
        //return $request->all();
        Product::where('id',$product->id)->update($request->except(['_token', '_method','categories','photo' ]));
//dd($product->childs->count());
        if($product->childs->count() > 0){
            foreach($product->childs as $item){
                Product::where('id', $item->id)->update(['store_id'=>$product->store_id,'club_id'=>$product->club_id]);
            }
        }

        $product->categories()->sync($request->categories);
        Session::flash('success','Successfully Save');
        return redirect()->route('product.edit',$product);
    }



    public function restoreProduct($id)
    {
        $product =  Product::onlyTrashed()->where('id',$id)->first();
        if($product){
            $childs= Product::withTrashed()->where('parent_id',$product->id)->get();
            if($childs->count()>0){
                foreach($childs as $child){
                    $child->restore();
                }
                $product->restore();
            }else{
                $product->restore();
            }

            Session::flash('success', "Product restored.");
        }

        return redirect()->back();
    }


    public function permanentdelete($id)
    {
        $product =  Product::onlyTrashed()->where('id',$id)->first();

        if($product){
            $childs= Product::withTrashed()->where('parent_id',$product->id)->get();
            if($childs->count()>0){
                foreach($childs as $child){
                    $child->forceDelete();
                }
                $product->forceDelete();
            }else{
                $product->forceDelete();
            }

            Session::flash('warning', "Product restored.");
        }

        return redirect()->back();
    }

    public function destroy(Product $product)
    {

        if($product->childs->count()>0){
            foreach($product->childs as $child){
                $child->delete();
            }
            $product->delete();
        }else{
            $product->delete();
        }

        Session::flash('success', "Product deleted.");
        return redirect()->back();
    }
}
