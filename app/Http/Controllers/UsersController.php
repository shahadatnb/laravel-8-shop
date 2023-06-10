<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserProfile;
use App\Models\Role;
use App\Mail\NewUserRegistered;
//use App\Events\NewUserRegistered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Traits\userTrait;
use Carbon\Carbon;
use Auth;

class UsersController extends Controller
{
    use userTrait;

    public function index()
    {
        $users = User::orderBy('id', 'desc')->get();

        return view('admin.users.index', ['users' => $users]);
    }


    public function create(Request $request)
    {
        if($request->ajax()){
            $roles = Role::where('id', $request->role_id)->first();
            $permissions = $roles->permissions;

            return $permissions;
        }

        $roles = Role::all();
        
        return view('admin.users.create', ['roles' => $roles]);
    }


    public function store(Request $request)
    {
        //validate the fields
        $request->validate([
            'name' => 'required|max:255',
            'username' => 'nullable|unique:users|max:25',
            'Designation' => 'required|max:255',
            'mobile' => 'required|max:255',
            'email' => 'required|unique:users|email|max:255',
            //'password' => 'required|between:8,255|confirmed'
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->username = $request->username;
        $user->Designation = $request->Designation;
        $user->mobile = $request->mobile;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        if($request->role != null){
            $user->roles()->attach($request->role);
            $user->save();
        }

        if($request->permissions != null){            
            foreach ($request->permissions as $permission) {
                $user->permissions()->attach($permission);
                $user->save();
            }
        }

        UserProfile::create(['user_id' => $user->id, 'photo' => '']);
        //Mail::to($request->email)->send(new NewUserRegistered($user));

        return redirect()->route('users.index');
    }


    public function show(User $user)
    {
        return view('admin.users.show', ['user'=>$user]);
    }


    public function edit(User $user)
    {
        $roles = Role::get();
        $userRole = $user->roles->first();
        if($userRole != null){
            $rolePermissions = $userRole->allRolePermissions;
        }else{
            $rolePermissions = null;
        }
        $userPermissions = $user->permissions;

        // dd($rolePermission);

        return view('admin.users.edit', [
            'user'=>$user,
            'roles'=>$roles,
            'userRole'=>$userRole,
            'rolePermissions'=>$rolePermissions,
            'userPermissions'=>$userPermissions
            ]);
    }


    public function update(Request $request, User $user)
    {
        //validate the fields
        $request->validate([
            'name' => 'required|max:255',
            //'Designation' => 'required|max:255',
            'mobile' => 'required|max:255',
            'username' => ['nullable','alpha_dash','max:30','unique:users,username,'.$user->id],
            'email' => ['required','email','max:30','unique:users,email,'.$user->id],
            //'password' => 'nullable|min:6|confirmed',
        ]);

        $user->name = $request->name;
        $user->username = $request->username;
        //$user->Designation = $request->Designation;
        $user->mobile = $request->mobile;
        $user->email = $request->email;
        if($request->password != null){
            $user->password = Hash::make($request->password);
        }
        $user->save();

        $user->roles()->detach();
        $user->permissions()->detach();

        if($request->role != null){
            $user->roles()->attach($request->role);
            $user->save();
        }

        if($request->permissions != null){            
            foreach ($request->permissions as $permission) {
                $user->permissions()->attach($permission);
                $user->save();
            }
        }

        return redirect()->route('users.index');

    }

    public function profile(){
        return view('admin.profile.profile');
    }
    
    public function editProfile(){
        $user = User::find(Auth::User()->id);
        return view('admin.profile.editProfile',compact('user'));
    }

    public function updateProfile(Request $request){
        $user = User::find(auth()->user()->id);
        $this->validate($request, array(
            'name' => 'required|string|max:255',
            'Designation' => 'nullable|string|max:100',
            'mobile' => 'required|string|max:14',
            'username' => ['nullable','alpha_dash','max:30','unique:users,username,'.$user->id],
            'email' => ['required','email','max:30','unique:users,email,'.$user->id],
        ));
                              
        
        $user->name = $request->name;
        $user->mobile = $request->mobile;
        $user->email = $request->email;
        $user->save();

        session()->flash('success','Successfully Save');
        return redirect()->route('profile');
    }

    public function chengePassword(Request $request){
    	$this->validate($request, array(
            'CurrentPassword'=>'required|max:15',
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            ));
        $user = User::find(auth()->user()->id);
    	if(Hash::check($request->CurrentPassword, $user->password )){
	        $user->password = Hash::make($request->password);
	        $user->save();
            session()->flash('success', "Password chenged.");
	        return redirect()->back();            
    	}else{
            session()->flash('warning', "Current Password does not match.");
    		return redirect()->back();
    	}

    } 


    public function userList($role){
        $users = User::whereHas('roles', function($q) use ($role){
            $q->where('slug', $role);
        })->get();
        return view('admin.users.userList',compact('role','users'));
    }

    public function ban(Request $request)
    {
        if($request->days != 0 ){
            // ban for days
            $ban_days = Carbon::now()->addDays($request->days);
        }else{
            $ban_days = $request->days;
        }

        // ban user
        $user = User::find($request->user_id);
        if($user){
            $user->banned_till = $ban_days;
            $user->save();
            session()->flash('success', "Successfully ban.");
        }
	    return redirect()->back(); 
    }

    public function unban($id)
    {
        $user = User::find($id);
        if($user){
            $user->banned_till = null;
            $user->save();
            session()->flash('success', "Successfully unban.");
        }
	    return redirect()->back();   
    }

    public function bannedStatus()
    {
        $user_id = 1;
        $user = User::find($user_id);
    
        $message = "The user is not banned";
        if ($user->banned_till != null) {
            if ($user->banned_till == 0) {
                $message = "Banned Permanently";
            }
    
            if (now()->lessThan($user->banned_till)) {
                $banned_days = now()->diffInDays($user->banned_till) + 1;
                $message = "Suspended for " . $banned_days . ' ' . Str::plural('day', $banned_days);
            }
        }
    
        dd($message);
    }

    public function destroy(User $user)
    {
        
        $user->roles()->detach();
        $user->permissions()->detach();
        $user->delete();

        return redirect()->back();
    }
}
