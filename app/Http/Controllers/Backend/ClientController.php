<?php

namespace App\Http\Controllers\Backend;

use PDF;
use App\Helper;
use App\Models\Unit;
use App\Models\Client;
use App\Models\Country;
use App\Models\Receive;
use App\Models\Payement;
use App\Models\ClientAdd;
use Illuminate\Http\Request;
use App\Models\PayementDetail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::get();
        // dd($clients);
        return view('front.clients.index', compact('clients'));

    }
    public function create()
    {
        $countries= Country::get(['name','id']);
        $units = Unit::get();
        $dates = date('d M Y');
        return view('front.clients.create',compact('countries','dates','units'));
    }

    public function store(Request $request)
    {
        // dd($request);
 
         if ($request->paid_amount > $request->grand_total) {
            return redirect()->back()->with('error','Sorry! le montant paye est superieur au montant total');
         } else {
            # code... 
            // dd($request);
           $client_number = Helper::IdGenerator();
           
            $client = new Client();
            $client->client_number = $client_number;
            $client->name=$request->name;
            $client->firstname=$request->firstname;
            $client->email=$request->email;
            $client->address=$request->address;
            $client->phone=$request->phone;
            $client->country_id=$request->country_id;
            $client->state_id=$request->state_id;
            $client->city_id=$request->city_id;
            $client->sub_total=$request->sub_total;
            $client->tax_1=$request->tax_1;
            $client->discount=$request->discount;
            $client->grand_total=$request->grand_total;
            $client->description=$request->description;
            $client->status_livraison=$request->status_livraison;
            $client->unit_id=$request->unit_id;
            $client->created_by=Auth()->user()->id;
            $client->save();

            $idclien = Client::where('name',$request->name)->first();

            $receive = new Receive();
            $receive->client_id = $idclien->id;
            $receive->namer = $request->namer;
            $receive->firstnamer = $request->firstnamer;
            $receive->emailr = $request->emailr;
            $receive->addressr = $request->addressr;
            $receive->phoner = $request->phoner;
            $receive->countryr_id = $request->countryr_id;
            $receive->stater_id = $request->stater_id;
            $receive->cityr_id = $request->cityr_id;
            $receive->created_by = Auth()->user()->id;
            $receive->save();

            $client_number = DB::table('clients')->orderBy('client_number','DESC')->select('client_number')->first();
            $client_number = $client_number->client_number;

            foreach($request->model_marque as $key => $items)
            {
                $clientsAdd['client_number']   = $client_number;
                $clientsAdd['model_marque']   = $request->model_marque[$key];
                $clientsAdd['chassis']        = $request->chassis[$key];
                $clientsAdd['length']         = $request->length[$key];
                $clientsAdd['width']         = $request->width[$key];
                $clientsAdd['height']         = $request->height[$key];
                $clientsAdd['unit_price']       = $request->unit_price[$key];
                $clientsAdd['qty']             = $request->qty[$key];
                $clientsAdd['item_total']          = $request->item_total[$key];
                $clientsAdd['description']     = $request->description[$key];

                ClientAdd::create($clientsAdd);
            }
            $payement = new Payement();
            $payement_detail = new PayementDetail();
            $payement->client_number = $client_number;
            $payement->client_id = $idclien->id;
            $payement->paid_status  = $request->paid_status;
            $payement->discount_amount  = $request->discount;
            $payement->total_amount  = $request->grand_total;
            if ($request->paid_status == 'full_paid') {
                $payement->paid_amount= $request->grand_total;
                $payement->due_amount= '0';
                $payement_detail->current_paid_amount= $request->grand_total;
            } elseif($request->paid_status == 'full_due') {
                $payement->paid_amount= '0';
                $payement->due_amount= $request->grand_total;
                $payement_detail->current_paid_amount= '0';
           
            }elseif($request->paid_status == 'partial_paid') {
                $payement->paid_amount= $request->paid_amount;
                $payement->due_amount= $request->grand_total - $request->paid_amount;
                $payement_detail->current_paid_amount= $request->paid_amount;
           
            }
            $payement->save();
            $payement_detail ->client_number = $client_number;
            $payement_detail ->client_id = $idclien->id;
            $payement_detail ->date = date('Y-m-d');
            $payement_detail ->save();
            

            return redirect()->route('clients.index')->with('message','Data saved successfully...');
        }
     }
 
 
     public function show($id)
    {
         $client = Client::find($id);
         $client_number = Client::find($id)->client_number;
         
        $show = DB::table('clients')
                 ->join('client_adds','clients.client_number', '=','client_adds.client_number')
                 ->select('clients.*','client_adds.*')
                 ->where('client_adds.client_number',$client_number)
                 ->get();
                //  dd($show);
        return view('front.clients.show', compact('show','client'));
    }

    public function printList()
    {
        $clients = Client::get();
        return view('front.clients.printList',compact('clients'));
    }
    public function printIn($id)
    {
        $data['client'] = Client::find($id);
        $client_number = Client::find($id)->client_number;
        
       $data['show'] = DB::table('clients')
                ->join('client_adds','clients.client_number', '=','client_adds.client_number')
                ->select('clients.*','client_adds.*')
                ->where('client_adds.client_number',$client_number)
                ->get();
       
            // $data = [
            //     'foo' => 'bar'
            // ];
            $pdf = PDF::loadView('front.clients.printClient', $data);
            $pdf->SetProtection(['copy', 'print'], '', 'pass');
            return $pdf->stream('document.pdf');
    
    }

     public function edit($id)
    {
        $edit = Client::find($id);
        return view('front.clients.edit', compact('edit'));
    }

    public function update(Request $request,$id)
    {
        $client = Client::find($id);
        $client = new Client();
        $client->name=$request->name;
        $client->firstname=$request->firstname;
        $client->email=$request->email;
        $client->address=$request->address;
        $client->phone=$request->phone;
        $client->updated_by=Auth()->user()->id;
        $client->save();
        return redirect()->route('clients.index')->with('message','Data update successfully...');
    }

    public function delete($id)
    {
        $client = Client::find($id);
        $client->delete();
        return redirect()->route('clients.index')->with('error','Client delete successffully...');
    }
}
