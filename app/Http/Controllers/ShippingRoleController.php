<?php

namespace App\Http\Controllers;

use App\Models\ShippingRole;
use App\Models\LocationState;
use Illuminate\Http\Request;
use App\Http\Traits\locTrait;

class ShippingRoleController extends Controller
{
    use locTrait;

    public function index()
    {
        $datas=ShippingRole::latest()->paginate(20);
        return view('admin.shippingRole.index', compact('datas'));
    }

    public function create()
    {
        $mode='create';
        $locations = $this->stateIdArray('BD');
        return view('admin.shippingRole.createOrEdit',compact('mode','locations'));
    }

    public function store(Request $request)
    {
        $this->validate($request, array(
            'title'=>'required|max:255|unique:shipping_roles,title',
            'location_id'=>'required',
            'condition'=>'required',
            'amount'=>'required',
            'unit'=>'nullable',
            'minimuUnit'=>'required',
            'incrementPerUnit'=>'required',
            ));

            $data = new ShippingRole;
        $data->title = $request->title;
        $data->location_id = $request->location_id;
        $data->condition = $request->condition;
        $data->amount = $request->amount;
        //$data->unit = $request->unit;
        $data->minimuUnit = $request->minimuUnit;
        $data->incrementPerUnit = $request->incrementPerUnit;
        $data->save();

        session()->flash('success','Successfully Save');
        return redirect()->route('shippingRole.index');
    }

    public function show(ShippingRole $shippingRole)
    {
        //
    }

    public function edit(ShippingRole $shippingRole)
    {
        $mode='edit';
        $locations = $this->stateIdArray('BD');
        return view('admin.shippingRole.createOrEdit', compact('mode','shippingRole','locations'));
    }

    public function update(Request $request, ShippingRole $shippingRole)
    {
        $this->validate($request, array(
            'title'=>'required|max:255',//|unique:shipping_roles,title
            'location_id'=>'required',
            'condition'=>'required',
            'amount'=>'required',
            'unit'=>'nullable',
            'minimuUnit'=>'required',
            'incrementPerUnit'=>'required',
            ));

        $shippingRole->title = $request->title;
        $shippingRole->location_id = $request->location_id;
        $shippingRole->condition = $request->condition;
        $shippingRole->amount = $request->amount;
        //$shippingRole->unit = $request->unit;
        $shippingRole->minimuUnit = $request->minimuUnit;
        $shippingRole->incrementPerUnit = $request->incrementPerUnit;
        $shippingRole->save();

        session()->flash('success','Successfully Save');
        return redirect()->route('shippingRole.index');
    }

    public function destroy(ShippingRole $shippingRole)
    {
        //
    }
}
