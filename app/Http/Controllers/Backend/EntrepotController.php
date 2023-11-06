<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ColisDimension;
use App\Models\Entrepot;
use Illuminate\Http\Request;
use PDF;
class EntrepotController extends Controller
{
    public function index()  
    {
        $listes = Entrepot::all();
        return view('front.entrepot.index', compact('listes'));
    }

    public function create() 
    {
        return view('front.entrepot.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $entrepot = new Entrepot();
        $entrepot -> name = $request->name;
        $entrepot -> address = $request->addresse;
        $entrepot -> ville = $request->ville;

        $entrepot->save();

        return redirect()->route('entrepots.index')->with('message','Data update successfully...');
    }

    public function update(Request $request,$id)
    {
        $entrepot =  Entrepot::find($id);
        $entrepot -> name = $request->name;
        $entrepot -> address = $request->addresse;
        $entrepot -> ville = $request->ville;

        $entrepot->save();

        return redirect()->route('entrepots.index')->with('message','Entrepot Creer avec success...');
    }

    public function edit($id)
    {
        $entrepot = Entrepot::findOrFail($id);

        return view('front.entrepot.edit',compact('entrepot'));
    }

    public function showEntrepot(Entrepot $entrepot)
    {
        $colis = $entrepot->colis()
                            ->where('status', 1)
                            ->where('decharge', '=', null)
                            ->get();
        return view('front.entrepot.entrepotShow',compact('entrepot','colis'));
    }

    public function showEntrepotDecharge(Entrepot $entrepot)
    {
        $colis = $entrepot->colis()->where('decharge', 1)->where('livre', 0)->get();
        return view('front.entrepot.entrepotShowDecharge',compact('entrepot','colis')); 
    }

    public function delete($id)
    {
        $entrepot = Entrepot::findOrFail($id);
        $entrepot ->delete();
        return redirect()->route('entrepots.index')->with('error', 'entrepot supprimé avec success');
    }

    public function livraison($id)
    {
        $entrepot = ColisDimension::findOrFail($id);
        $entrepot->livre = '1';
        $entrepot->save();
        return redirect()->back()->with('message', 'colis livré avec success');
    }


    public function entrepotlistesColisPdf(Entrepot $entrepot)
    {
        $date= date('d-M-Y');
        $colis= $entrepot->colis()->get();
        $pdf = PDF::loadView('front.pdf.entrepotListesColispdf',compact('entrepot','date','colis'));
        $pdf->SetProtection(['copy','print'], '', 'pass');
        return $pdf->stream('document.pdf');
    } 
    public function entrepotlistesColisDechargesPdf(Entrepot $entrepot)
    {
        $date= date('d-M-Y');
        $colis= $entrepot->colis()->where('decharge', 1)->get();
        $pdf = PDF::loadView('front.pdf.entrepotListesColisDechargespdf',compact('entrepot','date','colis'));
        $pdf->SetProtection(['copy','print'], '', 'pass');
        return $pdf->stream('document.pdf'); 
    } 
                               
}
