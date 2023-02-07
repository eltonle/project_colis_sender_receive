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
                    <h3 class="m-0 font-weight-bold">Gestions des Expeditions</h3>
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
                                <a href="{{ route('invoices.create') }}" class="btn  float-right"
                                    style="background: #563DEA; color:#fff">
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($allData as $key => $invoice)
                                        <tr>

                                            <td style="color:#2962FF;font-weight: 900; padding: 2px;">
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
                                                <span class="badge"
                                                    style="background: #2962FF;color:white; padding: 3px;">
                                                    <i class="fa fa-ship"></i> en embarcation</span>
                                                @elseif ($invoice->status_livraison == "en cours d'expedition")
                                                <span class="badge"
                                                    style="background: #010742; color:white; padding: 3px;">
                                                    <i class="fa fa-globe-americas"></i> en cours d'expedition</span>
                                                @elseif ($invoice->status_livraison == 'livre')
                                                <span class="badge"
                                                    style="background:  #B61418; color:white; padding: 3px;">
                                                    <i class="fa fa-check"></i> livre</span>
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
                                                <span class="badge"
                                                    style="background: #43BD00;color:white; padding: 3px;">
                                                    <i class="fa fa-burn"></i> partiel</span>
                                                @elseif ($invoice['payement']['paid_status'] == 'full_due')
                                                <span class="badge"
                                                    style="background:  #B61418; color:white; padding: 3px;">
                                                    <i class="fa fa-dailymotion"></i> Non payer</span>
                                                @elseif ($invoice['payement']['paid_status']=='full_paid')
                                                <span class="badge"
                                                    style="background: #36BEA6; color:white; padding: 3px;">
                                                    payer</span>
                                                @endif
                                            </td>
                                            <td class="">
                                                @if ($invoice->status == '0')
                                                <span class="badge"
                                                    style="background: #EF2856;color:white; padding: 3px;"> en
                                                    attente</span>
                                                @elseif ($invoice->status == '1')
                                                <span class="badge"
                                                    style="background: #B61418; color:white; padding: 3px;">
                                                    <i class="fa fa-check"></i> valide</span>
                                                @endif
                                            </td>

                                            <td>
                                                {{-- @if ($invoice->status=='1')
                                                <div style="display: flex; align-items: center">
                                                    <a href="{{ route('invoices.approve',$invoice->id) }}"
                                                        title="verifier la saisier et valider"
                                                        class="btn btn-sm btn-success mr-1"><i
                                                            class="fa fa-eye"></i></a>

                                                    <form method="POST"
                                                        action="{{ route('invoices.delete', $invoice->id) }}">
                                                        @csrf
                                                        <input name="_method" type="hidden" value="DELETE">
                                                        <button type="submit"
                                                            class="btn btn-sm rounded btn-danger  show_confirm"
                                                            data-toggle="tooltip" title='Supprimer'><i
                                                                class="fa fa-trash"></i></button>
                                                    </form>
                                                </div>
                                                @endif --}}
                                                @if ($invoice->status=='1')

                                                <div class="btn-group">
                                                    {{-- <button type="button" class="btn btn-default">Action</button>
                                                    --}}
                                                    <button type="button" style="background: #43BD00"
                                                        class="btn  btn-flat btn-sm dropdown-toggle dropdown-icon"
                                                        data-toggle="dropdown">
                                                        <span class=""
                                                            style="background: #43BD00; color: white; padding: 2px">Actions</span>
                                                    </button>
                                                    <div class="dropdown-menu" role="menu">
                                                        <a href="{{ route('invoices.approve',$invoice->id) }}"
                                                            title="verifier la saisier et valider"
                                                            class="dropdown-item"><span
                                                                class="text-xs text-dark font-weight-bold"><i
                                                                    class="fa fa-eye"></i> Voir l'expedition</span></a>

                                                        <a href="{{ route('invoices.edit_invoice',$invoice->id) }}"
                                                            type="button" title="editer
                                                            l'expedition" class="dropdown-item">
                                                            <span class="text-xs text-dark font-weight-bold"><i
                                                                    class="fas fa-edit"></i> Editer
                                                                l'expedition</span>
                                                        </a>
                                                        <div class="dropdown-item">
                                                            {{-- <form method="POST"
                                                                action="{{ route('invoices.delete', $invoice->id) }}">
                                                                @csrf
                                                                <input name="_method" type="hidden" value="DELETE">
                                                                <button type="submit" class="  show_confirm"
                                                                    data-toggle="tooltip" title='Supprimer'><i
                                                                        class="fa fa-trash"></i></button>
                                                            </form> --}}
                                                            <form method="POST"
                                                                action="{{ route('invoices.delete', $invoice->id) }}">
                                                                @csrf
                                                                <input name="_method" type="hidden" value="DELETE">
                                                                <button type="submit" class="border-0 show_confirm"
                                                                    style="margin-left: -5px" data-toggle="tooltip"
                                                                    title='Supprimer'> <span
                                                                        class="text-xs text-dark font-weight-bold"><i
                                                                            class="fa fa-trash"></i> Supprimer
                                                                        l'expedition</span></button>
                                                            </form>
                                                        </div>
                                                        <a href="#" type="button"
                                                            title="modifier le status de livraison"
                                                            class="btn btn-default dropdown-item modal-lg1 editStatu"
                                                            data-toggle="modal" data-target="#modal-lg1">
                                                            <span class="text-xs text-dark font-weight-bold"><i
                                                                    class="fas fa-sync-alt"></i> Status
                                                                Livraison</span>
                                                        </a>
                                                        <a href="#" type="button" title="ajouter un paiement"
                                                            class="btn btn-default dropdown-item modal-lg2 editPayement"
                                                            data-toggle="modal" data-target="#modal-lg2">
                                                            <span class="text-xs text-dark font-weight-bold"><i
                                                                    class="fas fa-money-bill-alt"></i> Ajouter un
                                                                Paiement</span>
                                                        </a>

                                                        <a href="javascript:void(0)" id="show-user" data-url="{{
                                                            route('customers.paid_modal',$invoice->id) }}"
                                                            class="dropdown-item showPayemnt" data-toggle="modal"
                                                            data-target="#modal-lg">
                                                            <span class="text-xs text-dark font-weight-bold"><i
                                                                    class="fa fa-eye"></i> Voir les
                                                                Paiement</span>

                                                        </a>
                                                        <a href="{{ route('invoices.print',$invoice->id) }}"
                                                            target="_blank" title="imprimer recépissé"
                                                            class="dropdown-item">
                                                            <span class="text-xs text-dark font-weight-bold"><i
                                                                    class="fa fa-print"></i> imprimer
                                                                recépissé</span>
                                                        </a>
                                                        <a href="{{ route('invoices.etiquette',$invoice->id) }}"
                                                            target="_blank" title="imprimer l'étiquette"
                                                            class="dropdown-item">
                                                            <span class="text-xs text-dark font-weight-bold"><i
                                                                    class="fa fa-print"></i> imprimer l'étiquette</span>
                                                        </a>
                                                    </div>
                                                </div>

                                                @endif
                                            </td>
                                            <td hidden>{{ $invoice->id }}</td>
                                            <td hidden>{{$invoice['payement']['due_amount'] }} </td>
                                            <td hidden>{{ number_format($invoice['payement']['total_amount'],0,'
                                                ',',')}} FCFA</td>

                                            <!-- /.modal -->
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
                        {{-- <p>One fine body&hellip;</p> --}}
                        {{-- <input type="hidden" name="invoice_id" id="invoice_id" value=""> --}}
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for=""> <i class="fa fa-receipt" style="color: #43BD00"></i> Récépissé №
                                    </label>
                                    <input type="text" class="form-control" value="" name="invoice_no" id="e_recep"
                                        readonly>
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
                                    <input type="text" class="form-control" name="paid_amount" id="paid_amount"
                                        disabled>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for=""> <i class="fas fa-donate" style="color:#EF2856"></i> Status du
                                        Colis</label>
                                    <select name="status_livraison" class="form-control  form-control"
                                        id="status_livraison" aria-placeholder="modifier le status du colis">
                                        <option value="en embarcation">En Embarcation</option>
                                        <option value="en cours d'expedition">En cours d'Expedition
                                        </option>
                                        <option value="livre">Livree</option>
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
                    {{-- @method('PUT') --}}
                    <div class="modal-body">
                        {{-- <p>One fine body&hellip;</p> --}}
                        {{-- <input type="hidden" name="invoice_id" id="invoice_id" value=""> --}}
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for=""> <i class="fa fa-receipt" style="color: #43BD00"></i> Récépissé №
                                    </label>
                                    <input type="text" class="form-control" value="" name="invoice_no" id="e_recep1"
                                        disabled>
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
                                    <label for=""> <i class="fa fa-money-bill-alt" style="color: #2962FF"></i> Montant
                                        Total de l'Expedition</label>
                                    <input type="text" class="form-control bg-blue" id="total_amount1" disabled>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for=""> <i class="fa fa-money-bill-alt" style="color: #0c1561"></i> Montant
                                        Payé</label>
                                    <input type="text" class="form-control bg-navy" name="paid_amount" id="paid_amount1"
                                        disabled>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for=""><i class="fas fa-money-check-alt" style="color: #EF2856"></i>
                                        Reste à Payer</label>
                                    <input type="text" class="form-control bg-danger" name="due_amount1" id="due_amount"
                                        disabled>
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
                                <input type="date" class="form-control" name="date">
                            </div>
                            <div class="form-group col-md-5">
                                <label for=""><i class="fas fa-money-check-alt" style="color: #43BD00"></i> Saisir un
                                    Montant</label>
                                <input type="text" class="form-control" name="paid_amount1" id="">
                            </div>
                            <div class="form-group col-md-2" style="padding-top:30px;">
                                <input type="text" class="form-control" value='FCFA' disabled>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn " style="background: #2962FF; color: #fff">Enregistrer le
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
                                <input type="text" class="form-control" value="" name="invoice_no" id="e_recep2"
                                    disabled>
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
                                <label for=""> <i class="fa fa-money-bill-alt" style="color: #2962FF"></i> Montant
                                    Total de l'Expedition</label>
                                <input type="text" class="form-control bg-blue" id="total_amount2" disabled>
                            </div>
                            <div class="form-group col-md-4">
                                <label for=""> <i class="fa fa-money-bill-alt" style="color: #0c1561"></i> Montant
                                    Payé</label>
                                <input type="text" class="form-control bg-navy" name="" id="paid_amount2" disabled>
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
                    <div class="row" style="margin-bottom: -33px">
                        <h4 class="text-center"><i class="fa fa-edit" style="color: #43BD00"></i>Ajouter un Paiement
                        </h4>
                    </div>
                </div>
                <form action="/update_facture1/" method="POST" enctype="multipart/form-data" id="editForm2">
                    @csrf
                    {{-- @method('PUT') --}}
                    <div class="row modal-body" style=" margin-top: 30px">
                        <div class="form-group col-md-5">
                            <label for=""><i class="fas fa-calendar" style="color: #43BD00"></i> Saisir une
                                Date</label>
                            <input type="date" class="form-control" name="date">
                        </div>
                        <div class="form-group col-md-5">
                            <label for=""><i class="fas fa-money-check-alt" style="color: #43BD00"></i> Saisir un
                                Montant</label>
                            <input type="text" class="form-control" name="paid_amount2" id="">
                            <input type="hidden" class="form-control" name="new_paid_amount2" id="due_amount_2">
                        </div>
                        <div class="form-group col-md-2" style="padding-top:30px;">
                            <input type="text" class="form-control" value='FCFA'>
                        </div>

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn" style="background: #2962FF; color: #fff">Enregistrer le
                            Paiement</button>
                    </div>
                </form>
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
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,"searching": true,
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
         var form =  $(this).closest("form");
         var name = $(this).data("name");
         event.preventDefault();
         swal({
             title: `Annuler facture?`,
             text: "voulez vous annuler cette facture.",
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

         table.on('click','.editStatu',function(){
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
            $('#editForm').attr('action','/invoices/modifier_status/'+data[11]);
        
         })
    }) 
</script>
{{-- modal update Payemeny --}}
<script>
    $(document).ready(function() {
         var table = $('#example1').DataTable();

         table.on('click','.editPayement',function(){
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

            $('#editForm1').attr('action','/invoices/update_facture/'+data[11]);
         })
    }) 
</script>
{{-- modal update ShowPayemeny --}}
<script>
    $(document).ready(function() {
         var table = $('#example1').DataTable();

         table.on('click','.showPayemnt',function(){
            $tr = $(this).closest('tr');
            if ($($tr).hasClass('child')) {
                $tr = $tr.prev('.parent');
            }
            var data = table.row($tr).data();
            console.log(data);
            $('#e_recep2').val(data[0]);
            $('#name2').val(data[1]);
            $('#namer2').val(data[2]);
            $('#date2').val(data[3]);
            $('#paid_amount2').val(data[4]);
            $('#due_amount2').val(data[7]);
            $('#due_amount_2').val(data[12]);
            $('#total_amount2').val(data[13]);

            $('#editForm2').attr('action','/invoices/update_facture1/'+data[11]);
         })
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
<script type="text/javascript">
    $(document).ready(function(){
    $('#editForm1').validate({
        rules:{
            date: {
                required:true,
            },
            paid_amount1: {
                required:true,
                number:true
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
<script type="text/javascript">
    $(document).ready(function(){
    $('#editForm2').validate({
        rules:{
            date: {
                required:true,
            },
            paid_amount2: {
                required:true,
                number:true
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

<script type="text/javascript">
    $(document).ready(function () {
        
     $('body').on('click', '#show-user', function () {
        var userUrl  = $(this).data('url');
        // console.log(userUrl);
        $('#tdata').find('tr').remove();
       
        $.getJSON(userUrl, function(data){
            // $('#userShowModal').modal('show');
            console.log(data);
            $('#recep').text(data[0].invoice_id);

            data.forEach(function(index) {
                $('#tdata').append(
                    "<tr>"+
                    "<td>"+index.date+"</td>"+
                    "<td>"+index.current_paid_amount+ " FCFA"+"</td>"
                    +"</tr>"
                );
            });
       
        })
     })
  })
</script>
@endsection