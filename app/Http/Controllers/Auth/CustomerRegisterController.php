<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
//use App\Models\CustomerAddress;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;
use App\Mail\CustomerRegister;
use App\Http\Traits\userTrait;
use Session;
use Auth;

class CustomerRegisterController extends Controller
{
    use userTrait;
    
    public function index(){
        $customers = Customer::latest();
        if(Auth::user()->hasAnyRole(['admin','stuff'])){
            $customers = $customers->paginate(20);
        }elseif(Auth::user()->hasRole('club')){
            $teans = User::where('club_id',Auth::user()->id)->pluck('id')->toArray();
            $customers = $customers->whereIn('team_id',$teans)->paginate(20);
        }elseif(Auth::user()->hasRole('team')){
            $customers = $customers->where('team_id',Auth::user()->id)->paginate(20);
        }
        //return $teams;
        return view('admin.users.customerList',compact('customers'));
    }

    public function create(Request $request){
        if(Auth::user()->hasAnyRole(['admin','stuff'])){
            $clubs = $this->usersArray('club');
            $teams = array();
        }elseif(Auth::user()->hasRole('club')){
            $clubs = array();   //array(Auth::user()->id => Auth::user()->name);
            $teams = $this->teams(Auth::user()->id);
        }
        elseif(Auth::user()->hasRole('team')){
            $clubs = array(); //array(Auth::user()->club->id => Auth::user()->club->name);
            $teams = array(); //array(Auth::user()->id => Auth::user()->name);
        }
        $mode = 'create';
        return view('admin.users.createCustomer',compact('mode','clubs','teams'));        
    }

    public function store(Request $request){
        $this->validate($request, array(
            'first_name.*'=>'required|string|max:100',
            'last_name.*'=>'required|string|max:100',
            //'gender'=>'required|string|max:255',
            'team_id'=>'required',
            'email.*'=>'required|email|max:100|unique:customers,email',
        ));

        //return count($request->first_name);

        for ($i=0; $i < count($request->first_name); $i++) {
            $user = new Customer;
            $user->first_name = $request->first_name[$i];
            $user->last_name = $request->last_name[$i];
            //$user->gender = $request->gender;
            $user->team_id = $request->team_id;
            $user->email = $request->email[$i];
            $user->otp = rand(000000,999999);
            $user->save();

            //CustomerAddress::create(['customer_id'=>$user->id]);

            Mail::to($user->email)->send(new CustomerRegister($user));
        }

        //event(new NewUserRegistered($user));
        Session::flash('success','Successfully Save');

        return redirect()->route('player.index');
    }

    public function edit(Request $request, $id){
        $user = Customer::find($id);
        if(Auth::user()->hasAnyRole(['admin','stuff'])){
            $clubs = $this->usersArray('club');
            $user->club_id = $user->team->club->id;
            $teams = $this->teams($user->club_id);
        }elseif(Auth::user()->hasRole('club')){
            $clubs = array();   //array(Auth::user()->id => Auth::user()->name);
            $teams = $this->teams(Auth::user()->id);
        }
        elseif(Auth::user()->hasRole('team')){
            $clubs = array(); //array(Auth::user()->club->id => Auth::user()->club->name);
            $teams = array(); //array(Auth::user()->id => Auth::user()->name);
        }
        $mode = 'edit';
        return view('admin.users.createCustomer',compact('mode','user','clubs','teams'));        
    }

    public function update(Request $request, $id){
        $user = Customer::find($id);
        
        $this->validate($request, array(
            'first_name.*'=>'required|string|max:100',
            'last_name.*'=>'required|string|max:100',
            //'gender'=>'required|string|max:255',
            'team_id'=>'required',
            //'email.*'=>'required|email|max:100|unique:customers,email',
            'email' => [
                'required','email','max:40',
                Rule::unique('customers')->ignore($id),
            ],
        ));

                    
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        //$user->gender = $request->gender;
        $user->team_id = $request->team_id;
        $user->email = $request->email;
        $user->save();

        Session::flash('success','Successfully Save');

        return redirect()->route('player.index');
    }


    public function confirm(Request $request){
        if ($request->isMethod('GET')) {
            return view('auth.customer.confirm');
        }
        if ($request->isMethod('POST')) {
            //dd($request->otp); exit;
            $this->validate($request, array(
                'otp'=>'required|string|max:8|exists:customers,otp',
                'password' => ['required', 'string', 'min:6', 'confirmed'],
            ));

            $user = Customer::where('otp',$request->otp)->first();
            $user->password = Hash::make($request->password);
            $user->otp = null;
            $user->save();

            if (Auth::guard('customer')->attempt(['email'=>$user->email,'password'=>$request->password])) {
                // Authentication passed...
                return redirect()->route('customer./');
            }

            return redirect()->back();
        }
    }
    
    public function destroy($id)
    {
        $customer = Customer::find($id);
        //return $customer->orders;
        if($customer->orders->count() > 0){
            Session::flash('warning','Can`t deleted.');
        }else{
            $customer->roles()->detach();
            $customer->permissions()->detach();
            $customer->delete();
        }

        return redirect()->back();
    }

}
