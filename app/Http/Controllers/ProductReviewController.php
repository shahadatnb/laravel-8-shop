<?php

namespace App\Http\Controllers;

use App\Models\ProductReview;
use Illuminate\Http\Request;

class ProductReviewController extends Controller
{

    public function index()
    {
        $reviews = ProductReview::latest()->paginate('50');
        return view('admin.pages.reviews',compact('reviews'));
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request, array(
            'rating'=>'required|numeric|min:1|max:5',
            'comment' => 'required|string',
            'product_id' => 'required|numeric',
        ));

        $data = new ProductReview;
        $data->rating = $request->rating;
        $data->comment = $request->comment;
        $data->product_id = $request->product_id;
        $data->customer_id = auth('customer')->user()->id;
        $data->status = 1;
        $data->save();
        session()->flash('success','Successfully Save');
        return redirect()->back();

    }

    public function show(ProductReview $review)
    {
        //
    }

    public function edit(ProductReview $review)
    {
        //
    }

    public function update(Request $request, ProductReview $review)
    {
        //
    }

    public function destroy(ProductReview $review)
    {
        $review->delete();
        session()->flash('success','Successfully Deleted');
        return redirect()->back();
    }
}
