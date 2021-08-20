<?php
namespace App\Http\Traits;

use App\Models\User;
use App\Models\Customer;
use Auth;

trait userTrait {

    public function acList($acType){
        $users = User::whereHas('roles', function($q) use ($acType){
            $q->where('slug', $acType);
        })->get();

        return $users;
    }

    public function teamList($club){
        return User::where('club_id',$club)->get();
    }

    public function customerList($club){
        $teamList = $this->teamList($club)->pluck('id');
        //dd($teamList);
        return Customer::whereIn('team_id',$teamList)->get();         
    }

    public function usersArray($acType) {
        $userAll = $this->acList($acType);
        $users=array();
        foreach ($userAll as $data) {
            $users[$data->id]= $data->name;
        }
        return $users;
    }

    public function teams($club){
        //$club = User::with('role')->get();
        $club = User::where('club_id',$club)->get();
        $clubs = array();
        foreach ($club as $value) {
            $clubs[$value->id] = $value->name;
        }
        return $clubs;
    }

    public function agentBallance($id){
        $data = AgentWallet::where('agent_id',$id)->sum('receive');
        $data2 = AgentWallet::where('agent_id',$id)->sum('payment');
        return $data-$data2;
    }

    public function agentBallanceAll(){
        $data = AgentWallet::sum('receive');
        $data2 = AgentWallet::sum('payment');
        return $data-$data2;
    }

    public function todayReceive(){
        $data = AgentWallet::whereBetween('created_at', array(date('Y-m-d').' 00:00:00', date('Y-m-d').' 23:59:59'))->sum('payment');
        return $data;
    }

    public function todayPayment(){
        $data = AgentWallet::whereBetween('created_at', array(date('Y-m-d').' 00:00:00', date('Y-m-d').' 23:59:59'))->sum('receive');
        return $data;
    }
 

    public function systemUser(){
    	return User::count();
    }


}
