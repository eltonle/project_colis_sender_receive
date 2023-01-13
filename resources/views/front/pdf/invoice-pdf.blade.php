<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Facture PDF</title>
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
                            <h4 class="" style="font-size: 26px">Date:{{ date('d-M-Y',strtotime($invoice->date)) }}</h4>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <br>
        <table style="border: 1px solid #333;" width="100%">
            <thead>
                <tr>
                    <th colspan="2">FACTURE</th>
                </tr>
            </thead>
        </table>
        <br>
        <div class="row">
            <div class="col-md-6">
                <table width="100%">
                    <tr>
                        @php
                        $payment = App\Models\Payement::where('invoice_id',$invoice->id)->first();
                        @endphp
                        <td width="40%">
                            <strong>
                                <div class="col-sm-4 ">
                                    <span class="" style="font-size: 18px">Expedition</span>
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
                                    <span class="" style="font-size: 18px">Destination</span>
                                    <address>
                                        <strong>{{ $payment['receive']['nom'] }}, {{ $payment['receive']['prenom']
                                            }}.</strong><br>
                                        {{ $payment['receive']['address'] }}<br>
                                        San Lorenipsum, CA 94107<br>
                                        Phone: {{ $payment['receive']['phone'] }}<br>
                                        Email: {{ $payment['receive']['email'] }}
                                    </address>
                                </div>
                            </strong>
                        </td>
                        <td width="20%">
                            <strong>
                                <div class="col-sm-4">
                                    <b style="font-size: 17px">Facture N0:<strong class="text-primary">#{{
                                            $invoice->invoice_no }}</strong> </b><br>
                                    <br>
                                    <b style="font-size: 13px;">Bordereau №:</b> #{{ $invoice->invoice_zip }}<br>

                                    {{-- <b>Order ID:</b> 4F3S8J<br> --}}
                                    <b>Montant Du :</b> <b class="" style="color: red">{{
                                        number_format($payment->due_amount,0,' ',',')}}
                                    </b>fcfa<br>
                                    <b>Montant Paye :</b> <b style="color: blue">{{
                                        number_format($payment->paid_amount,0,' ',',')}}</b> fcfa
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
                @php
                $payment = App\Models\Payement::where('invoice_id',$invoice->id)->first();
                @endphp

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
                        @endphp
                        @foreach ($invoice['invoice_details'] as $key =>$details )
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
                            <td>{{ number_format($details->unit_price ,0,' ',',')}}</td>
                            <td>{{ $details->qty }}</td>
                            <td>{{ number_format($details->item_total,0,' ',',')}}</td>
                            @php
                            $total_sum += $details->item_total
                            @endphp
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="8" style="text-align: right"><strong>Sub Total</strong>
                            </td>
                            <td class="text-center"> <span>{{ number_format($total_sum,0,' ',',')}}</span></td>
                        </tr>
                        <tr>
                            <td colspan="8" style="text-align: right"><span>Discount</span> </td>
                            <td class="text-center"> <span>{{ number_format($payment->discount_amount,0,' ',',')
                                    }}</span></td>
                        </tr>
                        <tr>
                            <td colspan="8" style="text-align: right"><span>Montant Paye</span> </td>
                            <td class="text-center"> <span style="background-color: #0be881">{{
                                    number_format($payment->paid_amount,0,' ',',')}}</span></td>
                        </tr>
                        <tr>
                            <td colspan="8" style="text-align: right"><span>Montant due</span> </td>
                            <td class="text-center"> <span style="background-color: #ff5e57">{{
                                    number_format($payment->due_amount,0,' ',',')}}</span></td>
                        </tr>
                        <tr>
                            <td colspan="8" style="text-align: right"><strong>Grand total</strong> </td>
                            <td class="text-center"> <strong>{{ number_format($payment->total_amount,0,'
                                    ',',')}}</strong></td>
                        </tr>
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





    <div style="margin-top: 100px">
        <h5><i class="fas fa-info"></i> Note:</h5>
        This page has been enhanced for printing. Click the print button at the bottom of the invoice to
        test.
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint optio perspiciatis libero, et ipsa
        dolorum reprehenderit modi aspernatur doloribus nam unde. Maxime iste, dolorum ab nostrum nulla
        fugit quasi expedita?

    </div>

</body>

</html>