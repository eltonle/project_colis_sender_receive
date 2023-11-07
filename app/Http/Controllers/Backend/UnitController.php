<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ColisDimension;
use App\Models\Entrepot;
use App\Models\HistoriqueColisEntrepot;
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


    public function showColiste($id)
    {
        $unit = Unit::find($id);
        return view('front.units.showcolis',compact('unit'));
    }


    public function dechargement()
    {
        $entrepots = Entrepot::all();
        $units = Unit::all();
        return view('front.units.dechargement', compact('entrepots','units'));
    }

   // DECHARGEMENT MULTIPLE AVEC FICHIER TEXT
    public function dechargementSubmit(Request $request)
    {
        // Récupère les valeurs des champs
        $conteneur_id = $request->input('conteneur_id');
        $entrepotId = $request->input('entrepot_id');
        $multipleCodes = $request->input('codes_scannes');
        $singlePackage = $request->input('single-code');

        // Recherche le conteneur par code-barres
        $conteneur = Unit::where('id', $conteneur_id)->first();
        
        // Vérifie si le conteneur existe
        if ($conteneur&&$multipleCodes&&$entrepotId || $conteneur&&$singlePackage&&$entrepotId ) {
            
            
            $count = 0;
            $codes = [];
            $codes_non_trouves = [];
                
                // Traite les colis multiples
                if ($multipleCodes) {
                    $packageBarcodes = explode(',', $multipleCodes);
                    foreach ($packageBarcodes as $packageBarcode) {
                        // Recherche le colis par code-barres
                        $package = ColisDimension::where('code_zip', $packageBarcode)->where('livre', '0')->first();
                        if ($package) {
                            $colisId= $package->id;

                            $conteneur->colis_historiques()->attach($colisId, [
                                'status' => 'Dechargé',
                                'date_action' => now(),
                            ]);

                             // Enregistrez l'historique du mouvement
                            HistoriqueColisEntrepot::create([
                                'colis_id' =>$colisId,
                                'entrepot_depart_id' => 0,
                                'entrepot_arrive_id' => $entrepotId,
                                'date_action' => now(),
                            ]);

                            $conteneur->colis()->detach($colisId);
                            // Met à jour le statut du colis
                            $package->status = '1';
                            $package->entrepot_id = $entrepotId;
                            $package->charge = 2;
                            $package->decharge = 1;
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
                    $package = ColisDimension::where('code_zip', $singlePackage)->where('livre', '0')->first();
                    if ($package) {
                        $colisId = $package->id;

                        $conteneur->colis_historiques()->attach($colisId, [
                            'status' => 'Dechargé',
                            'date_action' => now(),
                        ]);
                        
                         // Enregistrez l'historique du mouvement
                         HistoriqueColisEntrepot::create([
                            'colis_id' =>$colisId,
                            'entrepot_depart_id' => 0,
                            'entrepot_arrive_id' => $entrepotId,
                            'date_action' => now(),
                        ]);

                        $conteneur->colis()->detach($colisId);
                        // Met à jour le statut du colis
                        $package->status = '1';
                        $package->entrepot_id = $entrepotId;                       
                        $package->charge = 2;
                        $package->decharge = 1;
                        $package->save();
                        $count++;
                        $codes[] = $packageBarcode;
                    }else {
                     $codes_non_trouves[] = $singlePackage;
                    }
                }
                // Met à jour le statut du conteneur
                $conteneur->statut = 'En cours de Dechargement';          
                $conteneur->save();
                // Retourne une réponse JSON pour indiquer que la mise à jour a réussi
               return response()->json([
                                 'count' => $count,
                                  'codes' => $codes,
                                  'codes_non_trouves' => $codes_non_trouves
                                ],200);
            
        }else{
          // Retourne une réponse JSON pour indiquer que la mise à jour a échoué
        return response()->json(['error' => 'Veuillez remplir les bonnes informations'],400);
        }
        
        
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
       $multipleCodes = $request->input('codes_scannes');
       $singlePackage = $request->input('single-code');

       // Recherche le conteneur par code-barres
       $conteneur = Unit::where('id', $unitId)->first();
       
       // Vérifie si le conteneur existe
       if ($conteneur&&$multipleCodes&&$unitId || $conteneur&&$singlePackage&&$unitId) {
                          
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
                       $package = ColisDimension::where('code_zip', $packageBarcode)->where('livre', '0')->first();
                       
                       if ($package) {
                           $colisId = $package->id;

                        $conteneur->colis_historiques()->attach($colisId, [
                            'status' => 'Chargé',
                            'date_action' => now(),
                        ]);

                        $conteneur->colis()->attach($colisId, [
                            'date' => now(),
                        ]);
                       
                        $colis = ColisDimension::find($colisId);
                        if ($colis) {
                            $colis->charge = 1;
                            $colis->status = '1';
                            $colis->save();
                        }

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
                   $package = ColisDimension::where('code_zip', $singlePackage)->where('livre', '0')->first();
                   if ($package) {
                       $colisId = $package->id;

                    $conteneur->colis_historiques()->attach($colisId, [
                        'status' => 'Chargé',
                        'date_action' => now(),
                    ]);
                    $conteneur->colis()->attach($colisId, [
                        'date' => now(),
                    ]);
                
                    $colis = ColisDimension::find($colisId);
                    if ($colis) {
                        $colis->charge = 1;
                        $colis->status = '1';
                        $colis->save();
                    }

                       $count++;
                       $codes[] = $singlePackage;
                   }else {
                    $codes_non_trouves[] = $singlePackage;
                   }
               }
               // Met à jour le statut du conteneur
                $conteneur->statut = 'En cours de chargement';          
                $conteneur->save();
               // Retourne une réponse JSON pour indiquer que la mise à jour a réussi
               return response()->json([
                                 'count' => $count,
                                  'codes' => $codes,
                                  'codes_non_trouves' => $codes_non_trouves
                                ],200);
           }
       }else{
          // Retourne une réponse JSON pour indiquer que la mise à jour a échoué
          return response()->json(['error' => 'Veuillez remplir les bonnes informations'],400);
       }
       
       
   }
    
    public function voirConteneur(Unit $unit) 
    {
        
        $colis = ColisDimension::with('invoice')->where('status', '1')->where('charge', 0)->where('decharge', null)->get();
       
        return view('front.units.chargement', compact('colis','unit'));
    }

    public function voirConteneurScan(Unit $unit)
    {
       
        // $colis = ColisDimension::with('invoice')->where('status', '1')->where('unit_id', null)->get();
       
        return view('front.units.chargementScan', compact('unit'));
    }

 
    public function voirConteneurDecharge($id)
    {
        
        $conteneur = Unit::findOrFail($id);
        $entrepots = Entrepot::all();
        $colis = $conteneur->colis;
       
        return view('front.units.dechargementView', compact('colis','conteneur','entrepots'));
    }// END METHOD

    public function voirConteneurDechargeScan($id)
    {
        
        $unit = Unit::findOrFail($id);
        $entrepots = Entrepot::all();
        $colis = $unit->colis;
       
        return view('front.units.dechargementViewScan', compact('colis','unit','entrepots'));
    } //END METHOD


   

    //  CHARGEMENT AVEC CHECKBOX
    public function chargementConteneur(Request $request, $id) 
    { 
        // dd($request->all());
        $unit = Unit::findOrFail($id);
        if (!$unit) {
            return redirect()->back()->with('error', 'Conteneur non trouvé.');
        }

       

        $colisId = $request->input('colis');
      
        foreach ($colisId as $colisItem) {
            $unit->colis()->attach($colisItem, [
                'date' => now(),
            ]);
            $unit->colis_historiques()->attach($colisItem, [
                'status' => 'Chargé',
                'date_action' => now(),
            ]);
            // $colisItem->unit_id = $unit->id;
            $colis = ColisDimension::find($colisItem);
            if ($colis) {
                $colis->charge = 1;
                $colis->status = '1';
                $colis->save();
            }
            
        }
        $unit -> statut = "En cours de Chargement";
        $unit -> save();
        return redirect()->route('units.index', $unit)->with('message','Colis charge avec success....');

    }
   
    //  DECHARGEMENT AVEC CHECKBOX
    public function dechargementConteneur(Request $request, $id)
    {
        $unit = Unit::findOrFail($id); 
        if (!$unit) {
            return redirect()->back()->with('error', 'Conteneur non trouvé.');
        }
       
        // Obtenez les ID des colis à détacher à partir du formulaire
        $colisIds = $request->input('colis', []);
        // Détachez les colis du conteneur
        $unit->colis()->detach($colisIds);

      // Mettez à jour le statut des colis si nécessaire
      foreach ($colisIds as $colisItem) {
        $colis = ColisDimension::find($colisItem);

        $unit->colis_historiques()->attach($colisItem, [
            'status' => 'Dechargé',
            'date_action' => now(),
        ]);

            if ($colis) {
                $colis->status = '1'; // Ou tout autre statut approprié
                $colis->charge = 2;
                $colis->decharge = 1;
                $colis->entrepot_id = $request->entrepot_id;
                $colis->save();
            }
            // Enregistrez l'historique du mouvement
            HistoriqueColisEntrepot::create([
                'colis_id' => $colisItem,
                'entrepot_depart_id' => 0,
                'entrepot_arrive_id' => $request->entrepot_id,
                'date_action' => now(),
            ]);
        }
        $unit -> statut = "En cours de Dechargement";                
        $unit -> save();

        return redirect()->route('units.index', $unit)->with('message','Colis Decharge avec success....');

    }

    // ICI TELECHARGER FICHIER TEXT
    public function uploadFile(Request $request)
    {
        if ($request->hasFile('fichier')) {
            $file = $request->file('fichier');
            $contents = file_get_contents($file->getRealPath());
            
            // Traitez les données du fichier ici
           // Stockez les données du fichier dans une variable de session
          $request->session()->flash('fileContents', $contents);

        return redirect()->back()->with('message', 'Fichier téléchargé avec succès.');
        
        } else {
            return redirect()->back()->with('error', 'Aucun fichier sélectionné.');
        }
    } //END METHOD

    
    // ICI CHARGEMENT A TRAVERS CODE FICHIERS
    public function chargementScannerConteneur(Request $request, $id)
    {
        $unit = Unit::findOrFail($id);
       
        // Récupérer les codes scannés depuis le champ de formulaire
        $codesScannes = explode(',', $request->input('codes_scannes'));
        
        // Parcourir les codes scannés et vérifier s'ils existent dans la base de données
        foreach ($codesScannes as $codeScan) {
            $colis = ColisDimension::where('code_zip', $codeScan)->where('livre', '0')->first();
            $colisItem = $colis->id;

            $unit->colis_historiques()->attach($colisItem, [
                'status' => 'Chargé',
                'date_action' => now(),
            ]);
            if (!$colis) {
                return redirect()->back()->with(['warning' => 'Le code-barre ' . $codeScan . ' n\'existe ou deja livré.'])->withInput();
            }

            
            $unit->colis()->attach($colisItem, [
                'date' => now(),
            ]);
            
            $colis = ColisDimension::find($colisItem);
            if ($colis) {
                $colis->charge = 1;
                $colis->status = '1';
                $colis->save();
            }


        }
        $unit -> statut = "En cours de chargement";                
        $unit -> save();
        // Rediriger vers la page de détail du conteneur  ['unit' => $unit->id]
        return redirect()->route('units.showScan', ['unit' => $unit->id])->with('message', 'Le chargement des colis effectues ✅');
    }//END METHOD

    
    

    // ICI DECHARGEMENT A TRAVERS CODE FICHIERS
    public function dechargementScannerConteneur(Request $request, $id)
    {
        $unit = Unit::findOrFail($id);
        if (!$unit) {
            return redirect()->back()->with('error', 'Conteneur non trouvé.');
        }
        
        // Récupérer les codes scannés depuis le champ de formulaire
        $codesScannes = explode(',', $request->input('codes_scannes'));
        // Parcourir les codes scannés et vérifier s'ils existent dans la base de données
        foreach ($codesScannes as $codeScan) {
            $colis = ColisDimension::where('code_zip', $codeScan)->where('livre', '0')->first();
            if (!$colis) {
                return redirect()->back()->with(['warning' => ' Code-barre inexistant 📛'])->withInput();
            }
            $colisItem = $colis->id;

            $unit->colis_historiques()->attach($colisItem, [
                'status' => 'Decharge',
                'date_action' => now(),
            ]);

            $unit->colis()->detach($colisItem); //ICIC
            
            $colis = ColisDimension::find($colisItem);
            if ($colis) {
                $colis->status = '1'; // Ou tout autre statut approprié            
                $colis->charge = 2;
                $colis->decharge = 1;
                $colis->entrepot_id = $request->entrepot_id;
                $colis->save();
            }
             // Enregistrez l'historique du mouvement
             HistoriqueColisEntrepot::create([
                'colis_id' => $colis->colisItem,
                'entrepot_depart_id' => 0,
                'entrepot_arrive_id' => $request->entrepot_id,
                'date_action' => now(),
            ]);


        }
        $unit -> statut = "En cours de Dechargement";                
        $unit -> save();

        return redirect()->route('units.showDechargeScan', ['unit' => $id])->with('message', 'Le dechargement des colis effectues ✅');
    }//END METHOD



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

// a supprimer
    public function updateUnitStatus(Request $request)
    {
        $unit = Unit::find($request->input('unit_id'));

        if ($unit) {
            $unit->statut = $request->input('status');
            $unit->updated_by = auth()->user()->id;
            $unit->save();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'error' => 'Container not found']);
        }
    }

}
