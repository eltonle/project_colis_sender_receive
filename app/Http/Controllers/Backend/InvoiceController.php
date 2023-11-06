<?php

namespace App\Http\Controllers\Backend;

use PDF;
use App\Models\Unit;
use App\Models\Country;
use App\Models\State;
use App\Models\Invoice;
use App\Models\Customer;
use App\Models\Payement;
use App\Models\ColisPrice;
use Illuminate\Http\Request;
use App\Models\ColisStandard;
use App\Models\InvoiceDetail;
use App\Models\ColisDimension;
use App\Models\PayementDetail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Entrepot;
use App\Models\HistoriqueColisEntrepot;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class InvoiceController extends Controller
{
    // public function index()
    // {
    //     $allData = Invoice::orderBy('date','desc')->orderBy('id','desc')->where('status', '1')->get();
    //     return view('front.invoices.view',compact('allData'));
    // }

    public function create()
    {
        // $colis = ColisDimension::where('status',0)->get();
        //   dd($colis);
        $data['countries'] = Country::all(); 
        // $data['units'] = Unit::all();
        $data['customers'] = Customer::all(); 
        $data['receives'] = Customer::all(); 
        $data['entrepots'] = Entrepot::all(); 
        $data['date'] = date('Y-m-d');
        $invoice_data = Invoice::orderBy('id','desc')->first();
        
        if ($invoice_data == null) {
            $firstReg = '0';
            $data['invoice_no'] = $firstReg + 1;
        }else {
           $invoice_data = Invoice::orderBy('id', 'desc')->first()->invoice_no;
           $data['invoice_no'] = $invoice_data+1;
        }
        return view('front.invoices.add-invoice',$data);
    }

    //STORE INVOICE
    public function store(Request $request)
    {
        
        if ($request->total_amount=='' || $request->total_amount=='0' ) {
            return redirect()->back()->with('error','Veuillez renseignez les colis !!! ');
         }

        
        $today = date(format:'Ymd');
        $invoiceZips = Invoice::where('invoice_zip','like',$today.'%')->pluck('invoice_zip');
         do {
            $invoiceZip= $today . rand(100000, 999999);
         } while ($invoiceZips->contains($invoiceZip));
        
         if ($request->date==null) {
            return redirect()->back()->with('error','sorry! Date non remplir');
         }else{
            if ($request->paid_amount == $request->total_amount) {
                return redirect()->back()->with('error','sorry! la valeur de paie est superieur au total');
            }else {
               $invoice = new Invoice();
               $invoice->invoice_no = $request->invoice_no;
               $invoice->invoice_zip = $invoiceZip;
               $invoice ->unit_id = $request->unit_id;
               $invoice ->country_id = $request->country_id;
               $invoice ->state_id = $request->state_id;
               $invoice ->countryr_id = $request->countryr_id;
               $invoice ->stater_id = $request->stater_id;
               $invoice ->status_livraison = $request->status_livraison;
               $invoice->date = date('Y-m-d',strtotime($request->date));
               $invoice->description = $request->description ;
               $invoice->status = '1';
               $invoice->created_by = Auth::user()->id;
               DB::transaction(function() use($request,$invoice) {
                if ($invoice->save()) {

                    // STORE COLIS
                    $colisDimVerifie = ColisDimension::where('status', 0)->get();

                    if ($colisDimVerifie) {

                        foreach ($colisDimVerifie as $colis) {
                            $today = date('Ymd');
                            $codesZip = ColisDimension::where('code_zip', 'like', $today . '%')->pluck('code_zip');
                    
                            do {
                                $codeZip = $today . rand(100000, 999999);
                            } while ($codesZip->contains($codeZip));
                    
                            $colis->invoice_id = $invoice->id;
                            $colis->status = 1;
                            $colis->entrepot_id = $request->entrepot_id;
                            $colis->code_zip = $codeZip;
                            $colis->save();
                      // Enregistrez l'historique du mouvement
                          HistoriqueColisEntrepot::create([
                            'colis_id' => $colis->id,
                            'entrepot_depart_id' => $colis->entrepot_id,
                            'entrepot_arrive_id' => 0,
                            'date_action' => now(),
                        ]);
                            
                        }

                        
                    }
                    // END STORE COLIS                                        

                    $payement = new Payement();
                    $payement_detail = new PayementDetail();
                    $payement -> invoice_id = $invoice->id;
                    $payement -> customer_id = $request->customer_id ;// $customer_id; //$request->customer_id
                    $payement -> receive_id = $request->receive_id ; //$receive_id;  //$request->receive_id
                    // $payement -> paid_status = $request->paid_status;
                    $payement -> paid_amount = $request->paid_amount;
                    // $payement -> discount_amount = $request->discount_amount;
                    $payement -> total_amount = $request->total_amount;
                    if ($request->paid_amount ==  $request->total_amount) {
                        $payement->paid_amount= $request->total_amount;
                        $payement -> paid_status = 'full_paid';
                        $payement->due_amount= '0';
                        $payement_detail->current_paid_amount= $request->total_amount;
                    } elseif($request->paid_amount == '0') {
                        
                        // dd($request->total_amount);
                        $payement->paid_amount= '0';
                        $payement->due_amount= $request->total_amount;
                        $payement -> paid_status = 'full_due';
                        $payement_detail->current_paid_amount= '0';
                   
                    }elseif($request->paid_amount < $request->total_amount && $request->paid_amount != "0") {
                        $payement->paid_amount= $request->paid_amount;
                        $payement->due_amount= $request->total_amount - $request->paid_amount;
                        $payement -> paid_status = 'partial_paid';
                        $payement_detail->current_paid_amount= $request->paid_amount;
                    }
                    $payement->save();
                    $payement_detail->invoice_id = $invoice->id;
                    $payement_detail->date = date('Y-m-d',strtotime($request->date));
                    $payement_detail->save();
                   
                }
               });
            }
         }

         return redirect()->route('invoices.pending.list')->with('message', 'enregistrer avec success');
    }
    
        //Update Invoice
    public function update_invoice(Request $request)
    {
            // dd($request->id);
            if ($request->paid_amount > $request->total_amount) {
                return redirect()->back()->with('error','sorry! la valeur de paie est superieur au total');
            }else {
           
               $invoice = Invoice::find($request->id);
               if (!$invoice) {
                return redirect()->back()->with('error', 'L\'enregistrement que vous essayez de mettre à jour n\'existe pas.');
                }
           
               $invoice->invoice_no = $request->invoice_no;
               $invoice ->unit_id = $request->unit_id;
               $invoice ->country_id = $request->country_id;
               $invoice ->state_id = $request->state_id;
               $invoice ->countryr_id = $request->countryr_id;
               $invoice ->stater_id = $request->stater_id;
               $invoice ->status_livraison = $request->status_livraison;
               $invoice->date = date('Y-m-d',strtotime($request->date));
               $invoice->description = $request->description ;
               $invoice->status = '1';
               $invoice->updated_by = Auth::user()->id;
               DB::transaction(function() use($request,$invoice) {
                if ($invoice->save()) {
                    
                    $colisDimVerifie = ColisDimension::where('status', 0)->get();
                    $colisDimVerifieExist = ColisDimension::where('invoice_id', $invoice->id)->get();

                    if ($colisDimVerifie) {

                        foreach ($colisDimVerifie as $colis) {
                            $today = date('Ymd');
                            $codesZip = ColisDimension::where('code_zip', 'like', $today . '%')->pluck('code_zip');
                    
                            do {
                                $codeZip = $today . rand(100000, 999999);
                            } while ($codesZip->contains($codeZip));
                    
                            // Sauvegardez les données du colis
                            $colis->invoice_id = $invoice->id;
                            $colis->status = 1;
                            $colis->entrepot_id = $request->entrepot_id;
                            $colis->code_zip = $codeZip;
                            $colis->save();
                    
                            // Récupérez l'historique du mouvement existant, s'il existe
                            $historique = HistoriqueColisEntrepot::where('colis_id', $colis->id)->first();
                    
                            if ($historique) {
                                // Mettez à jour l'historique du mouvement
                                $historique->entrepot_depart_id = $request->entrepot_id;
                                $historique->entrepot_arrive_id = 0; 
                                $historique->date_action = now();
                                $historique->save();
                            } else {
                                // Si l'historique du mouvement n'existe pas, créez-le
                                HistoriqueColisEntrepot::create([
                                    'colis_id' => $colis->id,
                                    'entrepot_depart_id' => $colis->entrepot_id,
                                    'entrepot_arrive_id' => 0, 
                                    'date_action' => now(),
                                ]);
                            }
                        }
                       
                    }
                    if ($colisDimVerifieExist) {

                        foreach ($colisDimVerifieExist as $colis) {
                           
                            $colis->entrepot_id = $request->entrepot_id;
                            
                            $colis->save();
                    
                            // Récupérez l'historique du mouvement existant, s'il existe
                            $historique = HistoriqueColisEntrepot::where('colis_id', $colis->id)->first();
                    
                            if ($historique) {
                                // Mettez à jour l'historique du mouvement
                                $historique->entrepot_depart_id = $request->entrepot_id;
                                $historique->entrepot_arrive_id = 0; 
                                $historique->date_action = now();
                                $historique->save();
                            } else {
                                // Si l'historique du mouvement n'existe pas, créez-le
                                HistoriqueColisEntrepot::create([
                                    'colis_id' => $colis->id,
                                    'entrepot_depart_id' => $colis->entrepot_id,
                                    'entrepot_arrive_id' => 0, 
                                    'date_action' => now(),
                                ]);
                            }
                        }
                      
                    }

                    $payement= Payement::where('invoice_id', $invoice->id)->first();
                    $payement_detail= PayementDetail::where('invoice_id', $invoice->id)->first();

                    $payement -> invoice_id = $invoice->id;
                    $payement -> customer_id = $request->customer_id; // $customer_id;
                    $payement -> receive_id =    $request->receive_id; //$receive_id;            
                    // $payement -> discount_amount = $request->discount_amount;
                    $payement -> total_amount = $request->total_amount;
                   
                    if ( $request->paid_amount == $request->total_amount) {
                        $payement->paid_amount= $request->total_amount;
                        $payement->due_amount= '0';
                        $payement->paid_status = 'full_paid';
                        $payement_detail->current_paid_amount= $request->total_amount;
                        
                    } elseif( $request->paid_amount == '0') {
                        $payement->paid_amount= '0';
                        $payement->due_amount= $request->total_amount;
                        $payement->paid_status = 'full_due';
                        $payement_detail->current_paid_amount= '0';
                  
                    }elseif($request->paid_amount < $request->total_amount) {
                        $payement->paid_amount= $request->paid_amount;
                        $payement->due_amount= $request->total_amount - $request->paid_amount;
                        $payement->paid_status = 'partial_paid';
                        $payement_detail->current_paid_amount= $request->paid_amount;                        
                    }
                    
                    $payement->save();
                    $payement_detail->invoice_id = $invoice->id;
                    $payement_detail->date = date('Y-m-d',strtotime($request->date));
                    $payement_detail->save();
                }
               });
            }
          
        return redirect()->route('invoices.pending.list')->with('message', 'Expedition Modifier avec success');
    }


    // Update paid
    public function storeUpdate(Request $request,$id) 
    {
        //  dd($request->all());
        if ($request->new_paid_amount < $request->paid_amount1) {
            return redirect()->back()->with('error','Sorry! montant extreme!!!');
        }else { 
            $invoice_id = Invoice::find($id)->id;
         
            $payment = Payement::where('invoice_id', $invoice_id)->first();
            $payment_details = new PayementDetail();
            
            if ( $request->new_paid_amount == $request->paid_amount1) {
                // dd('full_paie');
                $payment->paid_status = 'full_paid';
                $payment->paid_amount = Payement::where('invoice_id',$invoice_id)->first()['paid_amount']+$request->new_paid_amount;
                $payment->due_amount = '0';
                $payment_details->current_paid_amount = $request->new_paid_amount;
                
            }elseif ($request->new_paid_amount > $request->paid_amount1) {
                
                $payment->paid_status = 'partial_paid';
                $payment->paid_amount = Payement::where('invoice_id',$invoice_id)->first()['paid_amount']+$request->paid_amount1;
                $payment->due_amount = Payement::where('invoice_id',$invoice_id)->first()['due_amount']-$request->paid_amount1;
                $payment_details->current_paid_amount = $request->paid_amount1;
            }
            $payment->save();
            $payment_details->invoice_id = $invoice_id;
            $payment_details->date = date('Y-m-d',strtotime($request->date));
            // $payment_details->created_by = Auth::user()->id;
            $payment_details->save();

            return redirect()->route('invoices.pending.list')->with('success','Paiement Ajouter');
        }
     
    }

    // Update paid1
    public function storeUpdate1(Request $request,$id) 
    {
      //  dd($request->all());
      if ($request->new_paid_amount2 < $request->paid_amount2) {
        return redirect()->back()->with('error','Sorry! montant extreme!!!');
    }else { 
        $invoice_id = Invoice::find($id)->id;
        
        $payment = Payement::where('invoice_id', $invoice_id)->first();
        $payment_details = new PayementDetail();
        if ( $request->new_paid_amount2 == $request->paid_amount2) {
            
            $payment->paid_status = 'full_paid';
            $payment->paid_amount = Payement::where('invoice_id',$invoice_id)->first()['paid_amount']+$request->new_paid_amount2;
            $payment->due_amount = '0';
            $payment_details->current_paid_amount = $request->new_paid_amount2;
            
        }elseif ($request->new_paid_amount2 > $request->paid_amount2) {
            
            $payment->paid_status = 'partial_paid';
            $payment->paid_amount = Payement::where('invoice_id',$invoice_id)->first()['paid_amount']+$request->paid_amount2;
            $payment->due_amount = Payement::where('invoice_id',$invoice_id)->first()['due_amount']-$request->paid_amount2;
            $payment_details->current_paid_amount = $request->paid_amount2;
        }
        $payment->save();
        $payment_details->invoice_id = $invoice_id;
        $payment_details->date = date('Y-m-d',strtotime($request->date));
        
        $payment_details->save();

        return redirect()->route('invoices.pending.list')->with('success','Paiement Ajouter');
    }
 
    }
//    update Status
    public function updateStatus(Request $request,$id)
    {
    //   dd($request->all());
      $invoice = Invoice::find($id);
            $invoice ->status_livraison = $request->status_livraison;
            $invoice->save();
            
         return redirect()->back()->with('message', 'Status modifier avec  success');
    }

    public function pendingList()
    {
       
         $date  = date('Y-m-d');
        $allData = Invoice::with('colis_dimensions')->orderBy('date','desc')->orderBy('id','desc')->get(); 
    
        return view('front.invoices.pendint-invoice-list',compact('allData','date'));
    } 

    public function approve($id) 
    {
         $invoice = Invoice::find($id);
      
         return view('front.invoices.invoice-approve',compact('invoice'));
    }
    public function edit_invoice($id)
    {
        $data['countries'] = Country::all();
        $data['states'] = State::all();
        $data['entrepots'] = Entrepot::all();
        $data['customers'] = Customer::all(); 
        $data['receives'] = Customer::all(); 
        
        $invoice= Invoice::with(['colis_dimensions'])->find($id);

        // $data['colis'] = ColisDimension::where('invoice_id', $invoice->id)->get();
        $data['invoice'] = Invoice::with(['colis_dimensions'])->find($id);
        // $data['entrepot_id'] = ColisDimension::where('')->find($id);
        $data['invoicesJoin'] = DB::table('invoices')
        ->join('colis_dimensions','invoices.id','=','colis_dimensions.invoice_id')
        ->select('invoices.*', 'colis_dimensions.*')
        ->where('colis_dimensions.invoice_id', $invoice->id)
        ->get();
        
         return view('front.invoices.invoice-edit',$data);
    }

   

    public function printInvoiceList()
    {
        $allData = Invoice::orderBy('date','desc')->orderBy('id','desc')->where('status', '1')->get();
        return view('front.invoices.post-invoice-list',compact('allData'));
    }

    public function printInvoice($id)
    {
        // dd('ok');
        $data['invoice'] = Invoice::find($id);
        $pdf = PDF::loadView('front.pdf.invoice-pdf', $data);
        $pdf->SetProtection(['copy','print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
    public function printInvoiceEtiquette($id)
    {
        
        $data['invoice'] = Invoice::find($id);

        $pdf = PDF::loadView('front.pdf.invoice-etiquette-pdf', $data);
        $pdf->SetProtection(['copy','print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }

    public function dailyReport()
    {
        return view('front.invoices.daily-invoice-report');
    }

    public function dailyReportPdf(Request $request) 
    {
        $data['date'] = date('d-M-Y');
        $sdate = date('Y-m-d',strtotime($request->start_date));
        $edate = date('Y-m-d',strtotime($request->end_date));
        $data['allData']= Invoice::whereBetween('date', [$sdate,$edate])->where('status','1')->get();
        $data['start_date'] = date('Y-m-d',strtotime($request->start_date));
        $data['end_date'] = date('Y-m-d',strtotime($request->end_date));
        $pdf = PDF::loadView('front.pdf.daily-invoice-report-pdf', $data);
        $pdf->SetProtection(['copy','print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }



    public function delete($id)
    {
        $invoice = Invoice::find($id);
        $invoice->delete();
        // InvoiceDetail::where('invoice_id',$invoice->id)->delete();
        Payement::where('invoice_id',$invoice->id)->delete();
        PayementDetail::where('invoice_id',$invoice->id)->delete();
        ColisDimension::where('invoice_id',$invoice->id)->delete();
        // ColisPrice::where('invoice_id',$invoice->id)->delete();
        return redirect()->route('invoices.pending.list')->with('error','facture supprime avec success...');
    }



    // Partir dES colis dimensionnes
    
    public function colisDimStore(Request $request){
        
        $colis_dim = new ColisDimension();

        $colis_dim->titre = $request->input('titre');
        $colis_dim->description = $request->input('description');
        $colis_dim->largeur = $request->input('largeur');
        $colis_dim->conversion = $request->input('conversion');
        $colis_dim->longueur = $request->input('longueur');
        $colis_dim->hauteur = $request->input('hauteur');
        $colis_dim->type = "colis dimension";
        $colis_dim->charge = 0;
        $colis_dim->prix_kilo = $request->input('prix_kilo');
        $colis_dim->poids = $request->input('poids');
        $colis_dim->prix_vol = $request->input('prix_vol');
        $colis_dim->prix = $request->input('prix');
        // $colis_dim->total = $request->input('total');
        $colis_dim->save();

        return response()->json(['message'=> 'colis enregistré avec success...']);
    }

    public function geteDataColisDim ()
    {
        $data = ColisDimension::where('status', 0)->get();
       return response()->json($data);
    }
    public function geteDataColisDimEdit (Request $request)
    {
        $inv_id = $request->input('inv_id');
        $data = ColisDimension::where('invoice_id', $inv_id)->orWhere('status', 0)->get();
       return response()->json($data);
    }

    public function deleteDataColisDim($id)
    {
        
            $data = ColisDimension::find($id);
            $data->delete();
            return response()->json('Data deleted successfully');
      
    }



    // Partir dES colis price
    
    public function colisPrixStore(Request $request){

            $colis_dim = new ColisDimension();
            $colis_dim->titre = $request->input('titre');
            $colis_dim-> description= $request->input('description');
            $colis_dim-> poids= $request->input('poids');
            $colis_dim-> type= "colis a prix";
            $colis_dim-> charge= 0;
            $colis_dim-> prix= $request->input('prix');
            $colis_dim->save();
      
    

       Return response()->json(['message'=>'colis enregistré avec success...']);
    }

    // public function getDataColisPrix ()
    // {
    //     $data = ColisPrice::where('status', 0)->get();
    //    return response()->json($data);
    // }

    public function deleteDataColisPrix($id)
    {
        
            $data = ColisPrice::find($id);
            $data->delete();
            return response()->json('Data deleted successfully');
      
    }

    //partir des COLIS STANDARD

    public function colisStandardStore(Request $request)
    {
        $colis_standard = new ColisStandard();
        $colis_standard-> titre = $request->input('titre');
        $colis_standard-> largeur= $request->input('largeur');
        $colis_standard-> longueur= $request->input('longueur');
        $colis_standard-> hauteur= $request->input('hauteur');       
        $colis_standard-> description= $request->input('description');
        $colis_standard-> nature = "Colis Normal";
        $colis_standard-> prix= $request->input('prix');
        $colis_standard->save();

       Return response()->json(['message'=>'colis enregistré avec success...']);
    }


    public function getDatacolisStandard()
    {
        $data = ColisStandard::all();
        return response()->json($data);
    }

    public function colisStandColisDim($id)
    {
        // recuperer l'element correspondant
        $data = ColisStandard::find($id);
        
        // Enregistrer les détails de l'élément dans une autre table
        $details = new ColisDimension();
        $details->titre = $data->titre;
        $details->largeur = $data->largeur;
        $details->longueur = $data->longueur;
        $details->hauteur = $data->hauteur;
        $details->poids = $data->poids;
        $details->type = "colis standard";
        $details->charge = 0;
        $details->description = $data->description;
        $details->prix = $data->prix;
        $details->save();

        return response()->json(['message'=>'colis ajouter avec success...']);
    }





    // GET LA SOMME TOTAL

    public function getSomme()
    {
        $sumDim = ColisDimension::where('status', '0')->sum('prix');
        // $sumPrix = ColisPrice::where('status', '1')->sum('prix_total');
        return response()->json([
        $sumDim,
        // $sumPrix

        ]);
    }

    public function getSommeEdit(Request $request)
    {
        $inv_id = $request->input('inv_id'); 
        // $data = ColisDimension::where('invoice_id', $inv_id)->andWhere('status', 0)->get();
        $sumDim = ColisDimension::where('invoice_id', $inv_id)->orWhere('status', 0)->sum('prix'); 
        return response()->json([
        $sumDim,
        // $sumPrix

        ]);
    }


}
