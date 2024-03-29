<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Details Expedition PDF</title>
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
                    <th colspan="2">EXPEDITION DETAILLÉE DES PAIEMENTS</th>
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
                                    <span class="" style="font-size: 18px">Expedition</span>
                                    <address>
                                        <strong>{{ $payment['customer']['nom'] }}, {{ $payment['customer']['prenom']
                                            }}.</strong><br>
                                        Address: {{ $payment['customer']['address'] }}<br>
                                        <b>{{ $payment['invoice']['country']['name'] }}</b>, <b>{{
                                            $payment['invoice']['state']['name'] }}</b><br>
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
                                        Address: {{ $payment['receive']['address'] }}<br>
                                        <b>{{ $payment['invoice']['countryr']['name'] }}</b>, <b>{{
                                            $payment['invoice']['stater']['name'] }}</b><br>
                                        Phone: {{ $payment['receive']['phone'] }}<br>
                                        Email: {{ $payment['receive']['email'] }}
                                    </address>
                                </div>
                            </strong>
                        </td>
                        <td width="20%">
                            <strong>
                                <div class="col-sm-4">
                                    <b style="font-size: 17px">Récépissé №:<strong class="text-primary">#{{
                                            $payment['invoice']['invoice_no'] }}</strong> </b><br>
                                    <br>
                                    <b style="font-size: 13px;">Bordereau №:</b> #{{ $payment['invoice']['invoice_zip']
                                    }}<br>


                                    <b>Montant Du :</b> <b class="" style="color: red">{{
                                        number_format($payment->due_amount,0,' ',',') }}
                                    </b>Fcfa<br>
                                    <b>Montant Paye :</b> <b style="color: blue">{{
                                        number_format($payment->paid_amount,0,' ',',') }}</b> Fcfa
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
                <table border="1" width='100%' style="margin-bottom: 10px" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th class="text-center" style="background:#ddd; padding:1px;">#ID</th>
                            <th>Type Colis</th>
                            <th>Code_Zip</th>
                            <th>Titre</th>
                            <th>Prix</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $total_sum = '0';
                        $colis_details = App\Models\ColisDimension::where('invoice_id',$payment->invoice_id)->get();
                        @endphp
                        @foreach ($colis_details as $key =>$details )
                        <tr class="text-center">
                            <td class="text-center" style="background:#ddd; padding:1px;">{{ $key+1 }}
                            </td>
                            <td>{{
                                $details->type }}</td>
                            <td>{{ $details->code_zip }}</td>
                            <td>{{ $details->titre }}</td>
                            <td>{{ number_format($details->prix,0,' ',',')}} Fcfa</td>
                            @php
                            $total_sum += $details->prix
                            @endphp
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="4" style="text-align: right"><strong>Sub Total</strong>
                            </td>
                            <td class="text-center"> <span>{{ number_format($total_sum ,0,' ',',') }}</span>Fcfa</td>
                        </tr>

                        <tr>
                            <td colspan="4" style="text-align: right"><span>Montant Paye</span> </td>
                            <td class="text-center"> <span style="background-color: #0be881">{{
                                    number_format( $payment->paid_amount,0,' ',',')}}</span>Fcfa</td>
                        </tr>
                        <tr>
                            <td colspan="4" style="text-align: right"><span>Montant due</span> </td>
                            <td class="text-center"> <span style="background-color: #ff5e57">{{
                                    number_format( $payment->due_amount,0,' ',',')}}</span>Fcfa</td>
                        </tr>
                        <tr>
                            <td colspan="4" style="text-align: right"><strong>Grand total</strong> </td>
                            <td class="text-center"> <strong>{{ number_format( $payment->total_amount,0,'
                                    ',',')}}</strong>Fcfa</td>
                        </tr>
                        <tr>
                            <td colspan="5" style="text-align: center; font-weight: bold"><strong>Sommaire de
                                    Paiement</strong></td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align: center; font-weight: bold;">Date</td>
                            <td colspan="2" style="text-align: center; font-weight: bold;">Montant versé</td>
                        </tr>
                        @php
                        $payment_details = App\Models\PayementDetail::where('invoice_id', $payment->invoice_id)->get();
                        @endphp
                        @foreach ($payment_details as $dtl )
                        <tr>
                            <td colspan="3" style="text-align: center;">{{ date('d-M-Y',strtotime($dtl->date)) }}</td>
                            <td colspan="2" style="text-align: center;">{{ number_format( $dtl->current_paid_amount,0,'
                                ',',')}} Fcfa</td>
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