<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use Session;
use Auth;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.index');
    }

    public function settings()
    {
       $settings = Setting::where('category','basic')->where('status',1)->orderBy('sl','ASC')->get();
        return view('admin.pages.settings',compact('settings'));
    }

    public function saveSetting(Request $request, $id)
    {
        $data = Setting::find($id);
        if(isset($request->image)){
            $request->validate([
                'value' => 'required|mimes:jpg,jpeg,png|max:2048',
            ]);
            $image = $request->file('value');
            $filename = time().'.'.$image->extension();
            $full_path = 'site_file/'.$filename;
            $image->storeAs('public/site_file/', $filename);
            $data->value = $full_path;
/*
            $fileName = time().'.'.$request->value->extension();
            $upload_path = public_path('upload/site_file');
            $request->value->move($upload_path, $fileName);
            $data->value = $fileName;
*/
            $data->save();
        }else{
            $data->value = $request->value;
            $data->save();
        }


        Session::flash('success','Setting Seved');
        return redirect()->back();
    }
}
