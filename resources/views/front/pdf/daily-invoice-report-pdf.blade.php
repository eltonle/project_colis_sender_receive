<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rapport Quotidien PDF</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <table width="100%">
                    <tr>
                        <td width="50%">
                            <h4 class="" style="font-size: 26px;background: #ddd;">
                                <i class="fas fa-globe text-indigo"></i> Express, Colis.
                            </h4>
                        </td>
                        <td width="50%">
                            <h4 class="" style="font-size: 26px">Date du jour:<span style="font-size: 18px"> {{ $date
                                    }}</span></h4>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <br>
        <div>
            <table>
                <tbody>
                    <tr>
                        <td width="33%"></td>
                        <td width=""><strong>Rapport du {{ date('d-M-Y',strtotime($start_date)) }} Au {{
                                date('d-M-Y',strtotime($end_date)) }}</strong></td>
                        <td width="15%"></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div>
            <table border="1" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Récépissé</th>
                        <th>Nom du Client</th>
                        <th>Date</th>
                        <th>Status Paiement</th>
                        <th>Montant paye</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $total_sum = '0';
                    @endphp
                    @foreach ($allData as $key => $invoice)
                    <tr>
                        <td> <span class="" style="background: #ddd; font-weight: 900">Récépissé № #{{
                                $invoice->invoice_no
                                }}</span>
                        </td>
                        <td>
                            {{ $invoice['payement']['customer']['nom'] }}-
                            ( {{ $invoice['payement']['customer']['phone'] }})
                        </td>
                        <td>{{ date('d-m-Y',strtotime($invoice->date)) }}</td>
                        <td>
                            @if ($invoice['payement']['paid_status'] === 'full_paid')
                                <span style="color: green;">Payé</span>
                                @elseif ($invoice['payement']['paid_status'] === 'partial_paid')
                                <span style="color:#7CB342;">partielement payé</span> 
                                @elseif ($invoice['payement']['paid_status'] === 'full_due')
                                <span style="color: #B00020;">non payé</span>
                                @else
                                <span>Statut inconnu</span>
                            @endif
                        </td>
                        <td>{{ number_format($invoice['payement']['paid_amount'] ,0,' ',',') }}Fcfa</td>
                        @php
                        $total_sum += $invoice['payement']['paid_amount']
                        @endphp
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="4" style="text-align: right">Grand Total</td>
                        <td>{{ number_format( $total_sum,0,' ',',')}}Fcfa</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

    <div>
        <hr style="margin-bottom: 0px;">
        <table width="100%">
            <tbody>
                <tr>
                    <td style="width: 40%;">
                    </td>
                    <td style="width: 25%;"></td>
                    <td style="width: 40px; text-align: center;">
                        <p style="text-align: center; font-weight: bold"> Signature du Responsable</p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>



</body>

</html>