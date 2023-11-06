@extends('layouts.master')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3 class="m-0 font-weight-bold"> Dechargement Conteneur</h3>
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
                            <h3> Listes des Colis a Dechargés
                            
                            </h3>

                        </div>
                        <div class="card-header">
                            <h4 class="text-center">
                                {{ strtoupper($conteneur->name) }} - № :({{ strtoupper($conteneur->numero_id) }})
                            </h4>

                        

                        </div>
                        <div class="card-body" style="margin-top: -20px;">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form id="myForm" method="POST" action="{{ route('unitsColisDecharge.update', $conteneur) }}">
                                    @csrf
                                    @method('POST') 
                                    <div class="form-group" style="margin-bottom: 30px;">
                                            <button type="button" class="btn btn-primary" id="select-all">Sélectionner
                                                tous les colis</button>
                                            <button type="button" class="btn btn-secondary"
                                                id="deselect-all">Désélectionner tous les colis</button>
                                            <div class="float-end ">
                                                <div class="">
                                                    
                                                    <!-- <label for="entrepot_id"> Entrepot de Dechargement :</label> -->
                                                    <select name="entrepot_id"
                                                        class="form-control select2 select2-cyan"
                                                        data-dropdown-css-class="select2-cyan" id="entrepot_id">
                                                        <option value="">Selectionner Entrepot </option>
                                                        @foreach ($entrepots as $entrepot )
                                                        <option value="{{ $entrepot->id }}">{{ $entrepot->name }}-({{
                                                            $entrepot->address
                                                            }} - {{ $entrepot->ville }})
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    <span class="error-message"></span>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    <table id="example1" class="table table-bordered table-striped">

                                        
                                        <thead style="margin-top: -10px">
                                            <tr>
                                                <th style="width: 15px">Case </th>
                                                <th>Titre Colis</th>
                                                <th>Nom de l'Expediteur</th>
                                                <th>Date</th>
                                                <th>Code Colis</th>
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
                                                            value="{{ $ul->id }}">
                                                    </div>
                                                </td>
                                                <td>{{ strtoupper($ul->titre)}}</td>
                                                <td>{{ strtoupper( $ul->invoice->payement->customer->nom)}}</td>

                                                <td>{{ date('d-M-Y',strtotime($ul->invoice->date)) }}</td>
                                                {{-- <td>{{ number_format($ul->prix ,0,' ',',')}} FCFA</td> --}}
                                                <td>Code_zip № : {{$ul->code_zip}} </td>
                                                <td>
                                                    @if ($ul->charge == 1)
                                                    <span class="badge"
                                                        style="background: #2962FF;color:white; padding: 3px;">
                                                        <i class="fas fa-truck-moving"></i> Chargé</span>
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
                                                <th>Code Colis</th>
                                                <th>Etat Chargement</th>
                                                                                           
                                                <th>Actions</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <div class="text-center">

                                        <button type="submit" class="btn btn-primary">Decharger Le Conteneur</button>
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

<script>
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()
    })
    //Initialize Select2 Elements
   
</script>

<!-- VALIDATION -->
<script type="text/javascript">
    $(document).ready(function() {
    $('#myForm').validate({
        rules: {
            entrepot_id: {
                required: true,
            },
        },
        messages: {
            entrepot_id: "Veuillez sélectionner un Entrepot.",
        },
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            error.appendTo(element.closest('.form-group').find('.error-message'));
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    })
});
</script>

@endsection