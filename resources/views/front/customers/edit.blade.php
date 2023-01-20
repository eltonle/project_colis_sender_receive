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
                    <h3 class="m-0 font-weight-bold">Gestions des Clients</h3>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Tableau de Bord</a></li>
                        <li class="breadcrumb-item active">Clients</li>
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
                            <h3> Editer Client
                                <a href="{{ route('customers.index') }}" class="btn btn-info float-right btn-sm">
                                    <i class="fa fa-list"></i> LISTES DES CLIENTS
                                </a>
                            </h3>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form action="{{ route('customers.update',$edit->id) }}" method="POST" id="myForm"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-row">

                                        <div class="form-group col-md-6">
                                            <label for="nom">NOM</label>
                                            <input type="text" id="nom" name="nom" value="{{ $edit->nom }}"
                                                class="form-control">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="prenom">PRENOM</label>
                                            <input type="text" id="prenom" name="prenom" value="{{ $edit->prenom }}"
                                                class="form-control">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="email">EMAIL</label>
                                            <input type="email" id="email" name="email" value="{{ $edit->email }}"
                                                class="form-control">
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label for="address">ADDRESS</label>
                                            <input type="text" id="address" name="address" value="{{ $edit->email }}"
                                                class="form-control">
                                        </div>
                                        {{-- <div class="form-group col-md-6">
                                            <label for="phone">Numero</label>
                                            <input type="tel" id="phone" name="phone" class="form-control">
                                        </div> --}}
                                        <div class="form-group col-md-3">
                                            <label for="phone">PHONE</label> <br>
                                            <input type="tel" id="phone" name="phone" value="{{ $edit->phone }}"
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
<!-- Page specific script -->
<script type="text/javascript">
    $(document).ready(function(){
    $('#myForm').validate({
        rules:{
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




@endsection