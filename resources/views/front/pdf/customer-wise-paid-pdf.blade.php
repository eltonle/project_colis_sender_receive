<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rapport Client Payement PDF</title>
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
            <hr>
            <table>
                <tbody>
                    <tr>
                        <td width="45%"></td>
                        <td width=""><strong>RAPPORT PAYEMENT CLIENT </strong></td>
                        <td width="15%"></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div>
            <table border="1" width="100%">
                <thead>
                    <tr>
                        <th>No facture</th>
                        <th>Nom du Client</th>
                        <th>Date</th>
                        <th>Status Paid</th>
                        <th>Montant payement</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $total_paid = '0';
                    @endphp
                    @foreach ($allData as $key => $payment)
                    <tr>
                        <td> <span class="" style="background: #ddd; font-weight: 900">Facture № #{{
                                $payment['invoice']['invoice_no']
                                }}</span>
                        </td>
                        <td>
                            {{ $payment['customer']['nom'] }}-
                            ( {{ $payment['customer']['phone'] }},{{
                            $payment['customer']['address'] }})
                        </td>
                        <td>{{ date('d-m-Y',strtotime($payment['invoice']['date'])) }}</td>
                        <td>{{ $payment->paid_status}}</td>
                        <td>{{ $payment->paid_amount}}</td>
                        @php
                        $total_paid += $payment ->paid_amount;
                        @endphp
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="4" style="text-align: right; font-weight: bold">Grand Total</td>
                        <td>{{ $total_paid }}</td>
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