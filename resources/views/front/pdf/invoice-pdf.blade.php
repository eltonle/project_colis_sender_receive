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
        <div class="row">
            <div class="">
                <table width="100%" cellspacing="0">
                    <tr>
                        <td width="20%" align="center">
                            <h4 class="" style="font-size: 28px;background: #ddd; text-align: center">
                                Express<br> Colis
                            </h4>
                        </td>
                        <td width="40%" align="center">
                            <strong style="font-size: 16px">Mat:008976785R768 </strong><br>
                            <span style="font-size: 16px">Phone: (+237) 690-700-600</span><br>
                            <span style="font-size: 16px">Email: express.colis@example.com</span><br>
                            <span style="font-size: 16px">Lieu: 2023 E Bp-site CMR-Douala</span><br>

                        </td>
                        <td width="40%" style="font-weight: bold; text-align: center">
                            {{-- {!! DNS1D::getBarcodeSVG($invoice->invoice_zip, "c39", 1, 80, 'black') !!} --}}
                            <img src="data:image/png;base64,{{DNS1D::getBarcodePNG($invoice->invoice_zip, 'C39+')}}"
                                width="50%" height="100px" />
                            <span>CMR{{ $invoice->invoice_zip }}</span>
                        </td>
                        {{-- <td width="10%">
                            <h4 class="" style="font-size: 26px">Date:{{ date('d-M-Y',strtotime($invoice->date)) }}</h4>
                        </td> --}}
                    </tr>
                </table>
                <br><br>
                <table width="100%" style="font-size: 17px">
                    <tbody>
                        <tr>
                            <td>
                                <strong>Bordereau de</strong><br> <br>
                                <strong>{{ $invoice->payement->customer->nom }}-{{ $invoice->payement->customer->prenom }}</strong> {{ $invoice->country->name }}|{{ $invoice->state->name }}<br>
                                Phone: (555) {{ $invoice->payement->customer->phone }}<br>
                                Email: {{ $invoice->payement->customer->email }}
                            </td>
                            <td align="right">
                                <table style="border-collapse: collapse">
                                    @php
                                     $payment = App\Models\Payement::where('invoice_id',$invoice->id)->first();
                                    @endphp
                                    <tbody>
                                        <tr>
                                            <td align="left"
                                                style="border:1px solid black; background: #34495e;color:#fff">
                                                Récépissé
                                            </td>
                                            <td style="border: 1px solid black" style="border: 1px solid black"
                                                align="right">№: {{ $invoice->invoice_no }}</td>
                                        </tr>
                                        <tr>
                                            <td align="left"
                                                style="border:1px solid black; background: #34495e;color:#fff">
                                                Date</td>
                                            <td style="border: 1px solid black" align="right">{{ date('d-M-Y',strtotime($invoice->date )) }}</td>
                                        </tr>
                                        <tr>
                                            <td align="left"
                                                style="border:1px solid black; background: #34495e;color:#fff">
                                                Montant paye
                                            </td>
                                            <td style="border: 1px solid black" align="right">{{
                                                number_format($payment->paid_amount,0,' ',',')}} Fcfa</td>
                                        </tr>
                                        <tr>
                                            <td align="left"
                                                style="border:1px solid black; background: #34495e;color:#fff">
                                                Montant du
                                            </td>
                                            <td style="border: 1px solid black" align="right">{{
                                                number_format($payment->due_amount,0,' ',',')}} Fcfa</td>
                                        </tr>
                                    </tbody>

                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
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
        <div class="">
            <div class="card-body">
                @php
                $payment = App\Models\Payement::where('invoice_id',$invoice->id)->first();
                @endphp

                <table border="1" width='100%' style="margin-bottom: 4px;" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th class="font-size: 12px; text-center"
                                style="font-size: 12px; background:rgb(13, 8, 63); color:#fff; padding:5px;">#ID</th>
                            <th style="font-size: 12px; background: #34495e; color:#fff; padding: 5px">Type</th>
                            <th style="font-size: 12px; background: #34495e; color:#fff; padding: 5px">Titre</th>
                            <th style="font-size: 12px; background: #34495e; color:#fff; padding: 5px">Code</th>
                            <th style="font-size: 12px; background: #34495e; color:#fff; padding: 5px">Total prix</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $total_sum = '0';
                        @endphp
                        @foreach ($invoice['colis_dimensions'] as $key =>$details )
                        <tr class="text-center">
                            {{-- <input type="hidden" name="qty[{{ $details->id }}]" value="{{ $details->qty }}"> --}}
                            <td class="text-center" style="font-size: 16px;background:#ddd; padding:1px;">{{ $key+1 }}
                            </td>
                            <td style="font-size: 16px">{{
                                $details->type }}</td>
                            <td style="font-size: 16px">{{ $details->titre }}</td>
                            <td style="font-size: 16px">№: {{ $details->code_zip }}</td>
                            <td style="font-size: 16px">{{ number_format($details->prix ,0,'
                                ',',')}} Fcfa</td>
                            {{-- <td style="font-size: 18px">{{ $details->largeur }}</td> --}}
                            {{-- <td style="font-size: 18px">{{ $details->hauteur}}</td> --}}
                            {{-- <td style="font-size: 18px">{{ number_format($details->unit_price ,0,' ',',')}}</td> --}}
                            {{-- <td style="font-size: 18px">{{ $details->qty }}</td> --}}
                            {{-- <td style="font-size: 18px">{{ number_format($details->item_total,0,' ',',')}}</td> --}}
                            @php
                            $total_sum += $details->prix
                            @endphp
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="4" style="font-size: 16px; text-align: right"><strong>Sub Total</strong>
                            </td>
                            <td style="font-size: 16px" class="text-center"> <span>{{ number_format($total_sum,0,'
                                    ',',')}}</span>Fcfa</td>
                        </tr>
                        <tr>
                            <td colspan="4" style="font-size: 16px; text-align: right"><span>Discount</span> </td>
                            <td style="font-size: 16px" class="text-center"> <span>{{
                                    number_format($payment->discount_amount,0,' ',',')
                                    }}</span>Fcfa</td>
                        </tr>
                        <tr>
                            <td colspan="4" style="font-size: 16px; text-align: right"><span>Montant Paye</span> </td>
                            <td style="font-size: 16px" class="text-center"> <span style="background-color: #0be881">{{
                                    number_format($payment->paid_amount,0,' ',',')}}</span>Fcfa</td>
                        </tr>
                        <tr>
                            <td colspan="4" style="font-size: 16px; text-align: right"><span>Montant du</span> </td>
                            <td style="font-size: 16px" class="text-center"> <span style="background-color: #ff5e57">{{
                                    number_format($payment->due_amount,0,' ',',')}}</span>Fcfa</td>
                        </tr>
                        <tr>
                            <td colspan="4" style="font-size: 16px; text-align: right"><strong>Grand total</strong>
                            </td>
                            <td style="font-size: 16px" class="text-center"> <strong>{{
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
                        <td width="20%" style="font-weight: bold; font-size: 16px">Termes</td>
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