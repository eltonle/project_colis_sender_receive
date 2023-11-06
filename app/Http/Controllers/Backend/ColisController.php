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
        $colis = ColisDimension::with('invoice')->orderBy('created_at', 'desc')
                                                 ->where('status', '1')
                                                 ->where('livre','!=', '1')
                                                 ->get();
        return view("front.colis.index", compact('colis'));
    }
    public function indexLivre()
    {
        $colis = ColisDimension::with('invoice')->orderBy('created_at', 'desc')
                                                 ->where('status', '1')
                                                 ->where('livre', '1')
                                                 ->get();
        return view("front.colis.indexLivre", compact('colis'));
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

   
    //HISTORIQUES MOUVEMENTS COLIS
    public function mouvementColis($colis_id) 
    { 
        $colis = ColisDimension::with('historiques_colis.entrepotDepart', 'historiques_colis.entrepotArrive')->find($colis_id);
        $colis1 = ColisDimension::find($colis_id);
        $conteneurs = $colis1->conteneurs_historiques;
       
        
        $historiques = [];
    
        foreach ($colis->historiques_colis as $historique) {
            $entrepotDepart = $historique->entrepotDepart;
            $entrepotArrive = $historique->entrepotArrive;
    
            // Ajoutez les entrepôts de départ et d'arrivée à un tableau
            $historiques[] = [
                'entrepotDepart' => $entrepotDepart,
                'entrepotArrive' => $entrepotArrive,
                'date_action'=> $historique
            ];
        }
    
        // Renvoyez le tableau des historiques au format JSON
        return response()->json([['historiques' => $historiques, 'conteneurs' => $conteneurs], 'colis'=> $colis1]);
        // return response()->json(['historiques' => $historiques]);
        
    }
    // //HISTORIQUES MOUVEMENTS COLIS
    // public function mouvementColis($colis_id) 
    // { 
    //     $colis1 = ColisDimension::with('historiques_colis.entrepotDepart', 'historiques_colis.entrepotArrive')->find($colis_id);

    //     $historiques = [];
    
    //     foreach ($colis1->historiques_colis as $historique) {
    //         $entrepotDepart = $historique->entrepotDepart;
    //         $entrepotArrive = $historique->entrepotArrive;
    
    //         // Ajoutez les entrepôts de départ et d'arrivée à un tableau
    //         $historiques[] = [
    //             'entrepotDepart' => $entrepotDepart,
    //             'entrepotArrive' => $entrepotArrive,
    //             'date_action'=> $historique
    //         ];
    //     }
    
    //     // Renvoyez le tableau des historiques au format JSON
    //     return response()->json(['historiques' => $historiques]);
        
    // }


    // ROUTE COLIS STANDARD
    public function listeColisStandard()
    {
        $colisStandard = ColisStandard::where('nature', 'Colis Normal')->get();
        $colisStandardVoiture = ColisStandard::where('nature', 'Colis Voiture')->get();
        $colisStandardCamion = ColisStandard::where('nature', 'Colis Camion')->get();
        return view('front.colis.ListeColisStandard',compact('colisStandard','colisStandardVoiture','colisStandardCamion'));
    }

    public function editerColisStandard($id)
    {
        $colisStandardEdit = ColisStandard::find($id);
        return view('front.colis.editColisStandard',compact('colisStandardEdit'));
    }

    public function editerColisStandardVoiture($id)
    {
        $colisStandardEditVoiture = ColisStandard::find($id);
        return view('front.colis.editColisStandardVoiture',compact('colisStandardEditVoiture'));
    }

    public function editerColisStandardCamion($id)
    {
        $colisStandardEditCamion = ColisStandard::find($id);
        return view('front.colis.editColisStandardCamion',compact('colisStandardEditCamion'));
    }


    public function createColisStandard()
    {
        return view('front.colis.createColisStandard');
    }

    public function createColisStandardVoiture()
    {
        return view('front.colis.createColisStandardVoiture');
    }

    public function createColisStandardCamion()
    {
        return view('front.colis.createColisStandardCamion');
    }

    

    public function updateColisStandard(Request $request,$id)
    {
        $colis = ColisStandard::find($id);
        $colis -> titre = $request->name;
        $colis -> longueur = $request->longueur;
        $colis -> largeur = $request->largeur;
        $colis -> hauteur = $request->hauteur;
        $colis -> prix = $request->prix;
        $colis -> description = $request->description;
        $colis->save();
         return redirect()->route('colis.listes')->with('message','Data update successfully...');
       
    }

    public function updateColisStandardVoiture(Request $request,$id)
    {
        $colis = ColisStandard::find($id);
        $colis -> titre = $request->titre;
        $colis -> type = $request->type;
        $colis -> capacite = $request->capacite;
        $colis -> prix = $request->prix;
        $colis -> description = $request->description;
        $colis->save();
         return redirect()->route('colis.listes')->with('message','Data update successfully...');
       
    }

    public function updateColisStandardCamion(Request $request,$id)
    {
        $colis = ColisStandard::find($id);
        $colis -> titre = $request->titre;
        $colis -> type = $request->type;
        $colis -> longueur = $request->longueur;
        $colis -> capacite = $request->capacite;
        $colis -> prix = $request->prix;
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
            $colis->prix=$request->prix;
            $colis->description=$request->description;
            $colis->nature = "Colis Normal";
            $colis->save();
          return redirect()->route('colis.listes')->with('message','Data saved successfully...');
       
    }

    public function storeColisStandardVoiture(Request $request)
    {
          
            $colis = new ColisStandard();
            $colis->titre=$request->titre;
            $colis->type=$request->type;
            $colis->capacite=$request->capacite;
            $colis->prix=$request->prix;
            $colis->description=$request->description;
            $colis->nature = "Colis Voiture";
            $colis->save();
          return redirect()->route('colis.listes')->with('message','Data saved successfully...');
       
    }


    public function storeColisStandardCamion(Request $request)
    {
          
            $colis = new ColisStandard();
            $colis->titre=$request->titre;
            $colis->type=$request->type;
            $colis->capacite=$request->capacite;
            $colis->longueur=$request->longueur;
            $colis->prix=$request->prix;
            $colis->description=$request->description;
            $colis->nature = "Colis Camion";
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
