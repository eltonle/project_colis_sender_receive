<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ColisDimension;
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
    {    $today = date(format:'Ymd');
        $statut = "Iscrit";
        $numero_ids = Unit::where('numero_id','like',$today.'%')->pluck('numero_id');
         do {
            $numero_id= $today . rand(100000, 999999);
         } while ($numero_ids->contains($numero_id));
        $unit = new Unit();
        $unit->numero_id=$numero_id;
        $unit->name=$request->name;
        $unit->Date_chagement=$request->Date_chagement;
        $unit->statut=$statut;
        $unit->description=$request->description;
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
        $unit->Date_chagement=$request->Date_chagement;
        $unit->description=$request->description;
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
    public function chargementConteneur()
    {
        $colis = ColisDimension::with('invoice')->where('status', '1')->get();
        $conteneur = Unit::all();
        return view('front.units.chargement', compact('colis'));
    }
}
