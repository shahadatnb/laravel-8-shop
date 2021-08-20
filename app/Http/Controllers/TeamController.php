<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Session;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas=Team::latest()->paginate(20);
        return view('admin.team.team', compact('datas'));
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

    public function create()
    {
        $clubs = $this->usersArray('club');
        $coach = $this->usersArray('coach');
        $mode='create';
        return view('admin.team.createOrEdit',compact('mode','clubs','coach'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
            'name'=>'required|max:255|unique:teams,name',
            'club_id'=>'required',
            'coach_id'=>'required',
            ));

        $data = new Team;
        $data->name = $request->name;
        $data->club_id = $request->club_id;
        $data->coach_id = $request->coach_id;
        $data->save();
        Session::flash('success','Successfully Save');
        return redirect()->route('team.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        //
    }
}
