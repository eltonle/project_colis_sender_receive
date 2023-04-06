<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\ColisDimension;
use App\Http\Controllers\Controller;
use App\Models\ColisStandard;
use PDF;
class ColisController extends Controller
{
    public function index()
    {
        $colis = ColisDimension::with('invoice')->where('status', '1')->get();
        return view("front.colis.index", compact('colis'));
    }
  
    public function detailsColis ($id)
    {
        
        $colis = ColisDimension::with(['invoice.payement.customer','invoice.payement.receive'])->findOrFail($id);

        return response()->json([
            'id' => $colis->id,
            'titre' => $colis->titre,
            'largeur' => $colis->largeur,
            'longueur' => $colis->longueur,
            'hauteur' => $colis->hauteur,
            'description' => $colis->description,
            'type' => $colis->type,
            'poids' => $colis->poids,
            'prix' => $colis->prix,
             'customer_full_name' => $colis->invoice->payement->customer->nom . ' ' . $colis->invoice->payement->customer->prenom,
             'email' => $colis->invoice->payement->customer->email,
             'address' => $colis->invoice->payement->customer->address,
             'phone' => $colis->invoice->payement->customer->phone,
             'customer_full_namer' => $colis->invoice->payement->receive->nom . ' ' . $colis->invoice->payement->receive->prenom,
             'emailr' => $colis->invoice->payement->receive->email,
             'addressr' => $colis->invoice->payement->receive->address,
             'phoner' => $colis->invoice->payement->receive->phone,
        ]);
    }

    public function printColis($id)
    {
        // dd('ok');
        $data['colis'] = ColisDimension::with(['invoice'])->find($id);
       
        $pdf = PDF::loadView('front.pdf.colis-etiquette-pdf', $data);
        $pdf->SetProtection(['copy','print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }




    // ROUTE COLIS STANDARD
    public function listeColisStandard()
    {
        $colisStandard = ColisStandard::all();
        return view('front.colis.ListeColisStandard',compact('colisStandard'));
    }
    public function editerColisStandard($id)
    {
        $colisStandardEdit = ColisStandard::find($id);
        return view('front.colis.editColisStandard',compact('colisStandardEdit'));
    }


    public function createColisStandard()
    {
        return view('front.colis.createColisStandard');
    }

    public function updateColisStandard(Request $request,$id)
    {
        $colis = ColisStandard::find($id);
        $colis -> titre = $request->name;
        $colis -> longueur = $request->longueur;
        $colis -> largeur = $request->largeur;
        $colis -> hauteur = $request->hauteur;
        $colis -> prix = $request->prix;
        // $colis -> poids = $request->poids;
        $colis -> description = $request->description;
        $colis->save();
         return redirect()->route('colis.listes')->with('message','Data update successfully...');
       
    }
    public function storeColisStandard(Request $request)
    {
          
            $colis = new ColisStandard();
            $colis->titre=$request->titre;
            $colis->longueur=$request->longueur;
            $colis->largeur=$request->largeur;
            $colis->hauteur=$request->hauteur;
            $colis->poids=$request->poids;
            $colis->description=$request->description;
            $colis->prix=$request->prix;
            $colis->save();
          return redirect()->route('colis.listes')->with('message','Data saved successfully...');
       
    }


    public function deleteColisStandard($id)
    {
        $colis = ColisStandard::find($id);
        $colis->delete();
        return redirect()->route('colis.listes')->with('error','Package delete successffully...');
    }
}
