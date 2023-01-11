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
                    <h3 class="m-0 font-weight-bold">Manage Facture</h3>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Facture</li>
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
                    <form action="{{ route('invoices.store') }}" method="post" enctype="multipart/form-data"
                        id="myForm">
                        @csrf
                        {{-- left col --}}
                        <section class="col-md-12">
                            {{-- custom tabs --}}
                            <div class="card">
                                <div class="card-header">
                                    <h3> Ajouter une expedition
                                        <a href="{{ route('invoices.index') }}"
                                            class="btn btn-success float-right btn-sm">
                                            <i class="fa fa-plus-circle"></i> Listes Facture
                                        </a>
                                    </h3>
                                </div><!-- /.card-header -->
                                <div class="card-body">
                                    <!-- /.card-header -->
                                    <div class="form-row">
                                        <div class="form-group col-md-2">
                                            <label> FACTURE No:</label>
                                            <input type="text" name="invoice_no" value="{{ $invoice_no }}"
                                                id="invoice_no" class="form-control form-control-sm font-bold" readonly
                                                style="background-color:#2c3e50; color: white">
                                        </div>
                                        <div class="form-group col-md-6">
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label>Date</label>
                                            <input type="date" name="date" id="date" value="{{ $date }}"
                                                class="form-control datepicker form-control-sm" placeholder="YYY-MM-DD">
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
                                                    sur l'expedition:
                                                </h3>
                                            </div>
                                            <!-- expediteur -->
                                            <div class="form-group col-md-12" style="margin-top: 20px">
                                                <label>NOM DE L'EXPEDITEUR</label>
                                                <select name="customer_id" id="customer_id"
                                                    class="form-control select2 select2-danger form-control-sm"
                                                    data-dropdown-css-class="select2-danger">
                                                    <option value="">Selectionner un client</option>
                                                    @foreach ($customers as $customer)
                                                    <option value="{{ $customer->id }}">
                                                        {{ $customer->nom }}-({{ $customer->email }} - {{
                                                        $customer->phone }} - {{ $customer->address }})
                                                    </option>
                                                    @endforeach
                                                    <option value="0"> Ajouter un nouveau client</option>
                                                </select>
                                            </div>

                                            <div class="form-row col-md-12 new_customer" style="display: none;">
                                                <div class="form-group col-md-4">
                                                    <input type="text" name="nom" class="form-control form-control-sm"
                                                        placeholder="Nom du client">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <input type="text" name="prenom"
                                                        class="form-control form-control-sm"
                                                        placeholder="prenom du client">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <input type="email" name="email"
                                                        class="form-control form-control-sm"
                                                        placeholder="email du client">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <input type="text" name="address"
                                                        class="form-control form-control-sm"
                                                        placeholder="Address du client">
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
                                                    sur la destinarion:
                                                </h3>
                                            </div>
                                            <div class="form-group col-md-12" style="margin-top: 20px">
                                                <label>NOM DU DESTINATAIRE</label>
                                                <select name="receive_id" id="receive_id"
                                                    class="form-control select2 select2-danger form-control-sm"
                                                    data-dropdown-css-class="select2-danger">
                                                    <option value="">Selectionner un client</option>
                                                    @foreach ($receives as $receive)
                                                    <option value="{{ $receive->id }}">
                                                        {{ $receive->nomr }}-({{ $receive->emailr }} - {{
                                                        $receive->phoner }} - {{ $receive->addressr }})
                                                    </option>
                                                    @endforeach
                                                    <option value="0"> Ajouter un nouveau recepteur</option>
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


                                            {{-- package --}}
                                            <div class="card-header">
                                                <h3><i class="	fas fa-file-alt" style="color: #2c3e50"></i> Information
                                                    sur le package
                                                    :


                                                    <a href="javascript:void(0)"
                                                        class="btn btn-success float-right btn-md pt-2" id="addBtn"
                                                        title="Add"><i class="fa fa-plus">
                                                            add</i></a>
                                                </h3>
                                            </div><!-- /.card-header -->

                                            <div class="card-body">
                                                <!-- /.card-header -->
                                                <div class="card-body">
                                                    <div class="col-md-12 col-sm-12">
                                                        <div class="">
                                                            <table class="table table-hover table-white"
                                                                id="tableEstimate">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="col-sm-2">Marque & Model</th>
                                                                        <th class="col-sm-1">Nº de châssis</th>
                                                                        <th style="width:80px;">Longueur</th>
                                                                        <th style="width:80px;">Largeur</th>
                                                                        <th style="width:80px;">Hauteur</th>
                                                                        <th style="width:100px;">Prix Unitaire</th>
                                                                        <th style="width:80px;">Qty</th>
                                                                        <th>Total</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>
                                                                            <input type="text" class="form-control"
                                                                                style="min-width: 130px;"
                                                                                id="model_marque" name="model_marque[]">
                                                                        </td>
                                                                        <td>
                                                                            <input type="text" class="form-control"
                                                                                style="min-width: 100px;" id="chassis"
                                                                                name="chassis[]">
                                                                        </td>
                                                                        <td>
                                                                            <input type="text" class="form-control "
                                                                                style="width: 70px;" id="length"
                                                                                name="longueur[]">
                                                                        </td>
                                                                        <td>
                                                                            <input type="number" class="form-control "
                                                                                style="width: 70px;" id="width"
                                                                                name="largeur[]">
                                                                        </td>
                                                                        <td>
                                                                            <input type="number" class="form-control "
                                                                                style="width: 80px;" id="height"
                                                                                name="hauteur[]" value="">
                                                                        </td>
                                                                        <td>
                                                                            <input type="number"
                                                                                class="form-control unit_price"
                                                                                style="width: 120px;" id="unit_price"
                                                                                name="unit_price[]">
                                                                        </td>
                                                                        <td>
                                                                            <input type="number"
                                                                                class="form-control total qty"
                                                                                style="width: 100px;" id="qty"
                                                                                name="qty[]">
                                                                        </td>
                                                                        <td>
                                                                            <input type="text"
                                                                                class="form-control item_total" readonly
                                                                                style="width: 100px;" id="item_total"
                                                                                name="item_total[]" value="0">
                                                                        </td>

                                                                    </tr>

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="table-responsive">
                                                            <table class="table table-hover table-white"
                                                                id="tableSommation">
                                                                <tbody>
                                                                    <tr>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td class="text-right">Sub_total</td>
                                                                        <td
                                                                            style="text-align: right; padding-right: 30px; width:210px;">
                                                                            <input type="text"
                                                                                class="form-control text-right"
                                                                                id="sub_total" name="sub_total"
                                                                                value="0">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="5" class="text-right">Tax</td>
                                                                        <td
                                                                            style="text-align: right; padding-right: 30px; width:210px;">
                                                                            <input type="text"
                                                                                class="form-control text-right bg-gradient-gray"
                                                                                id="tax_1" name="tax_1" value="0"
                                                                                readonly>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="5" class="text-right">
                                                                            Discount %
                                                                        </td>
                                                                        <td
                                                                            style="text-align: right; padding-right: 30px; width:210px;">
                                                                            <input type="text"
                                                                                class="form-control text-right discount"
                                                                                id="discount" name="discount_amount"
                                                                                value="10"
                                                                                style="background-color: #55efc4">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="5" style="text-align: right; ">
                                                                            Grand Total
                                                                        </td>
                                                                        <td
                                                                            style="text-align: right; padding-right: 30px; width:210px;">
                                                                            <input
                                                                                class="form-control text-right bg-danger"
                                                                                type="text" id="grand_total"
                                                                                name="total_amount" value="$ 0.00"
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
                                                    <label for="" style="font-weight:bold ">Status payment <i
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
                                                        class="form-control form-control-sm paid_amount"
                                                        placeholder="Enter Paid Amount"
                                                        style="display:none; margin-top:5px;">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="" style="font-weight:bold ">Status livraison</label>
                                                    <select name="status_livraison"
                                                        class="form-control select2 select2-danger form-control-sm"
                                                        data-dropdown-css-class="select2-danger" id="status_livraison">
                                                        <option value="">Select_Status_livraison</option>
                                                        <option value="en embarcation">En embarcation</option>
                                                        <option value="en cours d'expedition">En cours d'expedition
                                                        </option>
                                                        <option value="livre">Livree</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="package_id" style="font-weight:bold ">Package
                                                        type</label>
                                                    <select name="unit_id"
                                                        class="form-control select2 select2-danger form-control-sm"
                                                        data-dropdown-css-class="select2-danger" id="package_id">
                                                        <option value="">Select_Status_livraison</option>
                                                        @foreach ($units as $unit )
                                                        <option value="{{ $unit->id }}">{{ $unit->name }}-({{
                                                            $unit->numero_id
                                                            }})
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <textarea name="description" class="form-control col-md-12"
                                                        placeholder="Entrer une description">
                                                  </textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-row">
                                            <div class="form-group col-md-4">
                                                <button type="submit" class="btn btn-dark w-100"> enregistrer </button>
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
<!-- Page specific script -->

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
                                        style="min-width: 100px;" id="chassis" name="chassis[]">
                                </td>
                                <td>
                                    <input type="text" class="form-control "
                                        style="width: 70px;" id="length" name="longueur[]">
                                </td>
                                <td>
                                    <input type="number" class="form-control "
                                        style="width: 70px;" id="width" name="largeur[]">
                                </td>
                                <td>
                                    <input type="number" class="form-control "
                                        style="width: 80px;" id="height" name="hauteur[]"
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