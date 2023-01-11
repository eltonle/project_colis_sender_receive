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
                    <h3 class="m-0 font-weight-bold" style="color:#6F1E51"> Manage Clients (<strong
                            class="text-md text-decoration-underline"> {{
                            $dates
                            }}</strong>)</h3>
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
        <form action="{{ route('clients.store') }}" method="POST" id="myForm" enctype="multipart/form-data">
            @csrf
            <div class="container-fluid">
                <div class="row">
                    {{-- left col --}}
                    <section class="col-md-12">
                        {{-- custom tabs --}}
                        <div class="card">
                            <div class="card-header">
                                <h3><i class="fas fa-user-friends" style="color: #ff793f"></i> Clients Sender Create
                                    <a href="#" class="btn btn-success float-right btn-sm">
                                        <i class="fa fa-list"></i> Clients sender Lists
                                    </a>
                                </h3>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="name">Client Name</label>
                                            <input type="text" id="name" name="name" class="form-control">
                                            <input type="hidden" id="name" name="date" value="{{ $dates }}"
                                                class="form-control">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="firstname">Client Firstname</label>
                                            <input type="text" id="firstname" name="firstname" class="form-control">
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label for="email">Client email</label>
                                            <input type="email" id="email" name="email" class="form-control">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="address">Client address</label>
                                            <input type="text" id="address" name="address" class="form-control">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="phone">Client phone_No</label> <br>
                                            <input type="tel" id="phone" name="phone" class="form-control">
                                            <span id="valid-msg" class="hide error0">✓ Valid</span>
                                            <span id="error-msg" class="hide error1"></span>
                                        </div>

                                        {{-- ic --}}
                                        <div class="form-group col-md-4">
                                            <label>Country </label>
                                            <select class="form-control select2 select2-danger" id="country_dd"
                                                data-dropdown-css-class="select2-danger" style="width: 100%;"
                                                name="country_id" required>
                                                <option selected="selected">Select Country</option>
                                                @foreach ($countries as $country )
                                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label>State </label>
                                            <select class="form-control select2 select2-danger" name="state_id"
                                                id="state_dd" data-dropdown-css-class="select2-danger"
                                                style="width: 100%;">

                                            </select>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label>City</label>
                                            <select class="form-control select2 select2-danger" name="city_id"
                                                id="city_dd" data-dropdown-css-class="select2-danger"
                                                style="width: 100%;">

                                            </select>
                                        </div>

                                        {{-- <div class="form-group col-md-6">
                                            <input type="submit" value="Enregistrer les informations"
                                                class="btn btn-primary">
                                        </div> --}}
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                    </section>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->

            <div class="container-fluid">
                <div class="row">
                    {{-- left col --}}
                    <section class="col-md-12">
                        {{-- custom tabs --}}
                        <div class="card">
                            <div class="card-header">
                                <h3><i class="	fas fa-user-friends" style="color: #ff793f"></i> Clients Recieve Create
                                    <a href="#" class="btn btn-success float-right btn-sm">
                                        <i class="fa fa-list"></i> Clients recieve Lists
                                    </a>
                                </h3>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="namer">Client Recieve Name</label>
                                            <input type="text" id="namer" name="namer" class="form-control">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="firstnamer">Client Recieve Firstname</label>
                                            <input type="text" id="firstnamer" name="firstnamer" class="form-control">
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label for="emailr">Client Recieve email</label>
                                            <input type="email" id="emailr" name="emailr" class="form-control">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="addressr">Client Recieve address</label>
                                            <input type="text" id="addressr" name="addressr" class="form-control">
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="phoner">Client phone_No</label> <br>
                                            <input type="tel" id="phoner" name="phoner" class="form-control">
                                            <span id="valid-msgr" class="hide error0">✓ Valid</span>
                                            <span id="error-msgr" class="hide error1"></span>
                                        </div>

                                        {{-- ic recieve --}}
                                        <div class="form-group col-md-4">
                                            <label>Client Recieve Country </label>
                                            <select class="form-control select2 select2-danger" id="country_rr"
                                                name="countryr_id" data-dropdown-css-class="select2-danger"
                                                style="width: 100%;" name="countryr_id" required>
                                                <option selected="selected">Select Recieve Country</option>
                                                @foreach ($countries as $country )
                                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label>Client Recieve State </label>
                                            <select class="form-control select2 select2-danger" name="stater_id"
                                                id="state_rr" data-dropdown-css-class="select2-danger"
                                                style="width: 100%;" required>

                                            </select>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label>Client Recieve City</label>
                                            <select class="form-control select2 select2-danger" name="cityr_id"
                                                id="city_rr" data-dropdown-css-class="select2-danger"
                                                style="width: 100%;" required>

                                            </select>
                                        </div>
                                        {{-- <div class="form-group col-md-6">
                                            <input type="submit" value="Enregistrer les informations"
                                                class="btn btn-primary">
                                        </div> --}}
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                    </section>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->

            -->

            <div class="container-fluid">
                <div class="row">
                    {{-- left col --}}
                    <section class="col-md-12">
                        {{-- custom tabs --}}
                        <div class="card">
                            <div class="card-header">
                                <h3><i class="	fas fa-file-alt" style="color: #ff793f"></i> Package Info :

                                    {{-- <a href="#" class="btn btn-success float-right btn-sm">
                                        <i class="fa fa-list"></i> Clients recieve Lists
                                    </a> --}}
                                    <a href="javascript:void(0)" class="btn btn-success float-right btn-md pt-2"
                                        id="addBtn" title="Add"><i class="fa fa-plus">
                                            add</i></a>
                                </h3>
                            </div><!-- /.card-header -->

                            <div class="card-body">
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="">
                                            <table class="table table-hover table-white" id="tableEstimate">
                                                <thead>
                                                    <tr>
                                                        <th class="col-sm-2">Marque & Model</th>
                                                        <th class="col-sm-1">Nº de châssis</th>
                                                        <th style="width:80px;">Longueur</th>
                                                        <th style="width:80px;">Largeur</th>
                                                        <th style="width:80px;">Hauteur</th>
                                                        <th style="width:100px;">Prix Unitaire</th>
                                                        <th style="width:80px;">Qty</th>
                                                        <th>Amount</th>
                                                        {{-- <th></th> --}}
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <input type="text" class="form-control"
                                                                style="min-width: 130px;" id="item"
                                                                name="model_marque[]">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control"
                                                                style="min-width: 100px;" id="chassis" name="chassis[]">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control "
                                                                style="width: 70px;" id="length" name="length[]">
                                                        </td>
                                                        <td>
                                                            <input type="number" class="form-control "
                                                                style="width: 70px;" id="width" name="width[]">
                                                        </td>
                                                        <td>
                                                            <input type="number" class="form-control "
                                                                style="width: 80px;" id="height" name="height[]"
                                                                value="">
                                                        </td>
                                                        <td>
                                                            <input type="number" class="form-control unit_price"
                                                                style="width: 120px;" id="unit_price"
                                                                name="unit_price[]">
                                                        </td>
                                                        <td>
                                                            <input type="number" class="form-control total qty"
                                                                style="width: 100px;" id="qty" name="qty[]">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control item_total" readonly
                                                                style="width: 100px;" id="item_total"
                                                                name="item_total[]" value="0">
                                                        </td>
                                                        {{-- <td>
                                                            <a href="javascript:void(0)"
                                                                class="text-white font-18 font-bold bg-danger p-2 rounded mt-2"
                                                                id="addBtn" title="Add"><i class="fa fa-plus">
                                                                    add</i></a>
                                                        </td> --}}
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-hover table-white" id="tableSommation">
                                                <tbody>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td class="text-right">Sub_total</td>
                                                        <td
                                                            style="text-align: right; padding-right: 30px; width:210px;">
                                                            <input type="text" class="form-control text-right"
                                                                id="sub_total" name="sub_total" value="0">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5" class="text-right">Tax</td>
                                                        <td
                                                            style="text-align: right; padding-right: 30px; width:210px;">
                                                            <input type="text"
                                                                class="form-control text-right bg-gradient-gray"
                                                                id="tax_1" name="tax_1" value="0" readonly>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5" class="text-right">
                                                            Discount %
                                                        </td>
                                                        <td
                                                            style="text-align: right; padding-right: 30px; width:210px;">
                                                            <input type="text" class="form-control text-right discount"
                                                                id="discount" name="discount" value="10"
                                                                style="background-color: #55efc4">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5" style="text-align: right; ">
                                                            Grand Total
                                                        </td>
                                                        <td
                                                            style="text-align: right; padding-right: 30px; width:210px;">
                                                            <input class="form-control text-right bg-danger" type="text"
                                                                id="grand_total" name="grand_total" value="$ 0.00"
                                                                readonly>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <div class="card-body row">
                                <div class="form-group col-md-4">
                                    <label for="" style="font-weight:bold ">Status paid <i
                                            class="fas fa-donate text-danger"></i></label>
                                    <select name="paid_status"
                                        class="form-control select2 select2-danger form-control-sm"
                                        data-dropdown-css-class="select2-danger" id="paid_status">
                                        <option value="">Select_Payement_Status</option>
                                        <option value="full_paid">Full Paid</option>
                                        <option value="full_due">Full Due</option>
                                        <option value="partial_paid">Partil Paid</option>
                                    </select>
                                    <input type="text" name="paid_amount"
                                        class="form-control form-control-sm paid_amount" placeholder="Enter Paid Amount"
                                        style="display:none; margin-top:5px;">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="" style="font-weight:bold ">Status livraison</label>
                                    <select name="status_livraison"
                                        class="form-control select2 select2-danger form-control-sm"
                                        data-dropdown-css-class="select2-danger" id="status_livraison">
                                        <option value="">Select_Status_livraison</option>
                                        <option value="en embarcation">En embarcation</option>
                                        <option value="en_cours d'expedition">En cours d'expedition</option>
                                        <option value="livre">Livree</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="package_id" style="font-weight:bold ">Package type</label>
                                    <select name="unit_id" class="form-control select2 select2-danger form-control-sm"
                                        data-dropdown-css-class="select2-danger" id="package_id">
                                        <option value="">Select_Status_livraison</option>
                                        @foreach ($units as $unit )
                                        <option value="{{ $unit->id }}">{{ $unit->name }}-({{ $unit->numero_id }})
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>

                <!-- /.row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" rows="3" id="other_information" name="description"
                                placeholder="Write description here..."></textarea>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->

            <div class="container-fluid">
                <div class="form-row">

                    <div class="col-md-12 form-group">
                        <input type="submit" value="Enregistrer les informations" class="btn btn-info">
                    </div>

                </div>
            </div>
        </form>
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection

