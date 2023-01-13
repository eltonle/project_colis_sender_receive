<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;

class StateController extends Controller
{ 
    public function index()
    {
        $states = State::all();
        return view('front.states.index', compact('states'));

    }
    public function create()
    { 
        $countries = Country::all();
        return view('front.states.create',compact('countries'));
    }

    public function store(Request $request)
    {
        $state = new State();
        $state->name=$request->name;
        $state->country_id=$request->country_id;
        $state->created_by=Auth()->user()->id;
        $state->save();
        return redirect()->route('states.index')->with('message','Data saved successfully...');
    }
    public function edit($id)
    {
        $edit = State::find($id);
        $countries = Country::all();
        return view('front.states.edit', compact('edit','countries'));
    }

    public function update(Request $request,$id)
    {
        // dd($request->all());
        $state = State::find($id);
        $state->name = $request->name;
        $state->country_id = $request->country_id;
        $state->updated_by = Auth()->user()->id;
        $state->save();
        return redirect()->route('states.index')->with('message','Data update successfully...');
    }

    public function delete($id)
    {
        $state = State::find($id);
        $state->delete();
        return redirect()->route('states.index')->with('error','ville supprimee ...');
    }
}
