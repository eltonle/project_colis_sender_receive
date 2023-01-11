<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index()
    {
        $units = Unit::all();
        return view('front.units.index', compact('units'));

    }
    public function create()
    { 
        return view('front.units.create');
    }

    public function store(Request $request)
    {
        $unit = new Unit();
        $unit->name=$request->name;
        $unit->numero_id=$request->numero_id;
        $unit->created_by=Auth()->user()->id;
        $unit->save();
        return redirect()->route('units.index')->with('message','Data saved successfully...');
    }
    public function edit($id)
    {
        $edit = Unit::find($id);
        return view('front.units.edit', compact('edit'));
    }

    public function update(Request $request,$id)
    {
        $unit = Unit::find($id);
        $unit->name=$request->name;
        $unit->numero_id=$request->numero_id;
        $unit->updated_by=Auth()->user()->id;
        $unit->save();
        return redirect()->route('units.index')->with('message','Data update successfully...');
    }

    public function delete($id)
    {
        $Unit = Unit::find($id);
        $Unit->delete();
        return redirect()->route('units.index')->with('error','Package delete successffully...');
    }
}