@section('scripts')

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
</script>
<!-- Page specific script -->
<script type="text/javascript">
    $(document).ready(function(){
    $('#myForm').validate({
        rules:{
            name: {
                required:true,
                rangelength :[3,30]
            },
            firstname: {
                required:true,
                rangelength :[3,35]
            },
            email: {
                required:true,
                email: true,
            },
            address: {
                required:true,
                rangelength :[3,25]
            },
            phone: {
                required:true,
            },
            namer: {
                required:true,
                rangelength :[3,30]
            },
            firstnamer: {
                required:true,
                rangelength :[3,35]
            },
            emailr: {
                required:true,
                email: true,
            },
            addressr: {
                required:true,
                rangelength :[3,25]
            },
            phoner: {
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

<script>
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()
    })
    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
</script>
<script type="text/javascript">
    $(document).ready(function(){
    $('#country_dd').change(function(event){
       var idCountry = this.value;
       $('#state_id').html();

       $.ajax({
        url: "{{ route('states.index') }}",
        type:'POST',
        dataType:'json',
        data: {country_id:idCountry,_token:"{{ csrf_token() }}"},
        success:function(response){
            $('state_dd').html('<option value=""> Select State </option>');
            $.each(response.states,function(index,val){
                $('#state_dd').append('<option value="'+val.id+'"> '+val.name+' </option>')
            });

            $('#city_dd').html('<option value="">Select City</option>');
        }
       })
    })

    $('#state_dd').change(function(event){
       var idState = this.value;
       $('#city_dd').html();

       $.ajax({
        url: "{{ route('cities.index') }}",
        type:'POST',
        dataType:'json',
        data: {state_id:idState,_token:"{{ csrf_token() }}"},
        success:function(response){
            $('city_dd').html('<option value=""> Select City </option>');
            $.each(response.cities,function(index,val){
                $('#city_dd').append('<option value="'+val.id+'"> '+val.name+' </option>')
            });
        }
       })
       
    })
 })
</script>
<script type="text/javascript">
    $(document).ready(function(){
    $('#country_rr').change(function(event){
       var idCountry_r = this.value;
       $('#state_r_id').html();

       $.ajax({
        url: "{{ route('states.index_r') }}",
        type:'POST',
        dataType:'json',
        data: {country_id_r:idCountry_r,_token:"{{ csrf_token() }}"},
        success:function(response){
            $('state_rr').html('<option value=""> Select State </option>');
            $.each(response.states,function(index,val){
                $('#state_rr').append('<option value="'+val.id+'"> '+val.name+' </option>')
            });

            $('#city_rr').html('<option value="">Select City</option>');
        }
       })
    })

    $('#state_rr').change(function(event){
       var idState_r = this.value;
       $('#city_rr').html();

       $.ajax({
        url: "{{ route('cities.index_r') }}",
        type:'POST',
        dataType:'json',
        data: {state_id_r:idState_r,_token:"{{ csrf_token() }}"},
        success:function(response){
            $('city_rr').html('<option value=""> Select City </option>');
            $.each(response.cities,function(index,val){
                $('#city_rr').append('<option value="'+val.id+'"> '+val.name+' </option>')
            });
        }
       })
       
    })
 })
</script>

<script>
    $(document).ready(function(){
            $('#addBtn').on("click",function(){
                //Add the row inside the body
                
                $("#tableEstimate tbody").append(`<tr>
                   
                            <td>
                             <input type="text" class="form-control"
                                    style="min-width: 130px;" id="item" name="model_marque[]">
                            </td>
                            <td>
                                <input type="text" class="form-control"
                                    style="min-width: 100px;" id="chassis" name="chassis[]">
                            </td>
                            <td>
                                <input type="text" class="form-control "
                                    style="width: 70px;" id="length" name="length[]">
                            </td>
                            <td>
                                <input type="number" class="form-control "
                                    style="width: 70px;" id="width" name="width[]">
                            </td>
                            <td>
                                <input type="number" class="form-control "
                                    style="width: 80px;" id="height" name="height[]"
                                    value="0">
                            </td>
                            <td>
                                <input type="number" class="form-control unit_price"
                                    style="width: 120px;" id="unit_price"
                                    name="unit_price[]">
                            </td>
                            <td>
                                <input type="number" class="form-control total qty"
                                    style="width: 100px;" id="qty" name="qty[]">
                            </td>
                            <td>
                                <input type="text" class="form-control item_total" readonly
                                    style="width: 100px;" id="item_total"
                                    name="item_total[]" value="0">
                            </td>
                            <td><a href="javascript:void(0)" class="btn btn-danger remove" title="Remove"><i class="fas fa-trash"></i></a></td>
                        </tr>`);
            });
                // remoe the row colum
            $("#tableEstimate tbody").on("click change blur ", ".remove", function(){
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
    $(document).on("change","#paid_status",function(){
      var paid_status = $(this).val();
      if (paid_status=='partial_paid') {
        $('.paid_amount').show();
      } else {
        $('.paid_amount').hide();
      }
  })
</script>
@endsection