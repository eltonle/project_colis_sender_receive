@extends('layouts.master')
@section('css')
<style>
    #demo {
        -webkit-box-shadow: 7px 2px 20px 0px #000000;
        box-shadow: 7px 2px 20px 0px #000000;
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
                    <h3 class="m-0 font-weight-bold">Gestions des Expeditions <i class="far fa-keyboard"></i></h3>

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
                {{-- left col --}}
                <section class="col-md-12">
                    {{-- custom tabs --}}
                    <div class="card">
                        <div class="card-header">
                            <h3> LISTES DES EXPEDITIONS
                                <a href="{{ route('invoices.create') }}" class="btn  float-right" style="background: #563DEA; color:#fff">
                                    <i class="fa fa-plus-circle"></i> ENREGISTRER UNE EXPEDITION
                                </a>
                            </h3>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>

                                            <th>Récépissé</th>
                                            <th>Expediteur</th>
                                            <th> Destinataire</th>
                                            <th>Date</th>
                                            <th>Montant Paye </th>
                                            <th> Colis</th>
                                            <th hidden>colis hidden</th>
                                            <th hidden>dette hidden</th>
                                            <th>Paiement</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                            <th hidden>id</th>
                                            <th hidden>id</th>
                                            <th hidden>id</th>
                                            <th hidden>paid_amount</th>
                                            <th hidden>total_amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($allData as $key => $invoice)

                                        <tr>

                                            <td style="color:#2962FF;font-weight: 900; ">
                                                Récép №#{{$invoice->invoice_no}} </td>

                                            <td class="nom">
                                                {{ $invoice['payement']['customer']['nom'] }}
                                            </td>

                                            <td class="nomr">
                                                {{ $invoice['payement']['receive']['nom'] }}
                                            </td>
                                            <td>{{ date('d-M-Y',strtotime($invoice->date)) }}</td>
                                            <td>{{ number_format($invoice['payement']['paid_amount'],0,' ',',')}} FCFA

                                            <td class="livraison">

                                                @if ($invoice->status_livraison == 'en embarcation')
                                                <span class="badge" style="background: #2962FF;color:white; padding: 3px;">
                                                    <i class="fa fa-ship"></i> En Embarcation</span>
                                                @elseif ($invoice->status_livraison == "en cours d'expedition")
                                                <span class="badge" style="background: #010742; color:#00E5FF; padding: 3px;">
                                                    <i class="fa fa-globe-americas"></i> En Cours d'Expedition</span>
                                                @elseif ($invoice->status_livraison == "en transit")
                                                <span class="badge" style="background: #010742; color:white; padding: 3px;">
                                                    <i class="fa fa-globe-americas"></i> En Transit</span>
                                                @elseif ($invoice->status_livraison == 'livre')
                                                <span class="badge" style="background:  #34eb3d; color:white; padding: 3px;">
                                                    <i class="fa fa-check"></i> Livré</span>
                                                @endif
                                            </td>
                                            <td hidden>
                                                {{ $invoice->status_livraison }}
                                            </td>
                                            <td hidden>
                                                {{-- {{ $invoice['payement']['due_amount'] }} --}}
                                                {{ number_format($invoice['payement']['due_amount'],0,' ',',')}} FCFA
                                            </td>


                                            <td>
                                                @if ($invoice['payement']['paid_status'] == 'partial_paid')
                                                <span class="badge" style="background: #43BD00;color:white; padding: 3px;">
                                                    <i class="fa fa-burn"></i> Partiel</span>
                                                @elseif ($invoice['payement']['paid_status'] == 'full_due')
                                                <span class="badge" style="background:  #B61418; color:white; padding: 3px;">
                                                    <i class="fas fa-thumbs-down "></i> Non Payer</span>
                                                @elseif ($invoice['payement']['paid_status']=='full_paid')
                                                <span class="badge" style="background: #36BEA6; color:white; padding: 3px;">
                                                    <i class="fas fa-thumbs-up"></i> Payer</span>
                                                @endif
                                            </td>
                                            <td class="">
                                                @if ($invoice->status == '1')
                                                <span class="badge" style="background: #B61418; color:white; padding: 3px;">
                                                    <i class="fa fa-check"></i> Validé</span>
                                                @endif
                                            </td>

                                            <td>

                                                @if ($invoice->status=='1')

                                                <div class="btn-group">

                                                    <button type="button" style="background: #43BD00" class="btn  btn-flat btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                        <span class="" style="background: #43BD00; color: white; padding: 2px">Actions</span>
                                                    </button>
                                                    <div class="dropdown-menu" role="menu">
                                                        <a href="{{ route('invoices.approve',$invoice->id) }}" title="verifier la saisier et valider" class="dropdown-item"><span class="text-xs text-dark font-weight-bold"><i class="fa fa-eye"></i> Voir l'Expedition</span></a>
                                                        @php
                                                        $count = App\Models\PayementDetail::where('invoice_id', $invoice->id)->count();
                                                        @endphp

                                                        @if($count <= 1) <a href="{{ route('invoices.edit_invoice',$invoice->id) }}" type="button" title="editer l'expedition
                                                            " class="dropdown-item">
                                                            <span class="text-xs text-dark font-weight-bold"><i class="fas fa-edit"></i> Editer
                                                                l'Expedition</span>
                                                            </a>




                                                            <div class="dropdown-item">

                                                                <form method="POST" action="{{ route('invoices.delete', $invoice->id) }}">
                                                                    @csrf
                                                                    <input name="_method" type="hidden" value="DELETE">
                                                                    <button type="submit" class="border-0 show_confirm" style="margin-left: -5px" data-toggle="tooltip" title='Supprimer'> <span class="text-xs text-dark font-weight-bold"><i class="fa fa-trash"></i> Supprimer
                                                                            l'Expedition</span></button>
                                                                </form>
                                                            </div>

                                                            @endif
                                                            <a href="#" type="button" title="modifier le status de livraison" class="btn btn-default dropdown-item modal-lg1 editStatu" data-toggle="modal" data-target="#modal-lg1">
                                                                <span class="text-xs text-dark font-weight-bold"><i class="fas fa-sync-alt"></i> Status
                                                                    Livraison</span>
                                                            </a>
                                                            @if ($invoice['payement']['paid_amount'] < $invoice['payement']['total_amount']) <a href="#" type="button" title="ajouter un paiement" class="btn btn-default dropdown-item modal-lg2 editPayement" data-toggle="modal" data-target="#modal-lg2">
                                                                <span class="text-xs text-dark font-weight-bold"><i class="fas fa-money-bill-alt"></i> Ajouter un
                                                                    Paiement</span>
                                                                </a>
                                                                @endif

                                                                <a href="javascript:void(0)" id="show-user" data-url="{{
                                                                route('customers.paid_modal',$invoice->id) }}" class="dropdown-item showPayemnt" data-toggle="modal" data-target="#modal-lg">
                                                                    <span class="text-xs text-dark font-weight-bold"><i class="fa fa-eye"></i> Voir les
                                                                        Paiement</span>

                                                                </a>


                                                                <a href="{{ route('invoices.print',$invoice->id) }}" target="_blank" title="imprimer recépissé" class="dropdown-item">
                                                                    <span class="text-xs text-dark font-weight-bold"><i class="fa fa-print"></i> Imprimer
                                                                        Recépissé</span>
                                                                </a>
                                                                <a href="{{ route('invoices.etiquette',$invoice->id) }}" target="_blank" title="imprimer l'étiquette" class="dropdown-item">
                                                                    <span class="text-xs text-dark font-weight-bold"><i class="fa fa-print"></i> Imprimer
                                                                        l'Etiquette</span>
                                                                </a>
                                                    </div>
                                                </div>

                                                @endif
                                            </td>
                                            <td hidden>{{ $invoice->id }}</td>
                                            <td hidden>{{$invoice['payement']['due_amount'] }} </td>
                                            <td hidden>{{ number_format($invoice['payement']['total_amount'],0,'
                                                ',',')}} FCFA</td>
                                            <td hidden>{{$invoice['payement']['paid_amount'] }} </td>
                                            <td hidden>{{$invoice['payement']['total_amount'] }} </td>
                                        </tr>

                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Récépissé</th>
                                            <th>Expediteur</th>
                                            <th> Destinataire</th>
                                            <th>Date</th>
                                            <th>Montant Paye </th>
                                            <th> Colis</th>
                                            <th hidden>status</th>
                                            <th hidden>dette</th>
                                            <th>Paiement</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                            <th hidden>id</th>
                                            <th hidden>id</th>
                                            <th hidden>id</th>
                                            <th hidden>paid_amount</th>
                                            <th hidden>total_amount</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->

                        </div>
                    </div>

                </section>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->

    </div>



    {{-- STATUS LIVRAISON --}}
    <div class="modal fade" id="modal-lg1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-edit" style="color: #2962FF"></i> Modifier le Status de
                        Livraison</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/modifier_status/" method="POST" enctype="multipart/form-data" id="editForm">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for=""> <i class="fa fa-receipt" style="color: #43BD00"></i> Récépissé №
                                    </label>
                                    <input type="text" class="form-control" value="" name="invoice_no" id="e_recep" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for=""> <i class="fa fa-user" style="color: #43BD00"></i> Nom de
                                        l'Expediteur</label>
                                    <input type="text" class="form-control" name="name" id="name" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for=""> <i class="fa fa-user" style="color:#43BD00"></i> Nom du
                                        Destinataire</label>
                                    <input type="text" class="form-control" name="namer" id="namer" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for=""> <i class="fa fa-calendar" style="color:#43BD00"></i> Date
                                        de l'Expedition</label>
                                    <input type="text" class="form-control" name="date" id="date" readonly>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for=""> <i class="fa fa-money-bill-alt" style="color:#43BD00"></i>
                                        Montant
                                        Total de l'Expedition</label>
                                    <input type="text" class="form-control" name="" id="total_amount" disabled>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for=""> <i class="fa fa-money-bill-alt" style="color:#43BD00"></i>
                                        Montant
                                        Payé</label>
                                    <input type="text" class="form-control" name="paid_amount" id="paid_amount" disabled>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for=""> <i class="fas fa-donate" style="color:#EF2856"></i> Status du
                                        Bon d'Expedition</label>
                                    <select name="status_livraison" class="form-control  form-control" id="status_livraison" aria-placeholder="modifier le status du colis">
                                        <option value="">selection un status</option>
                                        <option value="en embarcation">En Embarcation</option>
                                        <option value="en transit">En Transit</option>
                                        <option value="en cours d'expedition">En cours d'Expedition
                                        </option>
                                        <option value="livre">Livré</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Enregistrer les informations</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    {{-- ADD PAYEMENT --}}
    <div class="modal fade" id="modal-lg2">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="far fa-credit-card" style="color: #2962FF;"></i> Enregistrer un
                        Paiement</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/invoices/update_facture" id="editForm1" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for=""> <i class="fa fa-receipt" style="color: #43BD00"></i> Récépissé №
                                    </label>
                                    <input type="text" class="form-control" value="" name="invoice_no" id="e_recep1" disabled>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for=""> <i class="fa fa-user" style="color: #43BD00"></i> Nom de
                                        l'Expediteur</label>
                                    <input type="text" class="form-control" name="name" id="name1" disabled>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for=""> <i class="fa fa-user" style="color: #43BD00"></i> Nom du
                                        Destinataire</label>
                                    <input type="text" class="form-control" name="namer" id="namer1" disabled>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for=""> <i class="fa fa-calendar" style="color: #43BD00"></i> Date
                                        de l'Expedition</label>
                                    <input type="text" class="form-control" name="date" id="date1" disabled>
                                </div>
                            </div>
                            <hr>
                            <hr>
                            <div class="row" id="">
                                <div class="form-group col-md-4">
                                    <label for=""> <i class="fa fa-money-bill-alt" style="color: #2962FF"></i> Coût
                                        Total de l'Expedition</label>
                                    <input type="text" class="form-control bg-blue" id="total_amount1" disabled>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for=""> <i class="fa fa-money-bill-alt" style="color: #0c1561"></i> Montant
                                        Payé</label>
                                    <input type="text" class="form-control bg-navy" name="paid_amount" id="paid_amount1" disabled>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for=""><i class="fas fa-money-check-alt" style="color: #EF2856"></i>
                                        Reste à Payer</label>
                                    <input type="text" class="form-control bg-danger" name="due_amount1" id="due_amount" disabled>
                                    <input type="hidden" class="form-control" name="new_paid_amount" id="due_amount1">

                                </div>

                            </div>
                            <hr>
                        </div>
                        <div class="row" style=" margin-top: 40px">
                            <h4 class="text-center"><i class="fa fa-edit" style="color: #43BD00"></i>Ajouter un Paiement
                            </h4>
                        </div>
                        <div class="row" style=" margin-top: 40px">
                            <div class="form-group col-md-5">
                                <label for=""><i class="fas fa-calendar" style="color: #43BD00"></i> Saisir une
                                    Date</label>
                                <input type="date" class="form-control" value="{{ $date }}" name="date">
                            </div>
                            <div class="form-group col-md-5">
                                <label for=""><i class="fas fa-money-check-alt" style="color: #43BD00"></i> Saisir un
                                    Montant</label>
                                <input type="number" class="form-control" name="paid_amount1" id="paid_amount_show1">
                                <div id="errMsg"></div>
                                <input type="text" class="form-control bg-danger" name="due_amount_show1" id="due_amount_show1" hidden>
                            </div>
                            <div class="form-group col-md-2" style="padding-top:30px;">
                                <input type="text" class="form-control" value='FCFA' disabled>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn " style="background: #2962FF; color: #fff" id="submit">Enregistrer le
                            Paiement</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


    {{-- SHOW PAYEMENTDETAIL --}}
    <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"> <i class="fa fa-adjust" style="color: #2962FF"></i> Details de Payements du
                        Récépisse № : <span id="recep"></span></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    {{-- <p>One fine body&hellip;</p> --}}
                    {{-- <input type="hidden" name="invoice_id" id="invoice_id" value=""> --}}
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for=""> <i class="fa fa-receipt" style="color: #43BD00"></i> Récépissé № </label>
                                <input type="text" class="form-control" value="" name="invoice_no" id="e_recep2" disabled>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for=""> <i class="fa fa-user" style="color: #43BD00"></i> Nom de
                                    l'Expediteur</label>
                                <input type="text" class="form-control" name="name" id="name2" disabled>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for=""> <i class="fa fa-user" style="color: #43BD00"></i> Nom du
                                    Destinataire</label>
                                <input type="text" class="form-control" name="namer" id="namer2" disabled>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for=""> <i class="fa fa-calendar" style="color: #43BD00"></i> Date
                                    de l'Expedition</label>
                                <input type="text" class="form-control" name="date" id="date2" disabled>
                            </div>
                        </div>
                        <hr>
                        <hr>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for=""> <i class="fa fa-money-bill-alt" style="color: #2962FF"></i> Coût
                                    Total de l'Expedition</label>
                                <input type="text" class="form-control bg-blue" id="total_amount2" disabled>
                                <input type="text" class="form-control bg-blue" id="total_amount_show2" hidden>
                            </div>
                            <div class="form-group col-md-4">
                                <label for=""> <i class="fa fa-money-bill-alt" style="color: #0c1561"></i> Montant
                                    Payé</label>
                                <input type="text" class="form-control bg-navy" name="" id="paid_amount2" disabled>
                                <input type="text" class="form-control bg-navy" name="" id="paid_amount_show22" hidden>
                            </div>
                            <div class="form-group col-md-4">
                                <label for=""><i class="fas fa-money-check-alt" style="color: #EF2856"></i> Reste à
                                    Payer</label>
                                <input type="text" class="form-control bg-danger" id="due_amount2">
                            </div>
                        </div>

                    </div>

                </div>

                <div class="modal-body">
                    <h4 class="text-center"> <i class="fa fa-list-alt" style="color: #43BD00"></i> Sommaire de Paiement
                    </h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="50%" class="text-right">Date</th>
                                <th width="50%">Montant verse</th>
                            </tr>
                        </thead>
                        <tbody id="tdata">

                        </tbody>
                    </table>
                </div>
                <div class="" id="pay_toggle">
                    <div class="" style="margin-bottom: -33px">
                        <h4 class="text-center"><i class="fa fa-edit" style="color: #43BD00"></i>Ajouter un Paiement
                        </h4>
                    </div>

                    <form action="/update_facture1/" method="POST" enctype="multipart/form-data" id="editForm2">
                        @csrf
                        <div class="row modal-body" style=" margin-top: 30px">
                            <div class="form-group col-md-5">
                                <label for=""><i class="fas fa-calendar" style="color: #43BD00"></i> Saisir une
                                    Date</label>
                                <input type="date" value="{{ $date }}" class="form-control" name="date">
                            </div>
                            <div class="form-group col-md-5">
                                <label for=""><i class="fas fa-money-check-alt" style="color: #43BD00"></i> Saisir un
                                    Montant</label>
                                <input type="number" class="form-control" name="paid_amount2" id="paid_amount_show2">
                                <div id="errMsg1"></div>
                                <input type="text" class="form-control" name="due_amount_show2" id="due_amount_show2" hidden>

                                <input type="hidden" class="form-control" name="new_paid_amount2" id="due_amount_2">
                            </div>
                            <div class="form-group col-md-2" style="padding-top:30px;">
                                <input type="text" class="form-control" value='FCFA'>
                            </div>

                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" id="submit1" class="btn" style="background: #2962FF; color: #fff">Enregistrer le
                                Paiement</button>
                        </div>

                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

</div>
<!-- /.content-wrapper -->

@endsection
@section('scripts')
<!-- Page specific script -->
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "searching": true,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');


        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "processing": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
<script type="text/javascript">
    $('.show_confirm').click(function(event) {
        var form = $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        swal({
                title: "Supprimer l'expedition?",
                text: "voulez vous supprimer l'expedition ?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }
            });
    });
</script>

{{-- modal update status --}}
<script>
    $(document).ready(function() {
        var table = $('#example1').DataTable();

        table.on('click', '.editStatu', function() {
            $tr = $(this).closest('tr');
            if ($($tr).hasClass('child')) {
                $tr = $tr.prev('.parent');
            }
            var data = table.row($tr).data();
            console.log(data);
            $('#e_recep').val(data[0]);
            $('#name').val(data[1]);
            $('#namer').val(data[2]);
            $('#date').val(data[3]);
            $('#paid_amount').val(data[4]);
            $('#status_livraison').val(data[6]);
            // $('#due_amount').val(data[7]);
            // $('#due_amount1').val(data[12]);
            $('#total_amount').val(data[13]);
            $('#editForm').attr('action', '/expeditions/modifier_status/' + data[11]);

        })
    })
</script>

{{-- modal update Payement --}}
<script>
    $(document).ready(function() {
        var table = $('#example1').DataTable();

        table.on('click', '.editPayement', function() {
            $tr = $(this).closest('tr');
            if ($($tr).hasClass('child')) {
                $tr = $tr.prev('.parent');
            }
            var data = table.row($tr).data();
            console.log(data);
            $('#e_recep1').val(data[0]);
            $('#name1').val(data[1]);
            $('#namer1').val(data[2]);
            $('#date1').val(data[3]);
            $('#paid_amount1').val(data[4]);
            $('#due_amount').val(data[7]);
            $('#due_amount1').val(data[12]);
            $('#total_amount1').val(data[13]);
            $('#due_amount_show1').val(data[12]);

            $paid_amount_show1 = $('#paid_amount_show1').val();
            $due_amount_show1 = $('#due_amount_show1').val();

            $('#paid_amount_show1').keyup(function() {
                $paid_amount_show1 = $(this).val();
                $due_amount_show1 = $('#due_amount_show1').val();
                console.log($due_amount_show1);
                console.log($paid_amount_show1);
                console.log(typeof($paid_amount_show1));

                //  if (parseInt($paid_amount_show1 )> 0) {
                if ($paid_amount_show1 == '') {
                    $('#submit').attr('disabled', false);
                    $("div#errMsg").css("color", "#16a085");
                    $("div#errMsg").html("");
                } else if (parseInt($paid_amount_show1) > parseInt($due_amount_show1)) {
                    $('#submit').attr('disabled', true);
                    $("div#errMsg").css("color", "red");
                    $("div#errMsg").html("Montant elevé");
                } else if (parseInt($paid_amount_show1) === parseInt($due_amount_show1)) {
                    $('#submit').attr('disabled', false);
                    $("div#errMsg").css("color", "green");
                    $("div#errMsg").html("payer Totalement");
                } else {
                    $('#submit').attr('disabled', false);
                    $("div#errMsg").css("color", "green");
                    $("div#errMsg").html("Payer partielement");
                }
                //  }


            })

            $('#editForm1').attr('action', '/expeditions/update_facture/' + data[11]);
            // $('#editForm1').attr('action','/invoices/update_facture/'+data[11]);
        })


    })
</script>


{{-- modal update ShowPayemeny --}}
<script>
    $(document).ready(function() {
        var table = $('#example1').DataTable();

        table.on('click', '.showPayemnt', function() {
            $tr = $(this).closest('tr');
            if ($($tr).hasClass('child')) {
                $tr = $tr.prev('.parent');
            }
            var data = table.row($tr).data();
            // console.log(data);
            $('#e_recep2').val(data[0]);
            $('#name2').val(data[1]);
            $('#namer2').val(data[2]);
            $('#date2').val(data[3]);
            $('#paid_amount2').val(data[4]);
            $('#due_amount2').val(data[7]);
            $('#due_amount_2').val(data[12]);
            $('#total_amount2').val(data[13]);

            $('#paid_amount_show22').val(data[14]);
            $('#total_amount_show2').val(data[15]);


            $('#due_amount_show2').val(data[12]);

            // $paid_amount_show2 = $('#paid_amount_show2').val();
            $due_amount_show2 = $('#due_amount_show2').val();
            $total_amount_show2 = $('#total_amount_show2').val();

            $('#paid_amount_show2').keyup(function() {
                $paid_amount_show2 = $(this).val();
                // alert($paid_amount_show2).
                $due_amount_show2 = $('#due_amount_show2').val();
                $total_amount_show2 = $('#total_amount_show2').val();
                // console.log($due_amount_show2);
                // console.log($paid_amount_show2);

                if ($paid_amount_show2 == '') {
                    $('#submit1').attr('disabled', false);
                    $("div#errMsg1").css("color", "#16a085");
                    $("div#errMsg1").html(" ");
                } else if (parseInt($paid_amount_show2) > parseInt($due_amount_show2)) {
                    $('#submit1').attr('disabled', true);
                    $("div#errMsg1").css("color", "red");
                    $("div#errMsg1").html("Montant elevé");
                } else if (parseInt($paid_amount_show2) === parseInt($due_amount_show2)) {
                    $('#submit1').attr('disabled', false);
                    $("div#errMsg1").css("color", "green");
                    $("div#errMsg1").html("payer Totalement");
                } else {
                    $('#submit1').attr('disabled', false);
                    $("div#errMsg1").css("color", "green");
                    $("div#errMsg1").html("payer Partiellement")
                }
            })

            $paid_amount_show22 = $('#paid_amount_show22').val();
            $total_amount_show2 = $('#total_amount_show2').val();

            console.log($paid_amount_show22);
            console.log($total_amount_show2);
            if (parseInt($total_amount_show2) === parseInt($paid_amount_show22)) {
                console.log('egal');
                $("div#pay_toggle").hide();
            } else {
                $("div#pay_toggle").show();
            }


            $('#editForm2').attr('action', '/invoices/update_facture1/' + data[11]);
        })
    })
</script>
<script type="text/javascript">
    //paid status
    $(document).on("change", "#paid_status", function() {
        var paid_status = $(this).val();
        if (paid_status == 'partial_paid') {
            $('.paid_amount').show();
        } else {
            $('.paid_amount').hide();
        }
    })
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#editForm1').validate({
            rules: {
                date: {
                    required: true,
                },
                paid_amount1: {
                    required: true,
                    number: true
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
<script type="text/javascript">
    $(document).ready(function() {
        $('#editForm2').validate({
            rules: {
                date: {
                    required: true,
                },
                paid_amount2: {
                    required: true,
                    number: true
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

<script type="text/javascript">
    $(document).ready(function() {

        $('body').on('click', '#show-user', function() {
            var userUrl = $(this).data('url');
            // console.log(userUrl);
            $('#tdata').find('tr').remove();

            $.getJSON(userUrl, function(data) {
                // $('#userShowModal').modal('show');
                console.log(data);
                $('#recep').text(data[0].invoice_id);

                data.forEach(function(index) {
                    $('#tdata').append(
                        "<tr>" +
                        "<td>" + index.date + "</td>" +
                        "<td>" + index.current_paid_amount + " FCFA" + "</td>" +
                        "</tr>"
                    );
                });

            })
        })
    })
</script>
@endsection