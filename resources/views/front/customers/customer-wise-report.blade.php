@extends('layouts.master')
@section("css")

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
                    <h3 class="m-0 font-weight-bold">Rapport Clients <i class="fas fa-tags"></i></h3>
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
                <section class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>
                                Selectionner une Option
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 text-center">
                                    <label for="cc"><strong> Rapport Client Credit</strong></label>
                                    <input type="checkbox" name="customer_wise_credit" id="cc" value="customer_wise_credit" class="search_value">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <label for="cp"><strong> Rapport Client Paiement </strong></label>
                                    <input type="checkbox" name="customer_wise_paid" id="cp" value="customer_wise_paid" class="search_value">
                                </div>
                            </div>
                            <div class="show_credit" style="display: none">
                                <form action="{{ route('customers.wise.credit.report') }}" method="get" target="_blank" id="customerCreditForm">
                                    <div class="form-row">
                                        <div class="col-sm-8">
                                            <label>Nom de L'Expedition Credit</label>
                                            <select name="customer_id" class="form-control select2 select2-danger form-control-sm" data-dropdown-css-class="select2-cyan" id="">
                                                <option value="">Selectionner un Expediteur</option>
                                                @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}">{{ $customer->nom }}-({{
                                                    $customer->phone
                                                    }}-{{
                                                    $customer->address }}-{{ $customer->email }}-)</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-4" style="padding-top: 32px">
                                            <button type="submit" class="btn btn-primary btn-sm">Rechercher</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="show_paid" style="display: none">
                                <form action="{{ route('customers.wise.paid.report') }}" method="get" target="_blank" id="customerPaidForm">
                                    <div class="form-row">
                                        <div class="col-sm-8">
                                            <label>Nom de d'Expediteur Paiement</label>
                                            <select name="customer_id" class="form-control select2 select2-danger form-control-sm" data-dropdown-css-class="select2-cyan" id="status_livraison">
                                                <option value="">Selectionner un Expediteur</option>
                                                @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}">{{ $customer->nom }}-({{
                                                    $customer->phone }}-{{ $customer->address }}-{{ $customer->email
                                                    }})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-4" style="padding-top: 32px">
                                            <button type="submit" class="btn btn-primary btn-sm">Rechercher</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
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
<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()
    })
    //Initialize Select2 Elements
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#customerCreditForm').validate({
            ignore: [],
            errorPlacement: function(error, element) {
                if (element.attr("name") == "customer_id") {
                    error.insertAfter(element.next());
                } else {
                    error.insertAfter(element);
                }
            },
            errorClass: 'text-danger',
            validClass: 'text-success',
            rules: {
                customer_id: {
                    required: true,
                }
            },
            message: {

            },
        })
    })
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#customerPaidForm').validate({
            ignore: [],
            errorPlacement: function(error, element) {
                if (element.attr("name") == "customer_id") {
                    error.insertAfter(element.next());
                } else {
                    error.insertAfter(element);
                }
            },
            errorClass: 'text-danger',
            validClass: 'text-success',
            rules: {
                customer_id: {
                    required: true,
                }
            },
            message: {

            },
        })
    })
</script>
<!-- Page specific script -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#myForm').validate({
            rules: {
                nom: {
                    required: true,
                    rangelength: [3, 30]
                },
                prenom: {
                    required: true,
                    rangelength: [3, 30]
                },
                email: {
                    required: true,
                    email: true,
                },
                address: {
                    required: true,
                },
                phone: {
                    required: true,
                },
            },
            messages: {

            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        })
    })
</script>

<script>
    $(document).on('change', '.search_value', function() {
        var search_value = $(this).val();
        if (search_value == 'customer_wise_credit') {
            $('.show_credit').show();
        } else {
            $('.show_credit').hide();
        }

        if (search_value == 'customer_wise_paid') {
            $('.show_paid').show();
        } else {
            $('.show_paid').hide();
        }
    })
</script>


@endsection