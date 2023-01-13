<?php

namespace App\Http\Controllers\Backend;

use App\Models\State;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::all();
        return view('front.countries.index', compact('countries'));

    }
    public function create()
    { 
        return view('front.countries.create');
    }

    public function store(Request $request)
    {
        $country = new Country();
        $country->name = $request->name;
        $country->created_by=Auth()->user()->id;
        $country->save();
        return redirect()->route('countries.index')->with('message','Data saved successfully...');
    }
    public function edit($id)
    {
        $edit = Country::find($id);
        return view('front.countries.edit', compact('edit'));
    }

    public function update(Request $request,$id)
    {
        $country = Country::find($id);
        $country->name = $request->name;
        $country->updated_by = Auth()->user()->id;
        $country->save();
        return redirect()->route('countries.index')->with('message','Data update successfully...');
    }

    public function delete($id)
    {
        $country = Country::find($id);
        $country->delete();
        State::where('country_id',$country->id)->delete();
        return redirect()->route('countries.index')->with('error','Unit delete successffully...');
    }
}
