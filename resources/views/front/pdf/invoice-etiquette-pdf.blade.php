<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reçu PDF</title>
    <style>
        body {
            box-sizing: border-box;
            margin: 0px;
        }
    </style>
</head>

<body>
    <div class="">
        <hr>
        <div style="margin-top: -10px">
            <div class="">
                <table width="100%">
                    <tr>
                        <td width="20%" align="center">
                            <h4 class="" style="font-size:25px;text-align: center; background:#ddd;">
                                Express<br> Colis
                            </h4>
                        </td>
                        <td width="40%" align="center">
                            <strong style="font-size: 15px">Mat:008976785R768 </strong><br>
                            <span style="font-size: 15px">Phone: (+237) 698-767-655</span><br>
                            <span style="font-size: 15px">Email: john.doe@example.com</span><br>
                            <span style="font-size: 15px">Lieu: 2023 E Bp-site CMR-Douala</span><br>

                        </td>
                        {{-- <td width="40%" style="font-weight: bold;">
                            {!! DNS1D::getBarcodeSVG($invoice->invoice_zip, "c39", 1, 80, 'black') !!}
                        </td> --}}
                        {{-- <td width="10%">
                            <h4 class="" style="font-size: 26px">Date:{{ date('d-M-Y',strtotime($invoice->date)) }}</h4>
                        </td> --}}
                    </tr>
                </table>
                <table width="100%" style="text-align: center">
                    <tr>
                        <td width="30%"></td>
                        <td style="font-weight: bold; text-align: center">
                            {{-- {!! DNS1D::getBarcodeSVG($invoice->invoice_zip, "C39", 1, 80, 'black') !!} <br> --}}
                            <img src="data:image/png;base64,{{DNS1D::getBarcodePNG($invoice->invoice_zip, 'C39+')}}"
                                alt="barcode" width="50%" height="100px" style="color: black" />
                            <span>CMR{{ $invoice->invoice_zip }}</span>
                        </td>
                        <td width="30%"></td>
                    </tr>
                </table>
                <br><br>
                <table width="100%" style="text-align: center; margin-top: -47px;">
                    <tr>
                        <td width="30%"></td>
                        <td style="font-weight: bold; ">
                            <h2>##{{ $invoice->invoice_zip }}</h2>
                        </td>
                        <td width="30%"></td>
                    </tr>
                </table>
                <br><br>
                <table width="100%" style="font-size: 14px; margin-top: -35px;" cellspacing="0">
                    <tbody>
                        <tr>
                            <td>
                                <strong>Référence :</strong><br> <br>
                                <strong>MARIA BELEN</strong><br>
                                Address: Douala-Cameroun|ange rapheal<br>
                                Phone: (555) 539-1037<br>
                            </td>
                            <td align="right">
                                <table style="border-collapse: collapse">
                                    <tbody>
                                        <tr>
                                            <td align="left"
                                                style="border:1px solid black; background: #222f3e; font-weight: bold; color:#fff">
                                                Récépissé
                                            </td>
                                            <td style="border: 1px solid black" style="border: 1px solid black"
                                                align="right">№: 1</td>
                                        </tr>
                                        <tr>
                                            <td align="left"
                                                style="border:1px solid black; background: #222f3e; font-weight: bold; color:#fff">
                                                Date</td>
                                            <td style="border: 1px solid black" align="right">22-jan-2023</td>
                                        </tr>

                                    </tbody>

                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <br><br>
                <table width="100%" style="font-size: 17px; margin-top: -35px;">
                    <tbody>
                        <tr>
                            <td>
                                <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($invoice->invoice_zip,'QRCODE')}}"
                                    alt="barcode" width="100px" height="120px" />
                            </td>
                            <td align="right">
                                <table style="border-collapse: collapse">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <h3>CAMEROUN - TCHAD</h3>
                                            </td>
                                        </tr>

                                    </tbody>

                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <hr>
            </div>
        </div>
        <br>
        {{-- <table style="border: 1px solid #333;" width="100%">
            <thead>
                <tr>
                    <th colspan="2"><span style="font-size: 23px">Reçu d'Expedition</span></th>
                </tr>
            </thead>
        </table> --}}
        <br>
        {{-- <div class="row">
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
                                        {{ $payment['receive']['address'] }}<br>
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
                                            $invoice->invoice_no }}</strong> </b><br>
                                    <br>
                                    <b style="font-size: 13px;">Bordereau №:</b> #{{ $invoice->invoice_zip }}<br>


                                    <b>Montant Du :</b> <b class="" style="color: red">{{
                                        number_format($payment->due_amount,0,' ',',')}}
                                    </b>FCFA<br>
                                    <b>Montant Paye :</b> <b style="color: blue">{{
                                        number_format($payment->paid_amount,0,' ',',')}}</b> FCFA
                                </div>
                            </strong>
                        </td>
                    </tr>
                </table>
            </div>
        </div> --}}
    </div>

    <div>

        <br>
        {{-- <table style="border: 1px solid #333;" width="100%">
            <thead>
                <tr>
                    <th colspan="2">INFORMATION COlIS</th>
                </tr>
            </thead>
        </table> --}}
        <br>
        {{-- <div class="">
            <div class="card-body">
                @php
                $payment = App\Models\Payement::where('invoice_id',$invoice->id)->first();
                @endphp

                <table border="1" width='100%' style="margin-bottom: 10px;">
                    <thead>
                        <tr class="text-center">
                            <th class="font-size: 18px; text-center"
                                style="font-size: 18px; background:rgb(13, 8, 63); color:#fff; padding:5px;">#ID</th>
                            <th style="font-size: 18px; background: #34495e; color:#fff; padding: 5px">Model&Marque</th>
                            <th style="font-size: 18px; background: #34495e; color:#fff; padding: 5px">Chassis</th>
                            <th style="font-size: 18px; background: #34495e; color:#fff; padding: 5px">Longueur</th>
                            <th style="font-size: 18px; background: #34495e; color:#fff; padding: 5px">Largeur</th>
                            <th style="font-size: 18px; background: #34495e; color:#fff; padding: 5px">Hauteur</th>
                            <th style="font-size: 18px; background: #34495e; color:#fff; padding: 5px">Prix u.</th>
                            <th style="font-size: 18px; background: #34495e; color:#fff; padding: 5px">Qty</th>
                            <th style="font-size: 18px; background: #34495e; color:#fff; padding: 5px">Total prix</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $total_sum = '0';
                        @endphp
                        @foreach ($invoice['invoice_details'] as $key =>$details )
                        <tr class="text-center">
                            <input type="hidden" name="qty[{{ $details->id }}]" value="{{ $details->qty }}">
                            <td class="text-center" style="font-size: 18px;background:#ddd; padding:1px;">{{ $key+1 }}
                            </td>
                            <td style="font-size: 18px">{{
                                $details->model_marque }}</td>
                            <td style="font-size: 18px">{{ $details->chassis }}</td>
                            <td style="font-size: 18px">{{ $details->longueur }}</td>
                            <td style="font-size: 18px">{{ $details->largeur }}</td>
                            <td style="font-size: 18px">{{ $details->hauteur}}</td>
                            <td style="font-size: 18px">{{ number_format($details->unit_price ,0,' ',',')}}</td>
                            <td style="font-size: 18px">{{ $details->qty }}</td>
                            <td style="font-size: 18px">{{ number_format($details->item_total,0,' ',',')}}</td>
                            @php
                            $total_sum += $details->item_total
                            @endphp
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="8" style="font-size: 18px; text-align: right"><strong>Sub Total</strong>
                            </td>
                            <td style="font-size: 18px" class="text-center"> <span>{{ number_format($total_sum,0,'
                                    ',',')}}</span>Fcfa</td>
                        </tr>
                        <tr>
                            <td colspan="8" style="font-size: 18px; text-align: right"><span>Discount</span> </td>
                            <td style="font-size: 18px" class="text-center"> <span>{{
                                    number_format($payment->discount_amount,0,' ',',')
                                    }}</span>Fcfa</td>
                        </tr>
                        <tr>
                            <td colspan="8" style="font-size: 18px; text-align: right"><span>Montant Paye</span> </td>
                            <td style="font-size: 18px" class="text-center"> <span style="background-color: #0be881">{{
                                    number_format($payment->paid_amount,0,' ',',')}}</span>Fcfa</td>
                        </tr>
                        <tr>
                            <td colspan="8" style="font-size: 18px; text-align: right"><span>Montant du</span> </td>
                            <td style="font-size: 18px" class="text-center"> <span style="background-color: #ff5e57">{{
                                    number_format($payment->due_amount,0,' ',',')}}</span>Fcfa</td>
                        </tr>
                        <tr>
                            <td colspan="8" style="font-size: 18px; text-align: right"><strong>Grand total</strong>
                            </td>
                            <td style="font-size: 18px" class="text-center"> <strong>{{
                                    number_format($payment->total_amount,0,'
                                    ',',')}}</strong>Fcfa</td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <br>

                <table width="100%" style="margin-bottom: -13px">
                    <tr>
                        <td width="45%"></td>
                        <td width="20%" style="font-weight: bold; font-size: 18px">Termes</td>
                        <td width="35%"></td>
                    </tr>
                </table>
                <hr>
                <p><strong>ACCEPTÉ</strong> : L'expéditeur déclare qu'il n'envoie pas d'argent, d'explosifs, d'armes, de
                    bijoux ou de
                    produits chimiques. En cas de saisie de la marchandise par les autorités douanières, le paiement des
                    taxes sera à la charge du client. EXPRESS COLIS répondra pour la valeur entre 0,00 fcfa et 50,000
                    Fcfa selon
                    l'évaluation et les critères assignés par l'entreprise. EXPRESS COLIS n'est pas responsable de la
                    casse ou de l'endommagement de la marchandise. Le client autorise l'agent à avoir un contact visuel
                    avec la boîte (revoir) son contenu.</p>
                <br>
                <br><br>
                <!-- /.col -->
                @php
                $date= new DateTime();
                @endphp
                <span style="font-weight: bold">Imprimer le: </span> <i>{{ $date->format('j F, Y, H:i:s') }}</i>

            </div>
        </div> --}}

    </div>

    {{-- <div>
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
    </div> --}}





    {{-- <div style="margin-top: 100px">
        <h5><i class="fas fa-info"></i> Note:</h5>
        This page has been enhanced for printing. Click the print button at the bottom of the invoice to
        test.
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint optio perspiciatis libero, et ipsa
        dolorum reprehenderit modi aspernatur doloribus nam unde. Maxime iste, dolorum ab nostrum nulla
        fugit quasi expedita?

    </div> --}}

</body>

</html>