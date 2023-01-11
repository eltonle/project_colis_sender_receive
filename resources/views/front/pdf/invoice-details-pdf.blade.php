<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Facture Details PDF</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <table width="100%">
                    <tr>
                        <td width="90%">
                            <h4 class="" style="font-size: 26px;background: #ddd;">
                                <i class="fas fa-globe text-indigo"></i> Express, Colis.
                            </h4>
                        </td>
                        <td width="10%">
                            <h4 class="" style="font-size: 26px">Date:{{
                                date('d-M-Y',strtotime($payment['invoice']['date'] )) }}</h4>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <br>
        <table style="border: 1px solid #333;" width="100%">
            <thead>
                <tr>
                    <th colspan="2">INFORMATION DU PERSONNELLE</th>
                </tr>
            </thead>
        </table>
        <br>
        <div class="row">
            <div class="col-md-6">
                <table width="100%">
                    <tr>
                        {{-- @php
                        $payment = App\Models\Payement::where('invoice_id',$invoice->id)->first();
                        @endphp --}}
                        <td width="40%">
                            <strong>
                                <div class="col-sm-4 ">
                                    <span class="" style="font-size: 18px">partir de</span>
                                    <address>
                                        <strong>{{ $payment['customer']['nom'] }}, {{ $payment['customer']['prenom']
                                            }}.</strong><br>
                                        {{ $payment['customer']['address'] }}<br>
                                        San Francisco, CA 94107<br>
                                        Phone: {{ $payment['customer']['phone'] }}<br>
                                        Email: {{ $payment['customer']['email'] }}
                                    </address>
                                </div>
                            </strong>
                        </td>
                        <td width="40%">
                            <strong>
                                <div class="col-sm-4 ">
                                    <span class="" style="font-size: 18px">Pour</span>
                                    <address>
                                        <strong>{{ $payment['receive']['nomr'] }}, {{ $payment['receive']['prenomr']
                                            }}.</strong><br>
                                        {{ $payment['receive']['addressr'] }}<br>
                                        San Lorenipsum, CA 94107<br>
                                        Phone: {{ $payment['receive']['phoner'] }}<br>
                                        Email: {{ $payment['receive']['emailr'] }}
                                    </address>
                                </div>
                            </strong>
                        </td>
                        <td width="20%">
                            <strong>
                                <div class="col-sm-4">
                                    <b style="font-size: 17px">Facture N0:<strong class="text-primary">#{{
                                            $payment['invoice']['invoice_no'] }}</strong> </b><br>
                                    <br>
                                    <b style="font-size: 13px;">Zip ID:</b> #{{ $payment['invoice']['invoice_zip']
                                    }}<br>

                                    {{-- <b>Order ID:</b> 4F3S8J<br> --}}
                                    <b>Montant Du :</b> <b class="" style="color: red">{{ $payment->due_amount }}
                                    </b>fcfa<br>
                                    <b>Montant Paye :</b> <b style="color: blue">{{ $payment->paid_amount }}</b> fcfa
                                </div>
                            </strong>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div>

        <br>
        <table style="border: 1px solid #333;" width="100%">
            <thead>
                <tr>
                    <th colspan="2">INFORMATION COlIS</th>
                </tr>
            </thead>
        </table>
        <br>
        <div class="">
            <div class="card-body">
                <table border="1" width='100%' style="margin-bottom: 10px">
                    <thead>
                        <tr class="text-center">
                            <th class="text-center" style="background:#ddd; padding:1px;">#ID</th>
                            <th>Model&Marque</th>
                            <th>Chassis</th>
                            <th>Longueur</th>
                            <th>Largeur</th>
                            <th>Hauteur</th>
                            <th>Prix unite</th>
                            <th>Qty</th>
                            <th>Total prix</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $total_sum = '0';
                        $invoice_details = App\Models\InvoiceDetail::where('invoice_id',$payment->invoice_id)->get();
                        @endphp
                        @foreach ($invoice_details as $key =>$details )
                        <tr class="text-center">
                            <input type="hidden" name="qty[{{ $details->id }}]" value="{{ $details->qty }}">
                            <td class="text-center" style="background:#ddd; padding:1px;">{{ $key+1 }}
                            </td>
                            <td>{{
                                $details->model_marque }}</td>
                            <td>{{ $details->chassis }}</td>
                            <td>{{ $details->longueur }}</td>
                            <td>{{ $details->largeur }}</td>
                            <td>{{ $details->hauteur}}</td>
                            <td>{{ $details->unit_price }}</td>
                            <td>{{ $details->qty }}</td>
                            <td>{{ $details->item_total }}</td>
                            @php
                            $total_sum += $details->item_total
                            @endphp
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="8" style="text-align: right"><strong>Sub Total</strong>
                            </td>
                            <td class="text-center"> <span>{{ $total_sum }}</span></td>
                        </tr>
                        <tr>
                            <td colspan="8" style="text-align: right"><span>Discount</span> </td>
                            <td class="text-center"> <span>{{ $payment->discount_amount }}</span></td>
                        </tr>
                        <tr>
                            <td colspan="8" style="text-align: right"><span>Montant Paye</span> </td>
                            <td class="text-center"> <span style="background-color: #0be881">{{ $payment->paid_amount
                                    }}</span></td>
                        </tr>
                        <tr>
                            <td colspan="8" style="text-align: right"><span>Montant due</span> </td>
                            <td class="text-center"> <span style="background-color: #ff5e57">{{ $payment->due_amount
                                    }}</span></td>
                        </tr>
                        <tr>
                            <td colspan="8" style="text-align: right"><strong>Grand total</strong> </td>
                            <td class="text-center"> <strong>{{ $payment->total_amount }}</strong></td>
                        </tr>
                        <tr>
                            <td colspan="9" style="text-align: center; font-weight: bold"><strong>Sommaire de
                                    Payement</strong></td>
                        </tr>
                        <tr>
                            <td colspan="4" style="text-align: center;font-weight: bold;">Date </td>
                            <td colspan="5" style="font-weight: bold;text-align: center">Montant verse</td>
                        </tr>
                        @php
                        $payment_details = App\Models\PayementDetail::where('invoice_id', $payment->invoice_id)->get();
                        @endphp
                        @foreach ($payment_details as $dtl )
                        <tr>
                            <td colspan="4" style="text-align: center;">{{ date('d-M-Y',strtotime($dtl->date)) }}</td>
                            <td colspan="5" style="text-align: center;">{{ $dtl->current_paid_amount }} fcfa</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <br>
                <br>
                <!-- /.col -->
                @php
                $date= new DateTime();
                @endphp
                <span style="font-weight: bold">Inprimer le: </span> <i>{{ $date->format('j F, Y, H:i:s') }}</i>

            </div>
        </div>

    </div>

    <div>
        <hr style="margin-bottom: 0px;">
        <table width="100%">
            <tbody>
                <tr>
                    <td style="width: 20%;">
                        <p style="text-align: center; margin-left: 20px;">
                            Signature de l'expediteur
                        </p>
                    </td>
                    <td style="width: 20%;"></td>
                    <td style="width: 40px; text-align: center;">
                        <p style="text-align: center;"> Signature du responsable</p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>



</body>

</html>