<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\AttributeOption;
use Illuminate\Http\Request;

class AttributeController extends Controller
{

    public function index()
    {
        $attributes = Attribute::paginate(50);//where('code','color')->
        return view('admin.attribute.index',compact('attributes'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(Attribute $attribute)
    {
        return view('admin.attribute.show',compact('attribute'));
    }

    public function optionAdd(Request $request){
        $option = new AttributeOption;
        $option->name = $request->name;
        $option->attribute_id = $request->attribute_id;
        $option->label = $request->label;
        $option->save();
        session()->flash('success','Successfully updated.');
        return redirect()->back();
    }

    public function optionDelete($id){
        $option = AttributeOption::find($id);
        $option->delete();
        session()->flash('success','Successfully deleted.');
        return redirect()->back();
    }

    public function edit(Attribute $attribute)
    {
        //
    }


    public function update(Request $request, Attribute $attribute)
    {
        //
    }


    public function destroy(Attribute $attribute)
    {
        //
    }
}
