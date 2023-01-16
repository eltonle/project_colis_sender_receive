<?php

namespace App\Http\Controllers\Backend;

use App\Models\Unit;
use App\Models\Invoice;
use App\Models\Receive;
use App\Models\Customer;
use App\Models\Payement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\InvoiceDetail;
use App\Models\PayementDetail;
use Illuminate\Support\Facades\Auth;
use PDF;

class InvoiceController extends Controller
{
    public function index()
    {
        $allData = Invoice::orderBy('date','desc')->orderBy('id','desc')->where('status', '1')->get();
        return view('front.invoices.view',compact('allData'));
    }
    public function create()
    {
        $data['countries'] = Country::all();
        $data['units'] = Unit::all();
        $data['customers'] = Customer::all(); 
        $data['receives'] = Customer::all(); 
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

    public function store(Request $request)
    {
        // dd($request);
        $today = date(format:'Ymd');
        $invoiceZips = Invoice::where('invoice_zip','like',$today.'%')->pluck('invoice_zip');
         do {
            $invoiceZip= $today . rand(100000, 999999);
         } while ($invoiceZips->contains($invoiceZip));
        
         if ($request->date==null) {
            return redirect()->back()->with('error','sorry! Date non remplir');
         }else{
            if ($request->paid_amount > $request->total_amount) {
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
               $invoice->status = '0';
               $invoice->created_by = Auth::user()->id;
               DB::transaction(function() use($request,$invoice) {
                if ($invoice->save()) {
                    $count_model_marque = count($request->model_marque);
                    for ($i=0; $i < $count_model_marque; $i++) { 
                        $invoice_details = new InvoiceDetail();
                        $invoice_details ->date = date('Y-m-d',strtotime($request->date));
                        $invoice_details ->invoice_id = $invoice->id;
                        $invoice_details ->model_marque = $request->model_marque[$i];
                        $invoice_details ->chassis = $request->chassis[$i];
                        $invoice_details ->longueur = $request->longueur[$i];
                        $invoice_details ->largeur = $request->largeur[$i];
                        $invoice_details ->hauteur = $request->hauteur[$i];
                        $invoice_details ->qty = $request->qty[$i];
                        $invoice_details ->unit_price = $request->unit_price[$i];
                        $invoice_details ->item_total = $request->item_total[$i];
                        $invoice_details ->status = '0';
                        $invoice_details ->save();
                    }
                    if ($request->customer_id == '0') {
                        $customer = new Customer();
                        $customer -> nom = $request->nom;
                        $customer -> prenom = $request->prenom;
                        $customer -> email = $request->email;
                        $customer -> address = $request->address;
                        $customer -> phone = $request->phone;
                        $customer -> save();
                        $customer_id = $customer->id;
                    }else {
                        $customer_id= $request->customer_id;
                    }
                    if ($request->receive_id == '0') {
                        
                        // $receive = new Receive();
                        // $receive -> nomr = $request->nomr;
                        // $receive -> prenomr = $request->prenomr;
                        // $receive -> emailr = $request->emailr;
                        // $receive -> addressr = $request->addressr;
                        // $receive -> phoner = $request->phoner;
                        // $receive->save();
                        $receive = new Customer();
                        $receive -> nom = $request->nomr;
                        $receive -> prenom = $request->prenomr;
                        $receive -> email = $request->emailr;
                        $receive -> address = $request->addressr;
                        $receive -> phone = $request->phoner;
                        $receive->save();
                        $receive_id = $receive->id;
                    }else {
                        $receive_id= $request->receive_id;
                    }
                    $payement = new Payement();
                    $payement_detail = new PayementDetail();
                    $payement -> invoice_id = $invoice->id;
                    $payement -> customer_id = $customer_id;
                    $payement -> receive_id = $receive_id;
                    $payement -> paid_status = $request->paid_status;
                    $payement -> paid_amount = $request->paid_amount;
                    $payement -> discount_amount = $request->discount_amount;
                    $payement -> total_amount = $request->total_amount;
                    if ($request->paid_status == 'full_paid') {
                        $payement->paid_amount= $request->total_amount;
                        $payement->due_amount= '0';
                        $payement_detail->current_paid_amount= $request->total_amount;
                    } elseif($request->paid_status == 'full_due') {
                        $payement->paid_amount= '0';
                        $payement->due_amount= $request->total_amount;
                        $payement_detail->current_paid_amount= '0';
                   
                    }elseif($request->paid_status == 'partial_paid') {
                        $payement->paid_amount= $request->paid_amount;
                        $payement->due_amount= $request->total_amount - $request->paid_amount;
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

         return redirect()->route('invoices.pending.list')->with('succes', 'enregistrer avec success');
    }

    public function pendingList()
    {
        $allData = Invoice::orderBy('date','desc')->orderBy('id','desc')->get();
        return view('front.invoices.pendint-invoice-list',compact('allData'));
    } 

    public function approve($id)
    {
         $invoice = Invoice::with(['invoice_details'])->find($id);
         return view('front.invoices.invoice-approve',compact('invoice'));
    }

    public function approvalStore(Request $request, $id)
    {
        $invoice = Invoice::find($id);
        $invoice->updated_by = Auth::user()->id;
        $invoice->status = '1';
        // DB::transaction(function() use($request, $invoice,$id) {
        //       foreach ($request->qty as $key => $val) {
        //         $invoice_details = InvoiceDetail::where('id',$key)->first();
        //         $invoice_details->status = '1';
        //         $invoice_details->save();
        //       }
              $invoice->save();
        // });
        return redirect()->route('invoices.pending.list')->with('success','Facture approuvee avec success');
    }

    public function printInvoiceList()
    {
        $allData = Invoice::orderBy('date','desc')->orderBy('id','desc')->where('status', '1')->get();
        return view('front.invoices.post-invoice-list',compact('allData'));
    }

    public function printInvoice($id)
    {
        // dd('ok');
        $data['invoice'] = Invoice::with(['invoice_details'])->find($id);
        $pdf = PDF::loadView('front.pdf.invoice-pdf', $data);
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
        InvoiceDetail::where('invoice_id',$invoice->id)->delete();
        Payement::where('invoice_id',$invoice->id)->delete();
        PayementDetail::where('invoice_id',$invoice->id)->delete();
        return redirect()->route('invoices.pending.list')->with('error','facture supprime');
    }

}
