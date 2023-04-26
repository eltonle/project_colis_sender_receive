@extends('layouts.master')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3 class="m-0 font-weight-bold"> Chargement Conteneur</h3>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Tableau de Bord</a></li>
                        <li class="breadcrumb-item active">Conteneurs</li>
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
                        <div class="card-header text-center">
                            <h3> Listes des Colis a Charges
                                {{-- <a href="{{ route('units.create') }}" class="btn  float-right btn-sm"
                                    style="background: #563DEA;color: #fff">
                                    <i class="fa fa-plus-circle"></i> AJOUTER UN CONTENEUR
                                </a> --}}
                            </h3>

                        </div>
                        <div class="card-header">
                            <h4 class="text-center mb-3">
                                {{ strtoupper($unit->name) }} - № :({{ strtoupper($unit->numero_id) }}) && statut: ({{
                                strtoupper($unit->statut) }})
                            </h4>

                           @if ($unit->statut !== 'Non Charge')                                                         
                            <div class="float-right">
                                <form id="form-modifier-statut" method="POST">
                                    @csrf
                                    <input type="hidden" name="conteneur_id" value="{{ $unit->id }}">
                                    <input id="btn-modifier-statut" class="btn btn-danger" type="submit" value="Fermer le Conteneur (fin de Chargement)">
                                  </form>
                            </div>
                            @endif

                        </div>
                        <div class="card-body" style="margin-top: -20px;">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form method="POST" action="{{ route('unitsColis.update', $unit) }}">
                                    @csrf
                                    @method('POST')
                                    <table id="example1" class="table table-bordered table-striped">

                                        <div class="form-group">
                                            <button type="button" class="btn btn-primary" id="select-all">Sélectionner
                                                tous les colis</button>
                                            <button type="button" class="btn btn-secondary"
                                                id="deselect-all">Désélectionner tous les colis</button>
                                            <div class="float-end"> 
                                                {{-- <form id="form-modifier-statut" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="conteneur_id" value="{{ $unit->id }}">
                                                    <button id="btn-modifier-statut" class="btn btn-danger" type="submit">Modifier le statut</button>
                                                  </form> --}}
                                                {{-- <button id="btn-changer-statut" data-conteneur-id="{{ $conteneur->id }}">Changer le statut</button>                                              --}}
                                                {{-- <button id="btn-changer-statut" data-conteneur-id="{{ $unit->id }}" class="btn btn-info"> <i class="fas fa-times text-danger"></i> Fermer le Conteneur</button> --}}
                                            </div>
                                        </div>
                                        <thead style="margin-top: -30px">
                                            <tr>
                                                <th style="width: 15px">Case </th>
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
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="colis-{{ $ul->id }}" name="colis[]"
                                                            value="{{ $ul->id }}" @if ($ul->unit_id == $unit->id)
                                                        checked @endif>
                                                    </div>
                                                </td>
                                                <td>{{ strtoupper($ul->titre)}}</td>
                                                <td>{{ strtoupper( $ul->invoice->payement->customer->nom)}}</td>

                                                <td>{{ date('d-M-Y',strtotime($ul->invoice->date)) }}</td>
                                                <td>{{ number_format($ul->prix ,0,' ',',')}} FCFA</td>
                                                <td>
                                                    @if ($ul->charge == 1)
                                                    <span class="badge"
                                                        style="background: #2962FF;color:white; padding: 3px;">
                                                        <i class="fa fa-ship"></i> Charge</span>
                                                    @else 
                                                    <span class="badge"
                                                        style="background:  #B61418; color:white; padding: 3px;">
                                                        <i class="fas fa-times"></i> Non Chargé</span>                                                                                                       
                                                    @endif
                                                </td>

                                              
                                                <td>
                                                    hello
                                                </td>

                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th style="width: 15px">Case </th>
                                                <th>Titre Colis</th>
                                                <th>Nom de l'Expediteur</th>
                                                <th>Date</th>
                                                <th>Montant Colis</th>
                                                <th>Etat Chargement</th>
                                                                                           
                                                <th>Actions</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    @if ($unit->statut == 'Ferme')
                                    <div class="text-center bg-indigo">

                                       <p><strong>Le Conteneur est fermé vous ne pouvez par effectuer de Chargement</strong></p>
                                    </div>
                                    @else
                                    <div class="text-center">

                                        <button type="submit" class="btn btn-primary">Charger Le Conteneur</button>
                                    </div>
                                    @endif
                                   
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
<!-- Page specific script -->
<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
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
         var form =  $(this).closest("form");
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


<script>
    $(document).ready(function() {
    $('#form-modifier-statut').submit(function(event) {
      event.preventDefault();
      var conteneurId = $('input[name="conteneur_id"]').val();
      
      $.ajax({
        type: 'POST',
        // url: '{{ route("conteneurs.modifierStatut", $unit->id) }}',
        url: '/units/conteneurs/' + conteneurId + '/modifier-statut',
        data: {
          _token: '{{ csrf_token() }}',
          conteneur_id: conteneurId
        },
        success: function(data) {
          if (data.success) {
            location.reload();
          } else {
            // Il y a eu une erreur lors de la mise à jour du statut du conteneur
          }
        },
        error: function() {
          // Il y a eu une erreur lors de l'envoi de la requête AJAX
        }
          });
      });
      });
  
</script>


{{-- BOUTON SELECTIONNE ET DESELECTIONNE --}}
<script>
    $(document).ready(function() {
        $('#select-all').click(function() {
            $('input[type="checkbox"]').prop('checked', true);
            $('button[type="submit"]').prop('disabled', false);
        });

        $('#deselect-all').click(function() {
            $('input[type="checkbox"]').prop('checked', false);
            $('button[type="submit"]').prop('disabled', true);
        });
    });

    $(document).ready(function() {
    // Désactiver le bouton d'ajout de colis
    $('button[type="submit"]').prop('disabled', true);

    // Activer le bouton d'ajout de colis dès qu'une case est cochée
    $('input[type="checkbox"]').click(function() {
        if ($('input[type="checkbox"]:checked').length > 0) {
            $('button[type="submit"]').prop('disabled', false);
        } else {
            $('button[type="submit"]').prop('disabled', true);
        }
        });
    });
</script>



@endsection