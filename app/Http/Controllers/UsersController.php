<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserProfile;
use App\Models\Role;
use App\Mail\NewUserRegistered;
//use App\Events\NewUserRegistered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;
use App\Http\Traits\userTrait;
use Session;
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
            'password' => 'required|between:8,255|confirmed',
            'password_confirmation' => 'required'
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
            'username' => [
                'nullable','alpha_dash','max:30',
                Rule::unique('users')->ignore($user->id),
            ],
            'email' => [
                'required','email','max:40',
                Rule::unique('users')->ignore($user->id),
            ],
            'password' => 'confirmed',
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
        $this->validate($request, array(
            'name' => 'required|string|max:255',
            'Designation' => 'required|string|max:100',
            'mobile' => 'required|string|max:14',
            'username' => [
                'required','alpha_dash','max:30',
                Rule::unique('users')->ignore(Auth::User()->id),
            ],
            'email' => [
                'required','email','max:40',
                Rule::unique('users')->ignore(Auth::User()->id),
            ],
        ));
                              
        $data = User::find(Auth::User()->id);
        
        $data->name = $request->name;
        $data->Designation = $request->Designation;
        $data->mobile = $request->mobile;
        $data->email = $request->email;
        //$data->mobile = $request->mobile;
        $data->save();
        Session::flash('success','Successfully Save');

        return redirect()->route('profile');
    }

    public function chengePassword(Request $request){
    	$this->validate($request, array(
            'CurrentPassword'=>'required|max:15',
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            ));

    	if(Hash::check($request->CurrentPassword, Auth::user()->password )){                      
	        $obj_user = User::find(Auth::User()->id);
	        $obj_user->password = Hash::make($request->password);
	        $obj_user->save();
            Session::flash('success', "Password chenged.");
	        return redirect()->back();            
    	}else{
            Session::flash('warning', "CurrentPassword does not match.");
    		return redirect()->back();
    	}

    } 



    public function createUser(Request $request, $role){
        $role = Role::where('slug', $role)->first();
        if ($request->isMethod('GET')) {
            $mode = 'create';
            return view('admin.users.createClub',compact('role','mode'));
        }
        if ($request->isMethod('POST')) {
            $this->validate($request, array(
                'name'=>'required|string|max:255',
                'email'=>'required|email|max:255|unique:users,email',
                'photo'=>['nullable','mimes:jpg,jpeg,png','max:5000'],
            ));

            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->otp = rand(000000,999999);
            $user->save();

            $user->roles()->attach($role->id);

            $photo = $request->file('photo');
            $full_path = '';
            if ($photo) {
                $filename = $user->id.'.'.$photo->extension();
                $full_path = 'users/'.$filename;
                $photo->storeAs('public/users/', $filename);
            }

            UserProfile::create(['user_id' => $user->id, 'photo' => $full_path]);

            //event(new NewUserRegistered($user));
            Mail::to($request->email)->send(new NewUserRegistered($user));
            Session::flash('success','Successfully Save');

            return redirect()->route('createUser',$role->slug);
        }
    }

    public function editUser(Request $request, $role, $id){
        $role = Role::where('slug', $role)->first();
        $user = User::find($id);
        if ($request->isMethod('GET')) {
            $mode = 'edit';
            return view('admin.users.createClub',compact('role','mode','user'));
        }
        if ($request->isMethod('POST')) {
            $this->validate($request, array(
                'name'=>'required|string|max:255',
                //'email'=>'required|email|max:255|unique:users,email',
                'email' => [
                    'required','email','max:40',
                    Rule::unique('users')->ignore($id),
                ],
                'photo'=>['nullable','mimes:jpg,jpeg,png','max:5000'],
            ));

            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();

            //$user->roles()->attach($role->id);

            $photo = $request->file('photo');
            $full_path = '';
            if ($photo) {
                $filename = $user->id.'.'.$photo->extension();
                $full_path = 'users/'.$filename;
                $photo->storeAs('public/users/', $filename);
                UserProfile::where('user_id', $user->id)->update(['photo' => $full_path]);
            }

            Session::flash('success','Successfully Save');

            return redirect()->back();
        }
    }

    public function createTeam(Request $request){
        if ($request->isMethod('GET')) {
            if(Auth::user()->hasAnyRole(['admin','staff'])){
                $clubs = $this->usersArray('club');
            }elseif(Auth::user()->hasRole('club')){
                $clubs = array(Auth::user()->id => Auth::user()->name);
            }
            $mode = 'create';
            return view('admin.users.createTeam',compact('mode','clubs'));
        }
        if ($request->isMethod('POST')) {
            $this->validate($request, array(
                'name'=>'required|string|max:255',
                'coachName'=>'required|string|max:255',
                'club_id'=>'required',
                'email'=>'required|email|max:255|unique:users,email',
                'photo'=>['nullable','mimes:jpg,jpeg,png','max:5000'],
            ));

            $user = new User;
            $user->name = $request->name;
            $user->coachName = $request->coachName;
            $user->club_id = $request->club_id;
            $user->email = $request->email;
            $user->otp = rand(000000,999999);
            $user->save();
            $role = Role::where('slug', 'team')->first();
            $user->roles()->attach($role->id);

            $photo = $request->file('photo');
            $full_path = '';
            if ($photo) {
                $filename = $user->id.'.'.$photo->extension();
                $full_path = 'users/'.$filename;
                $photo->storeAs('public/users/', $filename);
            }

            UserProfile::create(['user_id' => $user->id, 'photo' => $full_path]);

            //event(new NewUserRegistered($user));
            Mail::to($request->email)->send(new NewUserRegistered($user));
            Session::flash('success','Successfully Save');

            return redirect()->route('teamList');
        }
    }

    public function editTeam(Request $request, $id){
        $user = User::find($id);
        if ($request->isMethod('GET')) {
            if(Auth::user()->hasAnyRole(['admin','staff'])){
                $clubs = $this->usersArray('club');
            }elseif(Auth::user()->hasRole('club')){
                $clubs = array(Auth::user()->id => Auth::user()->name);
            }
            $mode = 'edit';
            return view('admin.users.createTeam',compact('mode','clubs','user'));
        }
        if ($request->isMethod('POST')) {
            $this->validate($request, array(
                'name'=>'required|string|max:255',
                'coachName'=>'required|string|max:255',
                'club_id'=>'required',
                //'email'=>'required|email|max:255|unique:users,email',
                'email' => [
                    'required','email','max:40',
                    Rule::unique('users')->ignore($id),
                ],
                'photo'=>['nullable','mimes:jpg,jpeg,png','max:5000'],
            ));

            $user->name = $request->name;
            $user->coachName = $request->coachName;
            $user->club_id = $request->club_id;
            $user->email = $request->email;
            $user->save();

            $photo = $request->file('photo');
            $full_path = '';
            if ($photo) {
                $filename = $user->id.'.'.$photo->extension();
                $full_path = 'users/'.$filename;
                $photo->storeAs('public/users/', $filename);
                UserProfile::where('user_id', $user->id)->update(['photo' => $full_path]);
            }

            Session::flash('success','Successfully Save');

            return redirect()->route('teamList');
        }
    }

    public function teamList(){
        $teams = User::whereNotNull('club_id');
        if(Auth::user()->hasAnyRole(['admin','staff'])){
            $teams = $teams->latest()->get();
        }elseif(Auth::user()->hasRole('club')){
            $teams = $teams->where('club_id',Auth::user()->id)->latest()->get();
        }
        //return $teams;
        return view('admin.users.teamList',compact('teams'));
    }

    public function confirm(Request $request){
        if ($request->isMethod('GET')) {
            return view('auth.confirm');
        }
        if ($request->isMethod('POST')) {
            //dd($request->otp); exit;
            $this->validate($request, array(
                'otp'=>'required|string|max:255|exists:users,otp',
                'password' => ['required', 'string', 'min:6', 'confirmed'],
            ));

            $user = User::where('otp',$request->otp)->first();
            $user->password = Hash::make($request->password);
            $user->otp = null;
            $user->save();

            if (Auth::attempt(['email'=>$user->email,'password'=>$request->password])) {
                // Authentication passed...
                return redirect()->route('dashboard');
            }

            return redirect()->back();
        }
    }

    
    public function teamApi(Request $request)
    {
        if(!empty($request->input('option'))){
            $input = $request->input('option');
            $users = User::where('club_id',$input);
            return \Response::make($users->get(['id', 'name']));
        }        
    }


    public function userList($role){
        $users = User::whereHas('roles', function($q) use ($role){
            $q->where('slug', $role);
        })->get();
        return view('admin.users.userList',compact('role','users'));
    }


    public function destroy(User $user)
    {
        //return $user->customers;

        if($user->teams->count() > 0  || $user->customers->count()>0 ){
            Session::flash('warning','Can`t deleted.');
        }else{
            $user->roles()->detach();
            $user->permissions()->detach();
            $user->delete();
        }

        return redirect()->back();
    }
}
