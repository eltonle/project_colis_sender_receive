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
                    <h3 class="m-0 font-weight-bold">Rapport d'Expediton Journalier</h3>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Tableau de Bord</a></li>
                        <li class="breadcrumb-item active">Rapport Expedition</li>
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
                    {{-- left col --}}
                    <section class="col-md-12">
                        {{-- custom tabs --}}
                        <div class="card">
                            <div class="card-header">
                                <h3>
                                    <a href="{{ route('invoices.pending.list') }}"
                                        class="btn btn-success float-right btn-sm">
                                        <i class="fa fa-list"></i> Listes des Expeditions
                                    </a>
                                </h3>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <!-- /.card-header -->
                                <form action="{{ route('invoices.daily.report.pdf') }}" method="GET" id="myForm"
                                    target="_blank">

                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label>Date Debut</label>
                                            <input type="date" name="start_date" id="start_date"
                                                class="form-control datepicker " placeholder="YYY-MM-DD">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Date Fin</label>
                                            <input type="date" name="end_date" id="end_date"
                                                class="form-control datepicker " placeholder="YYY-MM-DD">
                                        </div>
                                        <div class="form-group col-md-1" style="padding-top: 32px">
                                            <button type="submit" class="btn btn-success">Rechercher</button>
                                        </div>
                                    </div>
                                </form>
                                <!-- /.card-body -->
                            </div>
                        </div>
                    </section>
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
<script type="text/javascript">
    $(document).ready(function(){
    $('#myForm').validate({
        rules:{
            start_date: {
                required:true,
            },
            end_date: {
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