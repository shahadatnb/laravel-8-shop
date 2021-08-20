<?php

namespace App\Http\Controllers;

use App\Http\Traits\locTrait;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Session;

class UserProfileController extends Controller
{
    use locTrait;
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(UserProfile $userProfile)
    {
        //
    }

    public function edit(UserProfile $userProfile)
    {
        //
    }

    public function update(Request $request, UserProfile $userProfile)
    {
        //
    }

    public function storeManagement(Request $request){
        $profile = UserProfile::where('user_id', auth()->user()->id)->first();
        if ($request->isMethod('GET')) {
            $country = $this->countryArray();
            $state = $this->stateArray($profile->country);
            $city = array();
            return view('admin.profile.storeManagement',compact('profile','country','state','city'));
        }
        if ($request->isMethod('POST')) {
            $this->validate($request, array(
                'address1'=>'required|string|max:150',
                'address2'=>'nullable|string|max:150',
                'city'=>'required|string|max:50',
                'state'=>'required|string|max:50',
                'country'=>'required|string|max:50',
                'postcode'=>'required|string|max:10',
                'phone'=>'nullable|string|max:100',
                'contactEmail'=>'required|email|max:60',//|unique:user_profiles,contactEmail',
                'photo'=>['nullable','mimes:jpg,jpeg,png','max:5000'],
                'banner'=>['nullable','mimes:jpg,jpeg,png','max:5000'],
            ));

            $photo = $request->file('photo');
            if ($photo) {
                $filename = auth()->user()->id.'.'.$photo->extension();
                $full_path = 'users/'.$filename;
                $photo->storeAs('public/users/', $filename);
                $profile->photo = $full_path;
            }

            $photo_banner = $request->file('banner');
            if ($photo_banner) {
                $filename_banner = auth()->user()->id.'.'.$photo_banner->extension();
                $full_path_banner = 'users/banner/'.$filename_banner;
                $photo_banner->storeAs('public/users/banner/', $filename_banner);
                $profile->banner = $full_path_banner;
            }

            $profile->address1 = $request->address1;
            $profile->address2 = $request->address2;
            $profile->city = $request->city;
            $profile->state = $request->state;
            $profile->country = $request->country;
            $profile->postcode = $request->postcode;
            $profile->phone = $request->phone;
            $profile->contactEmail = $request->contactEmail;
            $profile->save();

            Session::flash('success','Successfully Save');

            return redirect()->back();
        }
    }


}
