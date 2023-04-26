<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ColisDimension;
use App\Models\Entrepot;
use App\Models\Unit;
use App\Models\vehicule;
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
        $statut = "Non Charge";
       
        $unit = new Unit();
        $unit->name=$request->name;
        $unit->numero_id=$request->numero_id;
        $unit->date_chargement=$request->date_chargement;
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
        $unit->name = $request->name;
        $unit->numero_id = $request->numero_id;
        $unit->date_chargement = $request->date_chargement;
        $unit->statut = $request->statut;
        $unit->description = $request->description;
        $unit->updated_by = Auth()->user()->id;
        $unit->save();
        return redirect()->route('units.index')->with('message','Data update successfully...');
    }


    public function delete($id)
    {
        $Unit = Unit::find($id);
        $Unit->delete();
        return redirect()->route('units.index')->with('error','Package delete successffully...');
    }


    // public function CapacityRestante(Unit $unit)
    // {
    //     $totalWeight = $unit->colisDimensions->sum('weight');
    //     $resteCapacity = $unit->max_capacity - $totalWeight;
    //     return $resteCapacity;
    // }


    public function dechargement()
    {
        $vehicules = vehicule::all();
        return view('front.units.dechargement', compact('vehicules'));
    }

   // dechargement multiple
    public function dechargementSubmit(Request $request)
    {
        // Récupère les valeurs des champs
        $conteneurBarcode = $request->input('conteneur-barcode');
        $vehiculeId = $request->input('vehicule_id');
        $multipleCodes = $request->input('multiple-codes');
        $singlePackage = $request->input('single-code');
        // dd($conteneurBarcode, $vehiculeId, $multipleCodes, $singlePackage);

        // Recherche le conteneur par code-barres
        $conteneur = Unit::where('numero_id', $conteneurBarcode)->first();
        
        // Vérifie si le conteneur existe
        if ($conteneur) {
            // Met à jour le statut du conteneur
            $conteneur->statut = 'En cours de Dechargement';          
            $conteneur->save();
            
            // Recherche le véhicule par ID
            $vehicule = vehicule::find($vehiculeId);
            
            // Vérifie si le véhicule existe
            if ($vehicule) {
                // Met à jour le statut du véhicule
                $vehicule->status = 'En cours de Dechargement';
                $vehicule->save();
                
                // Traite les colis multiples
                if ($multipleCodes) {
                    $packageBarcodes = explode(',', $multipleCodes);
                    foreach ($packageBarcodes as $packageBarcode) {
                        // Recherche le colis par code-barres
                        $package = ColisDimension::where('code_zip', $packageBarcode)->first();
                        if ($package) {
                            // Met à jour le statut du colis
                            $package->status = '2';
                            $package->vehicule_id = $vehicule->id;
                            $package->decharge = '1';
                            $package->unit_id = '0';
                            $package->save();
                        }
                    }
                }
                
                // Traite le colis unique
                if ($singlePackage) {
                    // Recherche le colis par code-barres
                    $package = ColisDimension::where('code_zip', $singlePackage)->first();
                    if ($package) {
                        // Met à jour le statut du colis
                        $package->status = '2';
                        $package->vehicule_id = $vehicule->id;
                        $package->unit_id = '0';
                        $package->decharge = '1';
                        $package->save();
                    }
                }
                
                // Retourne une réponse JSON pour indiquer que la mise à jour a réussi
                return response()->json(['success' => true]);
            }
        }
        
        // Retourne une réponse JSON pour indiquer que la mise à jour a échoué
        return response()->json(['success' => false]);
    }


   public function chargementMix()
   {
    $units = Unit::all();
    return view('front.units.chargementMix', compact('units'));
   }

   // chargement multiple
   public function chargementMixSubmit(Request $request)
   {
       // Récupère les valeurs des champs
       $unitId = $request->input('unit_id');
       $multipleCodes = $request->input('multiple-codes');
       $singlePackage = $request->input('single-code');

       // Recherche le conteneur par code-barres
       $conteneur = Unit::where('id', $unitId)->first();
       
       // Vérifie si le conteneur existe
       if ($conteneur) {
           // Met à jour le statut du conteneur
           $conteneur->statut = 'En cours de Dechargement';          
           $conteneur->save();
           
           
           // Vérifie si le conteneur existe
           if ($conteneur) {
                         

                $count = 0;
                $codes = [];
                $codes_non_trouves = [];

               // Traite les colis multiples
               if ($multipleCodes) {
                   $packageBarcodes = explode(',', $multipleCodes);
                   foreach ($packageBarcodes as $packageBarcode) {
                       // Recherche le colis par code-barres
                       $package = ColisDimension::where('code_zip', $packageBarcode)->first();
                       if ($package) {
                            $package->unit_id = $conteneur->id;
                            $package->charge = 1;
                           $package->save();

                           $count++;
                            $codes[] = $packageBarcode;
                            
                       }else {
                        $codes_non_trouves[] = $packageBarcode;
                       }
                   }
               }
               
               // Traite le colis unique
               if ($singlePackage) {
                   // Recherche le colis par code-barres
                   $package = ColisDimension::where('code_zip', $singlePackage)->first();
                   if ($package) {
                       // Met à jour le statut du colis
                       $package->unit_id = $conteneur->id;
                       $package->charge = 1;
                       $package->save();

                       $count++;
                       $codes[] = $singlePackage;
                   }else {
                    $codes_non_trouves[] = $singlePackage;
                   }
               }
               
               // Retourne une réponse JSON pour indiquer que la mise à jour a réussi
               return response()->json([
                                 'count' => $count,
                                  'codes' => $codes,
                                  'codes_non_trouves' => $codes_non_trouves
                                ]);
           }
       }
       
       // Retourne une réponse JSON pour indiquer que la mise à jour a échoué
       return response()->json(['success' => false]);
   }
    
    public function voirConteneur(Unit $unit)
    {
        
        $colis = ColisDimension::with('invoice')->where('status', '1')->where('unit_id', null)->where('decharge', null)->get();
       
        return view('front.units.chargement', compact('colis','unit'));
    }

    public function voirConteneurScan(Unit $unit)
    {
       
        $colis = ColisDimension::with('invoice')->where('status', '1')->where('unit_id', null)->get();
       
        return view('front.units.chargementScan', compact('unit'));
    }


    public function voirConteneurDecharge($id)
    {
        
        $conteneur = Unit::findOrFail($id);
        $entrepots = Entrepot::all();
        $colis = $conteneur->colisDimensions;
      
       
        return view('front.units.dechargementView', compact('colis','conteneur','entrepots'));
    }


   


    public function chargementConteneur(Request $request, $id)
    {
        $unit = Unit::findOrFail($id);
        $unit -> statut = "En cours de Chargement";

        $unit -> save();
        $colis = ColisDimension::whereIn('id', $request->input('colis'))->get();
      
        foreach ($colis as $colisItem) {
            $colisItem->unit_id = $unit->id;
            $colisItem->charge = 1;
            $colisItem->save();
        }

        return redirect()->route('units.index', $unit)->with('message','Colis charge avec success....');

    }


    public function dechargementConteneur(Request $request, $id)
    {
        $unit = Unit::findOrFail($id);
        $unit -> statut = "En cours de Dechargement";
        
        $colis = ColisDimension::whereIn('id', $request->input('colis'))->get();
        
        $unit -> save();
      
        foreach ($colis as $colisItem) {
            $colisItem->unit_id = null;
            $colisItem->charge = 2;
            $colisItem->decharge = 1;
            $colisItem->entrepot_id = $request->entrepot_id;
            $colisItem->save();
        }

        return redirect()->route('units.index', $unit)->with('message','Colis Decharge avec success....');

    }



    public function chargementScannerConteneur(Request $request, $id)
    {
        $conteneur = Unit::findOrFail($id);

        // Valider le formulaire
        $request->validate([
            'codes_scannes' => 'required',
        ]);

        // Récupérer les codes scannés depuis le champ de formulaire
        $codesScannes = explode(PHP_EOL, $request->input('codes_scannes'));
        // dd($codesScannes);
        // Parcourir les codes scannés et vérifier s'ils existent dans la base de données
        foreach ($codesScannes as $codeScan) {
            $colis = ColisDimension::where('code_zip', $codeScan)->first();

            if (!$colis) {
                return redirect()->back()->with(['warning' => 'Le code-barre ' . $codeScan . ' n\'existe pas dans la base de données.'])->withInput();
            }

            // Vérifier si le colis est déjà chargé dans un autre conteneur
            if ($colis->unit_id && $colis->unit_id != $id) {
                return redirect()->back()->with(['info' => 'Le colis ' . $colis->code_zip . ' est déjà chargé dans le conteneur ' . $colis->conteneur->name . ' № ' . $colis->conteneur->numero_id. '.'])->withInput();
            }

            // Mettre à jour le statut du colis et l'associer au conteneur
            $colis->charge = 1;
            $colis->unit_id = $conteneur->id;
            $colis->save();
        }

        // Rediriger vers la page de détail du conteneur  ['unit' => $unit->id]
        return redirect()->route('units.showScan', ['unit' => $conteneur->id])->with('message', 'Le chargement des colis a été enregistré avec succès.');
    }



    // public function changerStatutConteneur(Request $request,$id)
    // {
        
    //     // $conteneurId = $request->input('conteneur_id');
    //       $conteneur = Unit::find($id);
        
    //     $conteneur->statut = $request->statut; 
    //     $conteneur->save();

    //     return response()->json();
    // }
    public function changerStatutConteneur($id)
    {
         
        $conteneur = Unit::find($id);
        $conteneur->statut = 'Ferme';
        $conteneur->save();

        return response()->json(['success' => true]);
    }

}
