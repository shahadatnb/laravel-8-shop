<?php

namespace App\Http\Controllers;

use App\Models\Homepage;
use App\Models\Product;
use Illuminate\Http\Request;
use Str;

class HomepageController extends Controller
{

    public function index()
    {
        $homepages = Homepage::all();
        return view('admin.homepage.index', compact('homepages'));
    }


    public function create()
    {
        $mode = 'create';
        $products = Product::where('status',1)->whereNull('parent_id')->latest()->pluck('title','id')->toArray();
        return view('admin.homepage.createOrEdit', compact('products','mode'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title'=>['required','string','max:200','unique:homepages'],
            'template'=>['nullable','string','max:200'],
            'sl'=>['nullable','numeric','min:0'],
            'thumbnail'=>['nullable','image'],
            'status'=>['required'],
            'products'=>['required'],
        ]);

        $homepage = new Homepage;
        $homepage->title = $request->title;
        $homepage->slug = Str::slug($request->title);
        $homepage->sl = $request->sl;
        $homepage->status = $request->status;
        $homepage->save();

        $homepage->products()->sync($request->products);

        session()->flash('success', "Saved.");
        return redirect()->route('homepage.index');
    }

    public function show(Homepage $homepage)
    {
        //
    }


    public function edit(Homepage $homepage)
    {
        $mode = 'edit';
        $products = Product::where('status',1)->whereNull('parent_id')->latest()->pluck('title','id')->toArray();
        return view('admin.homepage.createOrEdit', compact('products','mode','homepage'));
    }

    public function update(Request $request, Homepage $homepage)
    {
        $this->validate($request, [
            'title'=>['required','string','max:200','unique:homepages,title,'.$homepage->id],
            'template'=>['nullable','string','max:200'],
            'sl'=>['nullable','numeric','min:0'],
            'thumbnail'=>['nullable','image'],
            'status'=>['required'],
            'products'=>['required'],
        ]);

        $homepage->title = $request->title;
        //$homepage->slug = Str::slug($request->slug);
        $homepage->sl = $request->sl;
        $homepage->status = $request->status;
        $homepage->save();

        $homepage->products()->sync($request->products);

        session()->flash('success', "Saved.");
        return redirect()->back();
    }

    public function destroy(Homepage $homepage)
    {
        //
    }
}
