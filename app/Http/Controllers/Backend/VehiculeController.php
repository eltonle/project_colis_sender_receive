<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Vehicule;
use App\Models\affectation;
use App\Models\chauffeur;
use App\Models\ColisDimension;
use Illuminate\Http\Request;
use DB;

class VehiculeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $edit = null;
        $vehicules = Vehicule::all();


        return view('front.cars.index', compact('vehicules'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('front.cars.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Vehicule::create([
            'Immatriculation' => $request->input('Immatriculation'),
            'Model' => $request->input('Model'),
            'Type_Véhicule' => $request->input('Type_Véhicule'),
            'Numero_Serie' => $request->input('Numero_Serie'),
            'status' => $request->input('status'),
            'Description' => $request->input('Description'),

        ]);
        return redirect()->route('vehicule.index')->with('message', 'Vehicule enregistrer avec success...');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vehicule  $vehicule
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicule $vehicule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vehicule  $vehicule
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $edit = Vehicule::find($id);
        return view('front.cars.index', compact('edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vehicule  $vehicule
     * @return \Illuminate\Http\Response
     */
    public function update_vehicule(Request $request)
    {

        DB::beginTransaction();
        try {
            $update = [
                'Immatriculation' => $request->Immatriculation,
                'Model' => $request->Model,
                'Type_Véhicule' => $request->Type_Véhicule,
                'Numero_Serie' => $request->Numero_Serie,
                'status' => $request->status,
                'Description' => $request->Description,
            ];
            Vehicule::where("id", $request->id)->update($update);
            DB::commit();
            return redirect()->route('vehicule.index')->with('message', 'Vehicule mis a jour avec success...');
        } catch (\Exeption $e) {
            DB::rollback();

            return redirect()->route('vehicule.index')->with('message', 'fail');
        }

        /*
        $vehicule =Vehicule::find($id);
        $vehicule->Immatriculation=$request->Immatriculation;
        $vehicule->Model=$request->Model;
        $vehicule->Type_Véhicule=$request->Type_Véhicule;
        $vehicule->Numero_Serie=$request->Numero_Serie;
        $vehicule->status=$request->status;
        $vehicule->Description=$request->Description;
        $vehicule->save();
        return view('front.cars.index', compact('vehicule'));
       
        return redirect()->route('vehicule.index')->with('message','Vehicule mis a jour avec success...');
     
        */
    }
    public function updateAffectation(Request $request)
    {

        DB::beginTransaction();
        try {
            $update = [
                'vehicule_id' => $request->vehicule_id,
                'chauffeur_id' => $request->chauffeur_id,
                'dateDebut' => $request->dateDebut,
                'dateFin' => $request->dateFin,

            ];
            Affectation::where("id", $request->id)->update($update);
            DB::commit();
            return redirect()->route('vehicule.affectation')->with('message', 'Vehicule mis a jour avec success...');
        } catch (\Exeption $e) {
            DB::rollback();

            return redirect()->route('vehicule.affectation')->with('message', 'faill');
        }
    }

    public function delete($id)
    {
        $vehicule = Vehicule::find($id);
        $vehicule->delete();
        return redirect()->route('vehicule.index')->with('error', 'client supprimer avec success...');
    }

    public function deleteAffectation($id)
    {
        $affectation = Affectation::find($id);
        $affectation->delete();
        return redirect()->route('vehicule.affectation')->with('error', 'client supprimer avec success...');
    }

    //affectation
    public function index_affectation()
    {

        $affectations = Affectation::with('chauffeur', 'vehicule')->get();
        $vehicules = Vehicule::all();
        $chauffeurs = Chauffeur::all();
        return view('front.cars.affectation', compact('affectations', 'chauffeurs', 'vehicules'));
    }

    public function add_affectation(Request $request)
    {

        $affectation = new Affectation();

        $affectation->vehicule_id = $request->vehicule_id;
        $affectation->chauffeur_id = $request->chauffeur_id;
        $affectation->dateDebut = $request->dateDebut;
        $affectation->dateFin = $request->dateFin;
        $affectation->created_by = Auth()->user()->id;
        $affectation->save();
        return redirect()->route('vehicule.affectation')->with('message', 'Data saved successfully...');
    }


    public function chauffeur(Request $request)
    {

        $chauffeur = new Chauffeur();

        $chauffeur->nom = $request->nom;
        $chauffeur->prenom = $request->prenom;
        $chauffeur->email = $request->email;
        $chauffeur->address = $request->address;
        $chauffeur->phone = $request->phone;
        $chauffeur->created_by = Auth()->user()->id;
        $chauffeur->save();
        return redirect()->route('vehicule.index')->with('message', 'Data saved successfully...');
    }


    public function select_chauffeur()
    {

        $vehicules = Vehicule::all();
        $chauffeurs = Chauffeur::all();
        return view('front.cars.affectation', ['chauffeurs' => $chauffeurs, 'vehicules' =>  $vehicules]);
    }



    public function update_affectation(Request $request, $id)
    {
        $vehicule = Vehicule::find($id);
        $vehicule->Immatriculation = $request->Immatriculation;
        $vehicule->Model = $request->Model;
        $vehicule->Type_Véhicule = $request->Type_Véhicule;
        $vehicule->Numero_Serie = $request->Numero_Serie;
        $vehicule->status = $request->status;
        $vehicule->Description = $request->Description;
        $vehicule->save();
        return redirect()->route('vehicule.index')->with('message', 'Vehicule mis a jour avec success...');
    }

    public function chargerColis(Request $request, Vehicule $vehicule)
    {
        $request->validate([
            'colis' => 'required|array',
            'colis.*' => 'required|exists:colis,id',
        ]);

        $colis = ColisDimension::whereIn('id', $request->input('colis'))->whereNull('conteneur_id')->get();

        foreach ($colis as $c) {
            $c->vehicule_id = $vehicule->id;
            $c->statut = 'chargé';
            $c->save();
        }

        return redirect()->route('vehicules.details', $vehicule)->with('success', 'Les colis ont été chargés dans le véhicule avec succès.');
    }
}
