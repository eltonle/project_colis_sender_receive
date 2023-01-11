<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Receive;
use Illuminate\Http\Request;

class ReceiveController extends Controller
{
    public function index()
    {
        $data['receives'] = Receive::all();
        return view('front.receives.index',$data);
    }
    public function create()
    { 
       
        return view('front.receives.create');
    }
    public function store(Request $request)
    {
        $category = new Receive();
        $category->nomr=$request->nomr;
        $category->prenomr=$request->prenomr;
        $category->emailr=$request->emailr;
        $category->addressr=$request->addressr;
        $category->phoner=$request->phoner;
        $category->created_by=Auth()->user()->id;
        $category->save();
        return redirect()->route('receives.index')->with('message','Recepteur enregistrer avec success...');
    }

    public function edit($id)
    {
        $data['edit'] = Receive::find($id);
        return view('front.receives.edit', $data);
    }

    public function update(Request $request,$id)
    {
        $receive = Receive::find($id);
        $receive->nomr=$request->nomr;
        $receive->prenomr=$request->prenomr;
        $receive->emailr=$request->emailr;
        $receive->addressr=$request->addressr;
        $receive->phoner=$request->phoner;
        $receive->updated_by=Auth()->user()->id;
        $receive->save();
        return redirect()->route('receives.index')->with('message','Recepteur mis a jour avec success...');
    }

    public function delete($id)
    {
        $receive = Receive::find($id);
        $receive->delete();
        return redirect()->route('receives.index')->with('error','Recepteur supprimer avec success...');
    }
}
