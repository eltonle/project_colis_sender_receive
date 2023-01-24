<?php

namespace App\Http\Controllers\Backend;

use PDF;
use App\Models\Invoice;
use App\Models\Customer;
use App\Models\Payement;
use Illuminate\Http\Request;
use App\Models\PayementDetail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class CustomerController extends Controller
{
    
    public function index()
    {
        $customers = Customer::all();
        return view('front.customers.index', compact('customers'));

    }
    public function create()
    { 
       
        return view('front.customers.create');
    }

    public function store(Request $request)
    {
        $category = new Customer();
        $category->nom=$request->nom;
        $category->prenom=$request->prenom;
        $category->email=$request->email;
        $category->address=$request->address;
        $category->phone=$request->phone;
        $category->created_by=Auth()->user()->id;
        $category->save();
        return redirect()->route('customers.index')->with('message','Client enregistrer avec success...');
    }
    public function edit($id)
    {
        $edit = Customer::find($id);
        return view('front.customers.edit', compact('edit'));
    }

    public function update(Request $request,$id)
    {
        $customer = Customer::find($id);
        $customer->nom=$request->nom;
        $customer->prenom=$request->prenom;
        $customer->email=$request->email;
        $customer->address=$request->address;
        $customer->phone=$request->phone;
        $customer->updated_by=Auth()->user()->id;
        $customer->save();
        return redirect()->route('customers.index')->with('message','Client mis a jour avec success...');
    }

    public function delete($id)
    {
        $customer = Customer::find($id);
        $customer->delete();
        return redirect()->route('customers.index')->with('error','client supprimer avec success...');
    }

    public function creditCustomer()
    {
        $allData = Payement::whereIn('paid_status', ['full_due','partial_paid'])->get();
        return view('front.customers.customer-credit',compact('allData'));
    }

    public function creditCustomerPdf()
    {
        $data['date']= date('d-M-Y');
        $data['allData'] = Payement::whereIn('paid_status', ['full_due','partial_paid'])->get();
        $pdf = PDF::loadView('front.pdf.customer-credit-pdf', $data);
        $pdf->SetProtection(['copy','print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }

    public function editInvoice($invoice_id)
    {
        $payment = Payement::where('invoice_id', $invoice_id)->first();
        return view('front.customers.edit-invoice',compact('payment'));
    }
    public function updateInvoice(Request $request)
    {
        
        if ($request->new_paid_amount < $request->paid_amount) {
            return redirect()->back()->with('error','Sorry! montant extreme!!!');
        }else { 
            $invoice_id = Invoice::find($request->invoice_id)->id;
            // dd($invoice_id);
            // $invoice ->status_livraison = $request->status_livraison;
            // $invoice->save();
            $payment = Payement::where('invoice_id', $invoice_id)->first();
            $payment_details = new PayementDetail();
            $payment->paid_status = $request->paid_status;
            if ($request->paid_status == 'full_paid') {
                $payment->paid_amount = Payement::where('invoice_id',$invoice_id)->first()['paid_amount']+$request->new_paid_amount;
                $payment->due_amount = '0';
                $payment_details->current_paid_amount = $request->new_paid_amount;
            }elseif ($request->paid_status == 'partial_paid') {
                $payment->paid_amount = Payement::where('invoice_id',$invoice_id)->first()['paid_amount']+$request->paid_amount;
                $payment->due_amount = Payement::where('invoice_id',$invoice_id)->first()['due_amount']-$request->paid_amount;
                $payment_details->current_paid_amount = $request->paid_amount;
            }
            $payment->save();
            $payment_details->invoice_id = $invoice_id;
            $payment_details->date = date('Y-m-d',strtotime($request->date));
            // $payment_details->created_by = Auth::user()->id;
            $payment_details->save();


            return redirect()->route('invoices.pending.list')->with('success','Paiement Ajouter');
        }
    }

    public function invoiceDetailsPdf($invoice_id)
    {
      $data['payment']= Payement::where('invoice_id',$invoice_id)->first();
      $pdf = PDF::loadView('front.pdf.invoice-details-pdf', $data);
      $pdf->SetProtection(['copy','print'], '', 'pass');
      return $pdf->stream('document.pdf');
    }


    public function paidCustomerModal($invoice_id)
    {
        // $allData = Payement::where('paid_status','!=', 'full_due')->get();
        // return view('front.customers.customer-paid',compact('allData'));
        $paid = PayementDetail::where('invoice_id', $invoice_id)->get();
          return Response::json($paid);
    }
    public function paidCustomer()
    {
        $allData = Payement::where('paid_status','!=', 'full_due')->get();
        return view('front.customers.customer-paid',compact('allData'));
    }

    public function paidCustomerPdf()
    {
        $data['date']= date('d-M-Y');
        $data['allData'] = Payement::where('paid_status','!=','full_due')->get();
        $pdf = PDF::loadView('front.pdf.customer-paid-pdf', $data);
        $pdf->SetProtection(['copy','print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }

    public function customerWiseReport()
    {
        $customers = Customer::all();
        return view('front.customers.customer-wise-report',compact('customers'));
    }

    public function customerWiseCredit(Request $request)
    {
        $data['date']= date('d-M-Y');
        $data['allData'] = Payement::where('customer_id', $request->customer_id)->whereIn('paid_status', ['full_due','partial_paid'])->get();
        $pdf = PDF::loadView('front.pdf.customer-wise-credit-pdf', $data);
        $pdf->SetProtection(['copy','print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
    public function customerWisePaid(Request $request)
    {
        $data['date']= date('d-M-Y');
        $data['allData'] = Payement::where('customer_id', $request->customer_id)->where('paid_status','!=','full_due')->get();
        $pdf = PDF::loadView('front.pdf.customer-wise-paid-pdf', $data);
        $pdf->SetProtection(['copy','print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
}
