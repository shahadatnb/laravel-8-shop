<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LocationCountry;
use App\Models\LocationState;

class LocationController extends Controller
{
        
    public function stateApi(Request $request)
    {
        if(!empty($request->option)){
            $input = $request->option;
            $country = LocationCountry::where('sortname',$input)->first();
            $state = LocationState::where('country_id',$country->id);
            return \Response::make($state->get(['id', 'name']));
        }        
    }
}
