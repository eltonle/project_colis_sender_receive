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
                    <h3 class="m-0 font-weight-bold">Manage Recepteurs</h3>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Recepteurs</li>
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
                {{-- left col --}}
                <section class="col-md-12">
                    {{-- custom tabs --}}
                    <div class="card">
                        <div class="card-header">
                            <h3> Edit un recepteur
                                <a href="{{ route('receives.index') }}" class="btn btn-info float-right btn-sm">
                                    <i class="fa fa-list"></i> LISTES DES RECEPTEURS
                                </a>
                            </h3>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form action="{{ route('receives.update',$edit->id) }}" method="POST" id="myForm"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col-md-5">
                                            <label>CLIENT ASSOCIE </label>
                                            <select class="form-control select2 select2-danger" id="customer_id"
                                                name="customer_id" data-dropdown-css-class="select2-danger">
                                                @foreach ($customers as $customer )
                                                <option value="{{ $customer->id }}" @if($customer->id == $edit->id)
                                                    selected="selected"
                                                    @endif>{{ $customer->nom}}-({{
                                                    $customer->phone }}-{{ $customer->address
                                                    }}-{{
                                                    $customer->email}})</option>
                                                @endforeach
                                            </select>

                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="nomr">NOM</label>
                                            <input type="text" id="nomr" name="nomr" value="{{ $edit->nomr }}"
                                                class="form-control">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="prenomr">PRENOM</label>
                                            <input type="text" id="prenomr" name="prenomr" value="{{ $edit->prenomr }}"
                                                class="form-control">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="emailr">EMAIL</label>
                                            <input type="email" id="emailr" name="emailr" value="{{ $edit->emailr }}"
                                                class="form-control">
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label for="addressr">ADDRESS</label>
                                            <input type="text" id="addressr" name="addressr" value="{{ $edit->emailr }}"
                                                class="form-control">
                                        </div>
                                        {{-- <div class="form-group col-md-6">
                                            <label for="phone">Numero</label>
                                            <input type="tel" id="phone" name="phone" class="form-control">
                                        </div> --}}
                                        <div class="form-group col-md-3">
                                            <label for="phoner">PHONE</label> <br>
                                            <input type="tel" id="phoner" name="phoner" value="{{ $edit->phoner }}"
                                                class="form-control">
                                            <span id="valid-msg" class="hide error0">✓ Valid</span>
                                            <span id="error-msg" class="hide error1"></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input type="submit" value="ENREGISTRER" class="btn btn-info">
                                        </div>
                                    </div>

                                </form>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </section>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection

@section('scripts')
<!-- Number script -->
<script src="{{ asset('build/js/intlTelInput.min.js') }}"></script>
<script src="{{ asset('build/js/intlTelInput.js') }}"></script>

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
            customer_id: {
                required:true,
            },
            nom: {
                required:true,
                rangelength :[3,30]
            },
            prenom: {
                required:true,
                rangelength :[3,30]
            },
            email: {
                required:true,
                email:true,
            },
            address: {
                required:true,
            },
            phone: {
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


@endsection