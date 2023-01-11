<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Facture PDF</title>
    <style>
        .box {
            /* flex-direction: row; */
            display: flex;
            /* background: #000; */
        }
    </style>
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
                            <h4 class="" style="font-size: 26px">Date:{{date('d-M-Y',
                                strtotime($client['payement_detail']['date']))}}</h4>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <br>
        <table style="border: 1px solid #333;" width="100%">
            <thead>
                <tr>
                    <th colspan="2">PERSONNAL INFORMATION</th>
                </tr>
            </thead>
        </table>
        <br>
        <div class="row">
            <div class="col-md-6">
                <table width="100%">
                    <tr>
                        <td width="40%">
                            <strong>
                                <div class="col-sm-4 ">
                                    <span class="" style="font-size: 18px">From</span>
                                    <address>
                                        <strong>{{ $client->name }}, {{ $client->firstname }}.</strong><br>
                                        {{ $client->country->name }}<br>
                                        {{ $client->state->name }}, {{ $client->address }}<br>
                                        Phone: {{ $client->phone }}<br>
                                        Email: {{ $client->email }}
                                    </address>
                                </div>
                            </strong>
                        </td>
                        <td width="40%">
                            <strong>
                                <div class="col-sm-4">
                                    <span class="" style="font-size: 18px">To</span>
                                    <address>
                                        <strong>{{ $client->receives[0]->namer }},
                                            {{ $client->receives[0]->firstnamer }}.</strong><br>
                                        {{ $client['receives'][0]['countryr']['name'] }}<br>
                                        {{ $client['receives'][0]['stater']['name'] }}, {{
                                        $client->receives[0]->addressr }}<br>
                                        Phone: {{ $client->receives[0]->phoner }}<br>
                                        Email: {{ $client->receives[0]->emailr }}
                                    </address>
                                </div>
                            </strong>
                        </td>
                        <td width="20%">
                            <strong>
                                <div class="col-sm-4">
                                    <b style="font-size: 17px">Facture N0:<strong class="text-primary">{{
                                            $client->client_number
                                            }}</strong> </b><br>
                                    <br>
                                    {{-- <b>Order ID:</b> 4F3S8J<br> --}}
                                    <b>Montant Du :</b> <b class="" style="color: red">{{
                                        $client['payements'][0]['due_amount'] }} </b>fcfa<br>
                                    <b>Montant Paye :</b> <b style="color: blue">{{
                                        $client['payements'][0]['paid_amount'] }}</b> fcfa
                                </div>
                            </strong>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <br>
    <table style="border: 1px solid #333;" width="100%">
        <thead>
            <tr>
                <th colspan="2" style="">PACKAGE INFORMATION</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="border: 1px solid #333;">NOM: {{ $client['package']['name'] }}</td>
                <td style="border: 1px solid #333;">IDENTIFIANT : {{ $client['package']['numero_id'] }}</td>
            </tr>
        </tbody>
    </table>
    <br>
    <br>
    <br>
    <table style="border: 1px solid #333;" width="100%">
        <thead>
            <tr>
                <th colspan="2" style="">ARTICLE INFORMATION</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
    <br>

    <div class="container">
        <div class="row">
            <div class="">
                <table style="font-size: 20px;border: 1px solid #333;">
                    <thead>
                        <tr>
                            <th width="20%">
                                MODEL & MARQUE
                            </th>
                            <th width="10%">
                                CHASSIS
                            </th>
                            <th width="15%">
                                LONGUEUR
                            </th>
                            <th width="15%">
                                LARGEUR
                            </th>
                            <th width="10%">
                                HAUTEUR
                            </th>
                            <th width="10%">
                                PRIX .U
                            </th>
                            <th width="10%">
                                QUANTITY
                            </th>
                            <th width="10%" class="text-right">
                                TOTAL
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($show as $key=>$item )
                        <tr>
                            <td align="center"> <span style="text-transform: uppercase;">{{
                                    $item->model_marque }}</span></td>
                            <td align="center"><span style="text-transform: uppercase;">{{ $item->chassis }}</span>
                            </td>
                            <td align="center">{{ $item->length }}</td>
                            <td align="center">{{ $item->width }}</td>
                            <td align="center">{{ $item->height }}</td>
                            <td align="center">{{ $item->unit_price }}</td>
                            <td align="center">{{ $item->qty }}</td>
                            <td align="" class="text-right" style="background: #ddd;text-align: right">{{
                                $item->item_total }}</td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div><br>

    <div class="">
        <div class="" style="">
            <table class="" style="" width="100%">
                <tr>
                    <td colspan="" width="10%"></td>
                    <td colspan="" width="10%"></td>
                    <td colspan="" width="10%"></td>
                    <td colspan="" width="10%"></td>
                    <td colspan="" width="10%"></td>
                    <td colspan="" width="15%"></td>
                    <td colspan="" width="8%" align="">Subtotal:</td>
                    <td colspan="" width="10%" align="" style="text-align: right">{{ $show[0]->sub_total }}</td>
                </tr>
                <tr>
                    <td colspan="" width="10%"></td>
                    <td colspan="" width="10%"></td>
                    <td colspan="" width="10%"></td>
                    <td colspan="" width="10%"></td>
                    <td colspan="" width="10%"></td>
                    <td colspan="" width="20%"></td>
                    <td width="8%">Tax (%):</td>
                    <td width="10%" align="" style="text-align: right">{{ $show[0]->tax_1 }}
                    </td>
                </tr>
                <tr>
                    <td colspan="" width="10%"></td>
                    <td colspan="" width="10%"></td>
                    <td colspan="" width="10%"></td>
                    <td colspan="" width="10%"></td>
                    <td colspan="" width="10%"></td>
                    <td colspan="" width="20%"></td>
                    <td width="8%">Discount:</td>
                    <td width="10%" align="" style="text-align: right">{{ $show[0]->discount }}
                    </td>
                </tr>
                <tr>
                    <td colspan="" width="10%"></td>
                    <td colspan="" width="10%"></td>
                    <td colspan="" width="10%"></td>
                    <td colspan="" width="10%"></td>
                    <td colspan="" width="10%"></td>
                    <td colspan="" width="20%"></td>
                    <td width="8%">Grand total:</td>
                    <td width="10%" align="" style="text-align: right"> <b> {{
                            $show[0]->grand_total }}</b>
                    </td>

                </tr>
            </table>
            <br>
            <br>
            <!-- /.col -->
            @php
            $date= new DateTime();
            @endphp
            <span style="font-weight: bold">Inprimer le: </span> <i>{{ $date->format('F j, Y, H:i:s') }}</i>
        </div>
    </div>

    <div>
        <hr style="margin-bottom: 0px;">
        <table width="100%">
            <tbody>
                <tr>
                    <td style="width: 20%;">
                        <p style="text-align: center; margin-left: 20px;">
                            Customer Signature
                        </p>
                    </td>
                    <td style="width: 20%;"></td>
                    <td style="width: 40px; text-align: center;">
                        <p style="text-align: center;">Seller Signature</p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>





    <!-- Bootstrap 4 -->
    {{-- <script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script> --}}
</body>

</html>