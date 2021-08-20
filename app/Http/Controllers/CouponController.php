<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Session;
use Auth;


class CouponController extends Controller
{

    public function index()
    {
        $coupons = Coupon::latest()->paginate(50);
        return view('admin.promotion.coupon',compact('coupons'));
    }

    private function usersArray($role){
        //$club = User::with('role')->get();
        $club = User::all();
        $clubs = array();
        foreach ($club as $value) {
            if($value->hasRole($role)){
                $clubs[$value->id] = $value->name;
            }
        }
        return $clubs;
    }

    private function teamArray($club){
        $team = User::where('club_id',$club)->get();
        $teams = array();
        //$teams['all'] = 'All Teams';
        foreach ($team as $value) {
            $teams[$value->id] = $value->name;
        }
        return $teams;
    }

    private function teamList($club){
        return User::where('club_id',$club)->pluck('id')->toArray();
    }

    public function create()
    {
        $clubs = $this->usersArray('club');
        $teams = array();
        $mode = 'create';
        return view('admin.promotion.couponCreateOrEdit',compact('mode','clubs','teams'));
    }


    public function store(Request $request)
    {
        $this->validate($request, array(
            'coupen_code'=>'required|max:255|alpha_dash|unique:coupons,coupen_code',
            'title'=>'required|string|max:255',
            'discount'=>'required|numeric|min:1',
            //'discount'=>'required|numeric|min:1|max:100',
            'starts_from' => 'required|date',
            'ends_till' => 'required|date|after:starts_from',
            'club' => 'nullable|numeric',
            //'teams' => 'required_unless:club,null',
            'teams' => 'nullable|array'
        ));

//'credit_card_number' => 'required_if:payment_type,cc'

        if($request->is_percentage == 1 && ($request->discount < 0 || $request->discount > 100)){
            Session::flash('warning','Discount percentage value between 1 to 100');
            return redirect()->back();
        }

        $data = new Coupon;
        $data->coupen_code = $request->coupen_code;
        $data->title = $request->title;
        $data->is_percentage = $request->is_percentage;
        $data->discount = $request->discount;
        $data->starts_from = $request->starts_from;
        $data->ends_till = $request->ends_till;
        $data->club = $request->club;
        $data->status = 1;
        $data->save();

        if(!empty($request->club)){
            if(!empty($request->teams)){
                if($request->teams[0] != null ){
                    $coupon->teams()->sync($request->teams);
                }else {
                    $coupon->teams()->detach();
                }                
            }else{
                $coupon->teams()->detach();
            }            
        }            

        Session::flash('success','Successfully Save');
        return redirect()->route('coupon.index');


    }


    public function show(Coupon $coupon)
    {
        //
    }

    public function edit(Coupon $coupon)
    {
        //return $coupon;
        $clubs = $this->usersArray('club');
        if($coupon->club > 0){
            $teams = $this->teamArray($coupon->club);
        }else{
            $teams = array();
        }
        
        $mode = 'edit';
        return view('admin.promotion.couponCreateOrEdit',compact('coupon','mode','clubs','teams'));
    }


    public function update(Request $request, Coupon $coupon)
    {
        $this->validate($request, array(
            'coupen_code'=>[
                'required','alpha_dash','max:255',
                Rule::unique('coupons')->ignore($coupon->id),
            ],
            'title'=>'required|string|max:255',
            'discount'=>'required|numeric|min:1',
            'starts_from' => 'required|date',
            'ends_till' => 'required|date|after:starts_from',
            'club' => 'nullable|numeric',
            'teams' => 'nullable|array'
        ));

        if($request->is_percentage == 1 && ($request->discount < 0 || $request->discount > 100)){
            Session::flash('warning','Discount percentage value between 1 to 100');
            return redirect()->back();
        }

        $coupon->coupen_code = $request->coupen_code;
        $coupon->title = $request->title;
        $coupon->is_percentage = $request->is_percentage;
        $coupon->discount = $request->discount;
        $coupon->starts_from = $request->starts_from;
        $coupon->ends_till = $request->ends_till;
        $coupon->club = $request->club;
        $coupon->status = 1;
        $coupon->save();

        if(!empty($request->club)){
            if(!empty($request->teams)){
                if($request->teams[0] != null ){
                    $coupon->teams()->sync($request->teams);
                }else {
                    $coupon->teams()->detach();
                }                
            }else{
                $coupon->teams()->detach();
            }            
        }              

        Session::flash('success','Successfully Save');
        return redirect()->route('coupon.index');
    }

    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        Session::flash('success','Successfully Deleted');
        return redirect()->back();
    }
}
