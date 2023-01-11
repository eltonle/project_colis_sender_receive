@extends('layouts.master')
@section("css")
<link rel="stylesheet" href="{{ asset('build/css/intlTelInput.min.css') }}">
<link rel="stylesheet" href="{{ asset('build/css/intlTelInput.css') }}">
<style>
    .hide {
        display: none;
    }

    .error0 {
        color: green;
    }

    .error1 {
        color: red;
    }
</style>
@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3 class="m-0 font-weight-bold" style="color:#6F1E51"> Manage Client</h3>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Clients</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        {{-- <div class="callout callout-info">
                            <h5><i class="fas fa-info"></i> Note:</h5>
                            This page has been enhanced for printing. Click the print button at the bottom of the
                            invoice to test.
                        </div> --}}


                        <!-- Main content -->
                        <div class="invoice p-3 mb-3">
                            <!-- title row -->
                            <div class="row">
                                <div class="col-12">
                                    <h4 class="font-weight-bold">
                                        <i class="fas fa-globe text-indigo"></i> Express, Colis.
                                        <small class="float-right">Date:{{date('d-M-Y',
                                            strtotime($client['payement_detail']['date']))}}</small>
                                    </h4>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- info row -->
                            <div class="row invoice-info" style="font-size: 17px">
                                <div class="col-sm-4 invoice-col">
                                    From
                                    <address>
                                        <strong>{{ $client->name }}, {{ $client->firstname }}.</strong><br>
                                        {{ $client->country->name }}<br>
                                        {{ $client->state->name }}, {{ $client->address }}<br>
                                        Phone: {{ $client->phone }}<br>
                                        Email: {{ $client->email }}
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 invoice-col">
                                    To
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
                                <!-- /.col -->
                                <div class="col-sm-4 invoice-col">
                                    <b>Invoice # <strong class="text-primary">{{ $client->client_number
                                            }}</strong></b><br>
                                    <br>
                                    {{-- <b>Order ID:</b> 4F3S8J<br> --}}
                                    <b>Montant Du :</b> <strong class="text-danger font-weight-bold">{{
                                        $client['payements'][0]['due_amount'] }} fcfa</strong><br>
                                    <b>Montant Paye :</b> {{ $client['payements'][0]['paid_amount'] }} fcfa
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <!-- Table row -->
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Model&Marque</th>
                                                <th>Chassis</th>
                                                <th>Length </th>
                                                <th>Width</th>
                                                <th>Height</th>
                                                <th>Unit-price</th>
                                                <th>Quantity</th>
                                                <th class="text-right">Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($show as $key=>$item )
                                            <tr>
                                                <td>{{ $item->model_marque }}</td>
                                                <td>{{ $item->chassis }}</td>
                                                <td>{{ $item->length }}</td>
                                                <td>{{ $item->width }}</td>
                                                <td>{{ $item->height }}</td>
                                                <td>{{ $item->unit_price }}</td>
                                                <td>{{ $item->qty }}</td>
                                                <td class="text-right">{{ $item->item_total }}</td>
                                            </tr>
                                            @endforeach


                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <div class="row">
                                <!-- accepted payments column -->
                                <div class="col-8">
                                    {{-- <p class="lead">Payment Methods:</p>
                                    <img src="../../dist/img/credit/visa.png" alt="Visa">
                                    <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
                                    <img src="../../dist/img/credit/american-express.png" alt="American Express">
                                    <img src="../../dist/img/credit/paypal2.png" alt="Paypal">

                                    <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning
                                        heekya handango imeem
                                        plugg
                                        dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                                    </p> --}}
                                </div>
                                <!-- /.col -->
                                <div class="col-4">
                                    {{-- <p class="lead">Amount Due 2/22/2014</p> --}}

                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <th style="width:70%">Subtotal:</th>
                                                <td>{{ $show[0]->sub_total }} Fcfa</td>
                                            </tr>
                                            <tr>
                                                <th style="width:70%">Tax (%)</th>
                                                <td>{{ $show[0]->tax_1 }} Fcfa
                                                </td>
                                            </tr>
                                            <tr>
                                                <th style="width:70%">Discount:</th>
                                                <td>{{ $show[0]->discount }} Fcfa</td>
                                            </tr>
                                            <tr>
                                                <th>Grand total:</th>
                                                <td class="text-black font-weight-bold">{{
                                                    $show[0]->grand_total }} Fcfa</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <!-- this row will not appear when printing -->
                            <div class="row no-print">
                                <div class="col-12">
                                    {{-- <a href="invoice-print.html" rel="noopener" target="_blank"
                                        class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                                    <button type="button" class="btn btn-success float-right"><i
                                            class="far fa-credit-card"></i> Submit
                                        Payment
                                    </button> --}}
                                    <button type="button" class="btn btn-primary float-right"
                                        style="margin-right: 5px;">
                                        <i class="fas fa-download"></i> Generate PDF
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- /.invoice -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection

@section('scripts')

<!-- Number script -->
<script src="{{ asset('build/js/intlTelInput.min.js') }}"></script>
<script src="{{ asset('build/js/intlTelInput.js') }}">
    </script
@endsection