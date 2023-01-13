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

   //  public function fetchStates(Request $request)
   //  {
   //      $data['states']=State::where('country_id',$request->country_id)->get(['name','id']);
   //     return response()->json($data);
   //  }

   //  public function fetchCity(Request $request)
   //  {
   //     $data['cities']=City::where('state_id',$request->state_id)->get(['name','id']);
   //     return response()->json($data);
   //  }

   //  public function fetchStates_r(Request $request)
   //  {
   //      $data['states']=State::where('country_id',$request->country_id_r)->get(['name','id']);
   //     return response()->json($data);
   //  }

   //  public function fetchCity_r(Request $request)
   //  {
   //     $data['cities']=City::where('state_id',$request->state_id_r)->get(['name','id']);
   //     return response()->json($data);
   //  }

     // route ajax country
    
     public function getStates(Request $request)
     {
      $country_id = $request->country_id;
      $allState = State::where('country_id',$country_id)->get();
      return response()->json($allState);
     }
     public function getStatesReceive(Request $request)
     {
      $countryr_id = $request->countryr_id;
      $allStateR = State::where('country_id',$countryr_id)->get();
      return response()->json($allStateR);
     }
}
