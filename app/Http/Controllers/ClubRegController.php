<?php

namespace App\Http\Controllers;

use App\Models\ClubReg;
use Illuminate\Http\Request;

class ClubRegController extends Controller
{
    public function index()
    {
        $users = ClubReg::latest()->get();//->paginate(50);
        return view('admin.club.clubList',compact('users'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(ClubReg $clubReg)
    {
        //
    }

    public function edit(ClubReg $clubReg)
    {
        //
    }

    public function update(Request $request, ClubReg $clubReg)
    {
        //
    }

    public function destroy(ClubReg $clubReg)
    {
        $clubReg->delete();
        session()->flash('success','Successfully deleted.');
        return redirect()->back();
    }
}
