@extends('layouts.master')

@section('css')
<style>
    /* Classe pour les cellules du tableau */
    .table-cell {
        border: 1px solid #000;
        text-align: center;
        color: #00C853;
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
                    <h3 class="m-0 font-weight-bold">Gestions des Colis <i class="fas fa-box"></i></h3>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Tableau de Bord</a></li>
                        <li class="breadcrumb-item active">Pays</li>
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
                            <h3> Listes des Colis
                                {{-- <a href="{{ route('countries.create') }}"
                                class="btn btn-success float-right btn-sm">
                                <i class="fa fa-plus-circle"></i> AJOUTER UN PAYS
                                </a> --}}
                            </h3>
                        </div><!-- /.card-header -->

                        <!-- /.card-header -->
                        <div class="card-body">
                            <!-- Default box -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Liste des colis Enregistrés</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Titre Colis</th>
                                                <th>Nom de l'Expediteur</th>
                                                <th>Date</th>
                                                <th>Montant Colis</th>
                                                <th>Etat Chargement</th>

                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($colis as $ul)
                                            <tr>
                                                <td>{{ strtoupper($ul->titre)}}</td>
                                                <td>{{ strtoupper( $ul->invoice->payement->customer->nom)}}</td>

                                                <td>{{ date('d-M-Y',strtotime($ul->invoice->date)) }}</td>
                                                <td>{{ number_format($ul->prix ,0,' ',',')}} FCFA</td>

                                                <td>
                                                    @if ($ul->charge == 1)
                                                    <span class="badge" style="background: #2962FF;color:white; padding: 3px;">
                                                        <i class="fas fa-truck"></i> Colis Chargé</span>
                                                    @elseif (($ul->charge == 2) && ($ul->decharge == 1))
                                                    <span class="badge " style="background:  #fa03d1; color:white; padding: 3px;">
                                                        <i class="fas fa-check"></i> Colis Dechargé</span>
                                                    @else
                                                    <span class="badge " style="background:  #B61418; color:white; padding: 3px;">
                                                        <i class="fas fa-times"></i> Colis Non Chargé</span>
                                                    @endif
                                                </td>
                                                <td>

                                                    <div class="btn-group">
                                                        <button type="button" style="background: #43BD00" class="btn  btn-flat btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                            <span class="" style="background: #43BD00; color: white; padding: 2px">Actions</span>
                                                        </button>

                                                        <div class="dropdown-menu" role="menu">
                                                            <button data-colis-id="{{ $ul->id }}" type="button" class="btn btn-default dropdown-item btn-show-details" data-toggle="modal" data-target="#modal-lg">
                                                                <span class="text-xs text-dark font-weight-bold"><i class="fa fa-eye"></i> Information
                                                                    du Colis</span>
                                                            </button>
                                                            <!-- <a href="{{ route('colis.mouvements',$ul->id) }}"   class="btn btn-default" >
                                                                <span class="text-xs text-dark font-weight-bold"><i class="fa fa-eye"></i> mouvements
                                                                    du Colis</span> -->
                                                            </a>
                                                            <button data-colis-id="{{ $ul->id }}" type="button" class="btn btn-default dropdown-item btn-show-historique" data-toggle="modal" data-target="#modal-historique">
                                                                <span class="text-xs text-dark font-weight-bold"><i class="fa fa-eye"></i> mouvements
                                                                    du Colis</span>
                                                            </button>

                                                            <a href="{{ route('colis.print',$ul->id) }}" target="_blank" title="imprimer recépissé" class="dropdown-item">
                                                                <span class="text-xs text-dark font-weight-bold"><i class="fa fa-print"></i> Imprimer
                                                                    l'Etiquette</span>
                                                            </a>

                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach


                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Titre Colis</th>
                                                <th>Nom de l'Expediteur</th>
                                                <th>Date</th>
                                                <th>Montant Colis</th>
                                                <th>Etat Chargement</th>

                                                <th>Actions</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer text-center">Fin Listes</div>
                                <!-- /.card-footer-->
                            </div>
                            <!-- /.card -->

                        </div>
                        <!-- /.card-body -->

                    </div>
                </section>
            </div>
            <!-- /.row -->

            {{-- MODAL DES DETAILS DES COLIS --}}
            <div class="modal fade" id="modal-lg">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Informations Colis</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="col-12  d-flex align-items-stretch flex-column">
                                <div class="card bg-light d-flex flex-fill">
                                    <div class="card-header text-muted border-bottom-0">
                                        Expediteur-Recepteur-Colis
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="row mb-5">
                                            <div class="col-5">
                                                <h2 class="lead font-weight-bold" id="nom"></h2>

                                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                                    <li class="small">
                                                        <span class="fa-li"><i class="fas fa-envelope-open fa-lg"></i></span>
                                                        <span class="text-md font-weight-bold">Email :</span>
                                                        <span id="email"></span>
                                                    </li>
                                                    <li class="small">
                                                        <span class="fa-li"><i class="fas fa-lg fa-building"></i></span>
                                                        <span class="text-md font-weight-bold">Address :</span>
                                                        <span id="address"></span>
                                                    </li>
                                                    <li class="small">
                                                        <span class="fa-li"><i class="fas fa-lg fa-phone"></i></span>
                                                        <span class="text-md font-weight-bold">Phone :</span><span id="phone"></span>
                                                    </li>
                                                </ul>

                                            </div>
                                            <div class="col-5" style="margin-left: 80px">
                                                <h2 class="lead font-weight-bold" id="nomr"></h2>

                                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                                    <li class="small">
                                                        <span class="fa-li"><i class="fas fa-envelope-open fa-lg"></i></span>
                                                        <span class="text-md font-weight-bold">Email :</span>
                                                        <span id="emailr"></span>
                                                    </li>
                                                    <li class="small">
                                                        <span class="fa-li"><i class="fas fa-lg fa-building"></i></span>
                                                        <span class="text-md font-weight-bold">Address :</span>
                                                        <span id="addressr"></span>
                                                    </li>
                                                    <li class="small">
                                                        <span class="fa-li"><i class="fas fa-lg fa-phone"></i></span>
                                                        <span class="text-md font-weight-bold">Phone :</span><span id="phoner"></span>
                                                    </li>
                                                </ul>

                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-7">
                                                <h4 class="lead "><strong id="titre"> </strong></h4>

                                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                                    <li class="small">

                                                        <span class="text-md font-weight-bold">Type colis :</span>
                                                        <span id="type"></span>
                                                    </li>
                                                    <li class="small long">

                                                        <span class="text-md font-weight-bold">Longueur :</span> <span id="longueur"></span>
                                                        <span>Cm</span>
                                                    </li>
                                                    <li class="small larg">

                                                        <span class="text-md font-weight-bold">Largeur :</span> <span id="largeur"></span>
                                                        <span>Cm</span>
                                                    </li>
                                                    <li class="small haut">

                                                        <span class="text-md font-weight-bold">Hauteur : </span> <span id="hauteur"></span>
                                                        <span>Cm</span>
                                                    </li>
                                                    <li class="small">

                                                        <span class="text-md font-weight-bold">Prix :</span> <span id="prix"></span>
                                                        <span>FCFA</span>
                                                    </li>
                                                </ul>
                                                <p class="text-muted text-sm">
                                                    <b>Description du Colis :</b> <span id="description"></span>
                                                </p>
                                            </div>
                                            <div class="col-5 text-center">
                                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRcj3UacIk1fVRX74DnFZSGixD_Gwy7sqEdMA&usqp=CAU" alt="colis-avatar" class=" img-fluid rounded-3 h-100" />
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="card-footer">
                                        <div class="text-right">
                                            <a href="#" class="btn btn-sm bg-teal">
                                                <i class="fas fa-comments"></i>
                                            </a>
                                            <a href="#" class="btn btn-sm btn-primary">
                                                <i class="fas fa-user"></i> View Profile
                                            </a>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                Close
                            </button>
                            {{-- <button type="button" class="btn btn-primary">
                                Save changes
                            </button> --}}
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            {{--FIN MODAL DES DETAILS DES COLIS --}}

            <!-- MODALS HISTORIQUES -->
            <div class="modal fade" id="modal-historique">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">

                            <h4 class="modal-title" style="color: #212121; font-weight: bold;" id="colis_infos"></h4>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div id="loading-indicator" style="display: none;
  align-items: center;
  justify-content: center; margin-top: 40px;">
                            <div class="text-center">
                                <div class="spinner-border text-secondary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div id="loading-indicator1" style="display: none;">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="text-center">
                                            <h4 style="color: #3D5AFE;">entrepots de depart</h4>
                                        </div>
                                        <table class="table table-bordered border-primary">
                                            <thead>
                                                <tr>
                                                    <th style="border: 1px solid #0D47A1; padding: 8px;">Nom de l'Entrepôt</th>
                                                    <th style="border: 1px solid #0D47A1; padding: 8px;">Ville</th>
                                                    <th style="border: 1px solid #0D47A1; padding: 8px;">Date</th>
                                                </tr>
                                            </thead>
                                            <tbody id="historique-colis-depart">
                                                <!-- Les données seront affichées ici -->
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-center">
                                            <h4 style="color: #3D5AFE;">entrepots d'arrivé</h4>
                                        </div>
                                        <table class="table table-bordered border-primary">
                                            <thead>
                                                <tr>
                                                    <th style="border: 1px solid #0D47A1; padding: 8px;">Nom de l'Entrepôt</th>
                                                    <th style="border: 1px solid #0D47A1; padding: 8px;">Ville</th>
                                                    <th style="border: 1px solid #0D47A1; padding: 8px;">Date</th>
                                                </tr>
                                            </thead>
                                            <tbody id="historique-colis-arrive">
                                                <!-- Les données seront affichées ici -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="text-center">
                                            <h4 style="color: #3D5AFE;">conteneurs </h4>
                                        </div>
                                        <table class="table table-bordered border-primary">
                                            <thead>
                                                <tr>
                                                    <th style="border: 1px solid #0D47A1; padding: 8px;">Numero du conteneur</th>
                                                    <th style="border: 1px solid #0D47A1; padding: 8px;">Nom du conteneur</th>
                                                    <th style="border: 1px solid #0D47A1; padding: 8px;">Status</th>
                                                    <th style="border: 1px solid #0D47A1; padding: 8px;">Date</th>
                                                </tr>
                                            </thead>
                                            <tbody id="historique-colis-conteneurs">
                                                <!-- Les données seront affichées ici -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer float-right">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

            <!-- FIN MODAL HISTORIQUES -->

        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
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
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
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
                title: `Êtes-vous sûr?`,
                text: "Si vous le supprimez, il disparaîtra pour toujours.",
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

{{-- SCRIPT DES DETAILS COLIS --}}
<script>
    $(document).ready(function() {
        $(".btn-show-details").click(function() {
            var colis_id = $(this).data("colis-id");
            console.log(colis_id);
            $.ajax({
                url: "/colis/Details_colis/" + colis_id,
                type: "GET",
                dataType: "json",
                success: function(colis) {
                    // Afficher les données dans les éléments HTML appropriés

                    // $("#status").html(colis.status);
                    var longueur = colis.longueur;
                    var largeur = colis.largeur;
                    var hauteur = colis.hauteur;

                    if (longueur == null) {
                        $('.long').css('display', 'none');
                    }
                    if (largeur == null) {
                        $('.larg').css('display', 'none');
                    }
                    if (hauteur == null) {
                        $('.haut').css('display', 'none');
                    }

                    $("#titre").html(colis.titre);
                    $("#largeur").html(colis.largeur);
                    $("#longueur").html(colis.longueur);
                    $("#hauteur").html(colis.hauteur);
                    $("#description").html(colis.description);
                    $("#poids").html(colis.poids);
                    $("#type").html(colis.type);
                    $("#prix").html(colis.prix);
                    // $("#prix_kilo").html(colis.prix_kilo);
                    // $("#conversion").html(colis.conversion);
                    // $("#prix_vol").html(colis.prix_vol);
                    $("#nom").html(colis.customer_full_name);
                    $("#email").html(colis.email);
                    $("#address").html(colis.address);
                    $("#phone").html(colis.phone);
                    $("#nomr").html(colis.customer_full_namer);
                    $("#emailr").html(colis.emailr);
                    $("#addressr").html(colis.addressr);
                    $("#phoner").html(colis.phoner);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        });
    });
</script>

{{-- SCRIPT MOUVEMENTS COLIS --}}
<script>
    $(document).ready(function() {
        $(".btn-show-historique").click(function() {
            var colis_id = $(this).data("colis-id");

            // Affichez l'indicateur de chargement
            $("#loading-indicator").show();
            $("#loading-indicator1").hide();

            // console.log(colis_id);
            $('#colis_infos').empty();
            $('#historique-colis-depart').empty();
            $('#historique-colis-arrive').empty();
            $('#historique-colis-conteneurs').empty();
            $.ajax({
                url: "/colis/mouvements_colis/" + colis_id,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    console.log('---------------------');
                    console.log(data);
                    // Cachez l'indicateur de chargement
                    $("#loading-indicator").hide();
                    $("#loading-indicator1").show();
                    console.log('---------------------');
                    var colis = data.colis;
                    var newRow = '<tr>';
                    newRow += '<td ">' + colis.type + '----' + '</td>';
                    newRow += '<td >' + colis.titre + ' ----' + '</td>';
                    newRow += '<td >' + ' code_zip: ' + colis.code_zip + '</td>';
                    newRow += '<td >   </td>';
                    newRow += '</tr>';
                    $('#colis_infos').append(newRow);



                    var historiques = data[0].historiques;
                    historiques.forEach(function(historique) {

                        var entrepotDepart = historique.entrepotDepart;
                        if (entrepotDepart) {
                            var newRow = '<tr>';
                            newRow += '<td class="table-cell">' + entrepotDepart.name + '</td>';
                            newRow += '<td class="table-cell">' + entrepotDepart.ville + '</td>';
                            newRow += '<td class="table-cell">' + historique.date_action.date_action + '</td>';
                            newRow += '</tr>';
                            $('#historique-colis-depart').append(newRow);
                        }
                    });


                    historiques.forEach(function(historique) {
                        var entrepotArrive = historique.entrepotArrive;
                        if (entrepotArrive) {
                            var newRow = '<tr>';
                            newRow += '<td "table-cell">' + (entrepotArrive ? entrepotArrive.name : 'En attente') + '</td>';
                            newRow += '<td "table-cell">' + (entrepotArrive ? entrepotArrive.ville : 'En attente') + '</td>';
                            newRow += '<td "table-cell">' + (entrepotArrive ? historique.date_action.date_action : 'En attente') + '</td>';
                            newRow += '</tr>';
                            $('#historique-colis-arrive').append(newRow);
                        }
                    });


                    var conteneurs = data[0].conteneurs;
                    conteneurs.forEach(function(conteneur) {

                        var newRow = '<tr>';
                        newRow += '<td "table-cell">' + conteneur.numero_id + '</td>';
                        newRow += '<td "table-cell">' + conteneur.name + '</td>';
                        newRow += '<td "table-cell">' + conteneur.pivot.status + '</td>';
                        newRow += '<td "table-cell">' + conteneur.pivot.date_action + '</td>';
                        newRow += '</tr>';
                        $('#historique-colis-conteneurs').append(newRow);
                    });

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        });
    });
</script>
@endsection