<?php

namespace App\Http\Controllers\Backend;

use App\Models\City;
use App\Models\State;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DropdownController extends Controller
{
    // public function index()
    // {
    //     // $data['countries']= Country::get(['name','id']);
    //     $countries= Country::get(['name','id']);
       
    //     return view('front.clients.create',compact('countries'));
    // }

    public function fetchStates(Request $request)
    {
        $data['states']=State::where('country_id',$request->country_id)->get(['name','id']);
       return response()->json($data);
    }

    public function fetchCity(Request $request)
    {
       $data['cities']=City::where('state_id',$request->state_id)->get(['name','id']);
       return response()->json($data);
    }

    public function fetchStates_r(Request $request)
    {
        $data['states']=State::where('country_id',$request->country_id_r)->get(['name','id']);
       return response()->json($data);
    }

    public function fetchCity_r(Request $request)
    {
       $data['cities']=City::where('state_id',$request->state_id_r)->get(['name','id']);
       return response()->json($data);
    }
}
