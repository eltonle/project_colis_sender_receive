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
                    <h3 class="m-0 font-weight-bold"> Gestions des Expeditions</h3>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Tableau de Bord</a></li>
                        <li class="breadcrumb-item active">Expedition</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="">
                    <form action="{{ route('invoices.update_invoice') }}" method="post" enctype="multipart/form-data"
                        id="myForm">
                        @csrf
                        {{-- left col --}}
                        <section class="col-md-12">
                            {{-- custom tabs --}}
                            <div class="card">
                                <div class="card-header">
                                    <h3> Editer une Expedition
                                        <a href="{{ route('invoices.pending.list') }}" class="btn float-right btn-sm"
                                            style="background: #563DEA;color: #fff">
                                            <i class="fa fa-list"></i> LISTES DES EXPEDITIONS
                                        </a>
                                    </h3>
                                </div><!-- /.card-header -->
                                <div class="card-body">
                                    <!-- /.card-header -->
                                    <div class="form-row">
                                        <div class="form-group col-md-2">
                                            <label> Récépissé No:</label>
                                            <input type="hidden" name="invoice_no" value="{{ $invoice->invoice_no }}">
                                            <input type="hidden" name="id" value="{{ $invoice->id }}">
                                            <input type="hidden" name="invoiceZip" value="{{ $invoice->invoice_zip }}">
                                            <input type="hidden" name="date" value="{{ $invoice->date }}">
                                            <input type="text" name="invoice_no" value="{{ $invoice->invoice_no }}"
                                                id="invoice_no" class="form-control form-control-sm font-bold" disabled
                                                style="background: #2962FF;color: #fff">
                                        </div>
                                        <div class="form-group col-md-6">
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label>Date</label>
                                            <input type="date" name="date" id="date" value="{{ $invoice->date }}"
                                                class="form-control datepicker form-control-sm" placeholder="YYY-MM-DD"
                                                disabled>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                {{-- <div class="row"> --}}
                                    {{-- left col --}}
                                    <section class="col-md-12">
                                        {{-- custom tabs --}}
                                        <div class="">
                                            <div class="card-header">
                                                <h3><i class="fas fa-user-friends" style="color: #2c3e50"></i>
                                                    Information
                                                    sur l'Expediteur:
                                                </h3>
                                            </div>
                                            <!-- expediteur -->
                                            <div class="form-group col-md-12" style="margin-top: 20px">
                                                <label>NOM DE L'EXPEDITEUR</label>
                                                <select name="customer_id" id="customer_id"
                                                    class="form-control select2 select2-danger "
                                                    data-dropdown-css-class="select2-gray">
                                                    <option value="">Selectionner un client</option>
                                                    @foreach ($customers as $customer)
                                                    <option value="{{ $customer->id }}" {{
                                                        $invoice['payement']['customer']['id']==$customer->id
                                                        ?
                                                        'selected' : '' }}>
                                                        {{ $customer->nom }}-({{ $customer->email }} - {{
                                                        $customer->phone }} - {{ $customer->address }})
                                                    </option>
                                                    @endforeach
                                                    <option value="0"> Ajouter un Nouveau Expediteur</option>
                                                </select>
                                            </div>

                                            <div class="form-row col-md-12 new_customer" style="display: none;">
                                                <div class="form-group col-md-4">
                                                    <input type="text" name="nom" class="form-control form-control-sm"
                                                        placeholder="Nom du Client">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <input type="text" name="prenom"
                                                        class="form-control form-control-sm"
                                                        placeholder="Prenom du Client">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <input type="email" name="email"
                                                        class="form-control form-control-sm"
                                                        placeholder="Email du Client">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <input type="text" name="address"
                                                        class="form-control form-control-sm"
                                                        placeholder="Address du Client">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <input type="tel" id="phone" name="phone"
                                                        class="form-control form-control-sm">
                                                    <span id="valid-msg" class="hide error0 text-sm">✓ Valid</span>
                                                    <span id="error-msg" class="hide error1"></span>
                                                </div>
                                            </div>
                                            <br><br>
                                            <!-- destinataire -->
                                            <div class="card-header">
                                                <h3><i class="fas fa-user-friends" style="color: #2c3e50"></i>
                                                    Information
                                                    sur le Destinataire:
                                                </h3>
                                            </div>
                                            <div class="form-group col-md-12" style="margin-top: 20px">
                                                <label>NOM DU DESTINATAIRE</label>
                                                <select name="receive_id" id="receive_id"
                                                    class="form-control select2 select2-danger "
                                                    data-dropdown-css-class="select2-gray">
                                                    <option value="">Selectionner un Destinataire</option>
                                                    @foreach ($receives as $receive)
                                                    <option value="{{ $receive->id }}" {{
                                                        $invoice['payement']['receive']['id']==$receive->id
                                                        ?
                                                        'selected' : '' }}>
                                                        {{ $receive->nom }}-({{ $receive->email }} - {{
                                                        $receive->phone }} - {{ $receive->address }})
                                                    </option>
                                                    @endforeach
                                                    <option value="0"> Ajouter un Nouveau Destinataire</option>
                                                </select>
                                            </div>




                                            <div class="form-row col-md-12 new_receive" style="display: none;">
                                                <div class="form-group col-md-4">
                                                    <input type="text" name="nomr" class="form-control form-control-sm"
                                                        placeholder="Nom du recepteur">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <input type="text" name="prenomr"
                                                        class="form-control form-control-sm"
                                                        placeholder="prenom du recepteur">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <input type="email" name="emailr"
                                                        class="form-control form-control-sm"
                                                        placeholder="email du recepteur">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <input type="text" name="addressr"
                                                        class="form-control form-control-sm"
                                                        placeholder="Address du recepteur">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <input type="tel" id="phoner" name="phoner"
                                                        class="form-control form-control-sm">
                                                    <span id="valid-msgr" class="hide error0 text-sm">✓ Valid</span>
                                                    <span id="error-msgr" class="hide error1"></span>
                                                </div>

                                            </div>

                                            {{-- country sender and receive --}}
                                            <div class="row mt-5">
                                                {{-- send --}}
                                                <div class="col-md-6">
                                                    <div class="card card-gray">
                                                        <div class="card-header">

                                                            <h3 class="card-title">
                                                                <i class="fas fa-globe-africa text-dark"></i>
                                                                Expedition
                                                            </h3>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="form-group">
                                                                <label>Pays d'Expedition</label>
                                                                <div class="input-group">
                                                                    <select class="form-control select2 select2-danger"
                                                                        data-dropdown-css-class="select2-gray"
                                                                        id="country_id" name="country_id">
                                                                        <option value="">Selectionner un Pays</option>
                                                                        @foreach ($countries as $country)
                                                                        <option value="{{ $country->id }}" {{
                                                                            $invoice['country']['id']==$country->id
                                                                            ?
                                                                            'selected' : '' }}>{{
                                                                            $country->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Ville d'Expedition</label>
                                                                <div class="input-group">
                                                                    <select name="state_id"
                                                                        class="form-control select2 select2-danger"
                                                                        data-dropdown-css-class="select2-gray"
                                                                        id="state_id">
                                                                        <option value="{{  $invoice['state']['id']  }}">
                                                                            {{ $invoice['state']['name'] }}
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- receive --}}
                                                <div class="col-md-6">
                                                    <div class="card card-gray">
                                                        <div class="card-header">
                                                            <h3 class="card-title">

                                                                <i class="fas fa-globe-africa text-dark"></i>
                                                                Destination
                                                            </h3>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="form-group">
                                                                <label>Pays Destination</label>

                                                                <div class="input-group">
                                                                    <select class="form-control select2 select2-danger"
                                                                        data-dropdown-css-class="select2-gray"
                                                                        id="countryr_id" name="countryr_id">
                                                                        <option value="">Selectionner un Pays</option>
                                                                        @foreach ($countries as $country)
                                                                        <option value="{{ $country->id }}" {{
                                                                            $invoice['countryr']['id']==$country->id
                                                                            ?
                                                                            'selected' : '' }}>{{
                                                                            $country->name }}</option>
                                                                        @endforeach
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Ville Destination</label>

                                                                <div class="input-group">
                                                                    <select class="form-control select2 select2-danger"
                                                                        data-dropdown-css-class="select2-gray"
                                                                        id="stater_id" name="stater_id">
                                                                        <option value="{{ $invoice['stater']['id'] }}">
                                                                            {{ $invoice['stater']['name']
                                                                            }}</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- package --}}
                                            <div class="card-header">
                                                <h3><i class="	fas fa-file-alt" style="color: #2c3e50"></i> Information
                                                    sur le Colis
                                                    :


                                                    {{-- <a href="javascript:void(0)"
                                                        class="btn float-right btn-md pt-2" id="addBtn" title="Ajouter"
                                                        style="background: #2962FF;color: #fff"><i class="fa fa-plus">
                                                            Ajouter</i></a> --}}
                                                </h3>
                                            </div><!-- /.card-header -->

                                            <div class="card-body">
                                                <!-- /.card-header -->
                                                <table class="table table-hover table-bordered" id="tableEstimate">
                                                    <thead class="table-secondary">
                                                        <tr>
                                                            <th scope="col" class="text-center">Marque&Model</th>
                                                            <th scope="col" class="text-center">Nº châssis</th>
                                                            <th scope="col" class="text-center">Longueur</th>
                                                            <th scope="col" class="text-center">Largeur</th>
                                                            <th scope="col" class="text-center">Hauteur</th>
                                                            <th scope="col" class="text-center">Prix U.</th>
                                                            <th scope="col" class="text-center">Qty</th>
                                                            <th scope="col" class="text-center">Total</th>
                                                            <th scope="col" class="NoPrint text-right">
                                                                <button type="button" class="btn btn-sm"
                                                                    style="background: #563DEA; color: #fff"
                                                                    onclick="BtnAdd()"><i
                                                                        class="fa fa-plus"></i></button>

                                                            </th>

                                                        </tr>
                                                    </thead>
                                                    <tbody id="TBody">
                                                        @php
                                                        $total_sum = '0';
                                                        @endphp
                                                        @foreach ( $invoicesJoin as $key=> $item )
                                                        <tr id="TRow">
                                                            <input type="hidden" name="invoice_details[]"
                                                                value="{{ $item->id }}">
                                                            <td><input name="model_marque[]" type="text"
                                                                    class="form-control"
                                                                    value="{{ $item->model_marque }}"></td>
                                                            <td><input name="chassis[]" type="text" class="form-control"
                                                                    value="{{ $item->chassis }}"></td>
                                                            <td><input name="longueur[]" style="width: 80px"
                                                                    type="number" class="form-control"
                                                                    value="{{ $item->longueur }}"></td>
                                                            <td><input name="largeur[]" style="width: 80px"
                                                                    type="number" class="form-control"
                                                                    value="{{ $item->largeur }}"></td>
                                                            <td><input name="hauteur[]" style="width: 80px"
                                                                    type="number" class="form-control"
                                                                    value="{{ $item->hauteur }}"></td>
                                                            <td><input type="number" class="form-control text-end"
                                                                    name="unit_price[]" value="{{ $item->unit_price }}"
                                                                    onchange="Calc(this);"></td>
                                                            <td><input type="number" style="width: 50px"
                                                                    class="form-control text-end" name="qty[]"
                                                                    value="{{ $item->qty }}" onchange="Calc(this);">
                                                            </td>
                                                            <td><input type="number" class="form-control text-end"
                                                                    name="item_total[]" value="{{ $item->item_total }}"
                                                                    readonly></td>
                                                            <td class="NoPrint"><button type="button"
                                                                    class="btn btn-sm btn-danger" style=""
                                                                    onclick="BtnDel(this)"><i
                                                                        class="fa fa-trash"></i></button></td>
                                                        </tr>
                                                        @php
                                                        $total_sum += $item->item_total
                                                        @endphp
                                                        @endforeach
                                                    </tbody>
                                                </table>

                                                <div class="row mt-3">
                                                    <div class="col-7">
                                                    </div>
                                                    <div class="col-5">
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text">Total</span>
                                                            <input type="text" class="form-control text-end" id="FTotal"
                                                                name="FTotal" disabled="" value="{{ $total_sum }}">
                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text">TAX</span>
                                                            <input type="text" class="form-control text-end" value="20%"
                                                                id="" name="" disabled>
                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text">Remise</span>
                                                            <input type="text" class="form-control text-end" id="FGST"
                                                                value="{{ $invoice['payement']['discount_amount'] }}"
                                                                name="discount_amount" onchange="GetTotal()">
                                                        </div>
                                                        {{-- <div class="input-group mb-3">
                                                            <span class="input-group-text">GST</span>
                                                            <input type="number" class="form-control text-end" id="FGST"
                                                                name="FGST" onchange="GetTotal()">
                                                        </div> --}}
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text">Grand Total </span>
                                                            <input type="text" class="form-control text-end" id="FNet"
                                                                name="total_amount"
                                                                value="{{ $invoice['payement']['total_amount'] }}"
                                                                readonly>
                                                        </div>


                                                    </div>
                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                            <div class="card-body row">
                                                <div class="form-group col-md-4">
                                                    <label for="" style="font-weight:bold ">Montant versé <i
                                                            class="fas fa-money-bill text-danger"></i></label>
                                                    <input type="text" name="paid_amount" class="form-control "
                                                        value="{{ $invoice['payement']['paid_amount'] }}">
                                                    {{-- <select name="paid_status"
                                                        class="form-control select2 select2-danger form-control-sm"
                                                        data-dropdown-css-class="select2-danger" id="paid_status">
                                                        <option value="">Selectionner le status de Paiement</option>
                                                        <option value="full_paid">entièrement paye</option>
                                                        <option value="full_due">Non payer</option>
                                                        <option value="partial_paid"> Partiellement Paye</option>
                                                    </select> --}}
                                                    {{-- <input type="text" name="paid_amount"
                                                        class="form-control form-control-sm paid_amount"
                                                        placeholder="Enter Paid Amount"
                                                        style="display:none; margin-top:5px;"> --}}
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="" style="font-weight:bold ">Status Livraison <i
                                                            class="fas fa-dolly-flatbed text-danger"></i></label>
                                                    <select name="status_livraison" class="form-control  "
                                                        data-dropdown-css-class="select2-danger" id="status_livraison">

                                                        {{-- <option value="{{ $invoice->status_livraison }}" selected>
                                                            {{
                                                            $invoice->status_livraison }}</option> --}}
                                                        <option value="livre" {{ $invoice->status_livraison ==='livre'
                                                            ?
                                                            'selected' : '' }}>
                                                            livre
                                                        </option>
                                                        <option {{ $invoice->status_livraison ==="en embarcation" ?
                                                            'selected' : '' }}
                                                            value="en embarcation">
                                                            en embarcation
                                                        </option>
                                                        <option {{ $invoice->status_livraison ==="en cours
                                                            d'expedition" ? 'selected' : '' }}
                                                            value="en cours d'expedition">
                                                            en cours d'expedition
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="package_id" style="font-weight:bold ">Type Conteneur
                                                        <i class="fas fa-truck text-danger"></i></label>
                                                    <select name="unit_id" class="form-control"
                                                        data-dropdown-css-class="select2-danger" id="package_id">
                                                        <option value="">Selectionner un Conteneur</option>
                                                        @foreach ($units as $unit )
                                                        <option value="{{ $unit->id }}" {{
                                                            $invoice['unit']['id']===$unit->id
                                                            ?
                                                            'selected' : '' }}>{{ $unit->name }}-({{
                                                            $unit->numero_id
                                                            }})
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="">
                                                    <label for="descrip" class="form-label" style="font-weight:bold ">
                                                        Description</label>
                                                    <textarea name="description" id="descrip" class="form-control"
                                                        rows="3" placeholder="entrer une description">
                                                           {{ $invoice->description }}
                                                        </textarea>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-row">
                                            <div class="form-group col-md-4">
                                                <button type="submit" class="btn btn-dark w-100 ">
                                                    Enregistrer les
                                                    Informations </button>
                                                {{-- <button type="button" class="btn btn-success swalDefaultSuccess">
                                                    Launch Success Toast
                                                </button> --}}
                                            </div>

                                            <div class="col-5"></div>
                                            <div class="col-3"></div>
                                        </div>
                                    </section>
                                    {{--
                                </div> --}}

                            </div>
                        </section>
                    </form>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
@section('scripts')

<!-- ADD IN INVOICE -->
<script>
    function BtnAdd() {
        // var v = $('#TRow').clone().appendTo('#TBody');
        // $(v).find('input').val('');
        // $(v).removeClass('d-none')

        $("#tableEstimate tbody").append(`<tr>
            <td><input name="model_marque[]" type="text"
                                                                    class="form-control"></td>
                                                            <td><input name="chassis[]" type="text"
                                                                    class="form-control"></td>
                                                            <td><input name="longueur[]" style="width: 80px"
                                                                    type="number" class="form-control"></td>
                                                            <td><input name="largeur[]" style="width: 80px"
                                                                    type="number" class="form-control"></td>
                                                            <td><input name="hauteur[]" style="width: 80px"
                                                                    type="number" class="form-control"></td>
                                                            <td><input type="number" class="form-control text-end"
                                                                    name="unit_price[]" onchange="Calc(this);"></td>
                                                            <td><input type="number" style="width: 50px"
                                                                    class="form-control text-end" name="qty[]"
                                                                    onchange="Calc(this);"></td>
                                                            <td><input type="number" class="form-control text-end"
                                                                    name="item_total[]" value="0" readonly></td>
                                                            <td class="NoPrint"><button type="button"
                                                                    class="btn btn-sm btn-danger" style=""
                                                                    onclick="BtnDel(this)"><i
                                                                        class="fa fa-trash"></i></button></td>
                     </tr>`);
        // });
    }

    function BtnDel(v) {
        $(v).parent().parent().remove();
        GetTotal();
    }

    function Calc(v) {
        var index = $(v).parent().parent().index();
        var qty = document.getElementsByName('qty[]')[index].value;
        var unit_price = document.getElementsByName('unit_price[]')[index].value;
    //    alert(qty);
        var total = qty*unit_price
        document.getElementsByName('item_total[]')[index].value=total;
        // alert(index);
        GetTotal();
    }

    //   function GetTotal() {
    //     var sum = 0;
    //     var amts = document.getElementsByName('amt');

    //     for (let index = 0; index < amts.length; index++) {
    //         var amt = amts[index].value;
    //         sum = +(sum) +  +(amt);
    //     }
    //     document.getElementById('FTotal').value = sum;

    //     var gst = document.getElementById('FGST').value;
        


    //     var net = +(sum) + +(gst);
    //     document.getElementById('FNet').value = net;
    //   }

    function GetTotal() {
        var sum = 0;
        var  unit_prices = document.getElementsByName('item_total[]');

        for (let index = 0; index < unit_prices.length; index++) {
            var amt = unit_prices[index].value;
            sum = +(sum) +  +(amt);
        }
        document.getElementById('FTotal').value = sum;
        var sum1 = sum;
        var TAX = sum1*0.2;

        var discount = document.getElementById('FGST').value;
        


        var net = +(sum) + +(TAX) - (discount);
        document.getElementById('FNet').value = net;
    }
</script>

<!-- Sweet Alert -->
<script>
    $(document).ready(function() {
        var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
        $('.swalDefaultSuccess').click(function() {
      Toast.fire({
        icon: 'success',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    })
</script>
<!-- Number script -->
<script src="{{ asset('build/js/intlTelInput.min.js') }}"></script>
<script src="{{ asset('build/js/intlTelInput.js') }}"></script>
<script>
    var input = document.querySelector("#phone"),
    errorMsg = document.querySelector("#error-msg"),
    validMsg = document.querySelector("#valid-msg");

    // here, the index maps to the error code returned from getValidationError - see readme
    var errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];

    // initialise plugin
    var iti = window.intlTelInput(input, {
    utilsScript: "{{ asset('build/js/utils.js') }}", 
    initialCountry:"tr",
    nationalMode: false
    });

    var reset = function() {
    input.classList.remove("error");
    errorMsg.innerHTML = "";
    errorMsg.classList.add("hide");
    validMsg.classList.add("hide");
    };

    // on blur: validate 
    input.addEventListener('blur', function() {
    reset();
    if (input.value.trim()) {
    if (iti.isValidNumber()) {
    validMsg.classList.remove("hide");
    } else {
    input.classList.add("error");
    var errorCode = iti.getValidationError();
    errorMsg.innerHTML = errorMap[errorCode];
    errorMsg.classList.remove("hide");
    }
    }
    });

    // on keyup / change flag: reset
    input.addEventListener('change', reset);
    input.addEventListener('keyup', reset);
</script>


{{-- number recieve --}}
<script>
    var inputr = document.querySelector("#phoner"),
    errorMsgr = document.querySelector("#error-msgr"),
    validMsgr = document.querySelector("#valid-msgr");

    // here, the index maps to the error code returned from getValidationError - see readme
    var errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];

    // initialise plugin
    var itir = window.intlTelInput(inputr, {
    utilsScript: "{{ asset('buildr/js/utils.js') }}", 
    initialCountry:"tr",
    nationalMode: false
    });

    var reset = function() {
    input.classList.remove("error");
    errorMsg.innerHTML = "";
    errorMsg.classList.add("hide");
    validMsg.classList.add("hide");
    };

    // on blur: validate
    input.addEventListener('blur', function() {
    reset();
    if (inputr.value.trim()) {
    if (itir.isValidNumber()) {
    validMsgr.classList.remove("hide");
    } else {
    inputr.classList.add("error");
    var errorCoder = itir.getValidationError();
    errorMsgr.innerHTML = errorMap[errorCoder];
    errorMsgr.classList.remove("hide");
    }
    }
    });

    // on keyup / change flag: reset
    inputr.addEventListener('change', reset);
    inputr.addEventListener('keyup', reset);
</script>>


<script type="text/javascript">
    $(document).ready(function(){
                $('#addBtn').on("click",function(){
                
                //   var model = $('#model_marque').val();
                //   if (model == '') {
                //     $.notify("model is required",{globalPosition: 'top right',className: 'error'});
                //     return false;
                //   }
                    
                    $("#tableEstimate tbody").append(`<tr>
                    
                                <td>
                                <input type="text" class="form-control"
                                        style="min-width: 130px;" id="item" name="model_marque[]">
                                </td>
                                <td>
                                    <input type="text" class="form-control"
                                        style="min-width: 160px;" id="chassis" name="chassis[]">
                                </td>
                                <td>
                                    <input type="text" class="form-control "
                                        style="width: 50px;" id="length" name="longueur[]">
                                </td>
                                <td>
                                    <input type="number" class="form-control "
                                        style="width: 50px;" id="width" name="largeur[]">
                                </td>
                                <td>
                                    <input type="number" class="form-control "
                                        style="width: 50px;" id="height" name="hauteur[]"
                                        value="">
                                </td>
                                <td>
                                    <input type="number" class="form-control unit_price"
                                        style="width: 100px;" id="unit_price"
                                        name="unit_price[]">
                                </td>
                                <td>
                                    <input type="number" class="form-control total qty"
                                        style="width: 50px;" id="qty" name="qty[]">
                                </td>
                                <td>
                                    <input type="text" class="form-control item_total" readonly
                                        style="width: 100px;" id="item_total"
                                        name="item_total[]" value="0">
                                </td>
                                <td><a href="javascript:void(0)" class="btn btn-danger btn-sm remove" title="Remove"><i class="fas fa-trash"></i></a></td>
                            </tr>`);
                });
                    // remoe the row colum
                $("#tableEstimate tbody").on("click ", ".remove", function(){
                    $(this).closest("tr").remove();
                    calc_total();
                });

                $("#tableEstimate tbody").on("input", ".unit_price", function () {
                    var unit_price = parseFloat($(this).val());
                    var qty = parseFloat($(this).closest("tr").find(".qty").val());
                    var total = $(this).closest("tr").find(".item_total");
                    // total.val(unit_price * qty);

                    calc_total();
                });

                $("#tableEstimate tbody").on("input", ".qty", function () {
                    var qty = parseFloat($(this).val());
                    var unit_price = parseFloat($(this).closest("tr").find(".unit_price").val());
                    var total = $(this).closest("tr").find(".item_total");
                    total.val(unit_price * qty);
                    calc_total();
                });
                function calc_total() {
                    var sum = 0;

                    $(".item_total").each(function () {
                    sum += parseFloat($(this).val());
                    });
                    // $("#subtotal").text(sum);
                    
                    var tax     = 100;
                    $(document).on("change keyup blur", "#qty", function() 
                    {
                        var amounts = sum;
                        var qty = $("#qty").val();
                        var discount = $(".discount").val();
                        $("#sub_total").val(amounts);
                        $("#tax_1").val((amounts * qty)/tax);
                        $("#grand_total").val((parseInt(amounts)) - (parseInt(discount)));
                        
                        // $(".item_total").val(amounts*qty);
                        // $("#sub_total").val(amounts * qty);
                        // $("#tax_1").val((amounts * qty)/tax);
                        // $("#grand_total").val((parseInt(amounts)) - (parseInt(discount)));
                    }); 
                }
            })              
</script>
<script type="text/javascript">
    //paid status
    $(document).on("change","#paid_status",function(){
      var paid_status = $(this).val();
      if (paid_status=='partial_paid') {
        $('.paid_amount').show();
      } else {
        $('.paid_amount').hide();
      }
  })
</script>
<script>
    //New customer
  $(document).on("change","#customer_id",function(){
      var customer_id = $(this).val();
      if (customer_id=='0') {
        $('.new_customer').show();
      } else {
        $('.new_customer').hide();
      }
  })

  $(document).on("change","#receive_id",function(){
      var receive_id = $(this).val();
      if (receive_id=='0') {
        $('.new_receive').show();
      } else {
        $('.new_receive').hide();
      }
  })


</script>
<script>
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()
    })
    //Initialize Select2 Elements
   
</script>

<script type="text/javascript">
    $(function(){
    $(document).on('change','#country_id', function() {
        var country_id = $(this).val();
        $.ajax({
            url:"{{ route('get-states') }}",
            type:"GET",
            data:{country_id:country_id},
            success:function(data){
                var html = '<option value="">Selectionner une ville</option>';
                $.each(data,function(key,v) {
                    html +='<option value="'+v.id+'">'+v.name+'</option>';
                });
                $('#state_id').html(html);
            }
        });
    });
  });
</script>
<script type="text/javascript">
    $(function(){
    $(document).on('change','#countryr_id', function() {
        var countryr_id = $(this).val();
        $.ajax({
            url:"{{ route('get-states-receive') }}",
            type:"GET",
            data:{countryr_id:countryr_id},
            success:function(data){
                var html = '<option value="">Selectionner une ville</option>';
                $.each(data,function(key,v) {
                    html +='<option value="'+v.id+'">'+v.name+'</option>';
                });
                $('#stater_id').html(html);
            }
        });
    });
  });
</script>
<!-- Page specific script -->
<script type="text/javascript">
    $(document).ready(function(){
    $('#myForm').validate({
        rules:{
            paid_status: {
                required:true,
            },
            status_livraison: {
                required:true,
            },
            unit_id: {
                required:true,
            },
            customer_id: {
                required:true,
            },
            receive_id: {
                required:true,
            },
            country_id: {
                required:true,
            },
            state_id: {
                required:true,
            },
            countryr_id: {
                required:true,
            },
            stater_id: {
                required:true,
            },
        },
            messages: {

            },
            errorElement: 'span',
            errorPlacement:function(error,element){
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight:function(element,errorClass,validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element,errorClass,validClass){
                $(element).removeClass('is-invalid');
            }
    })
 })
</script>


@endsection