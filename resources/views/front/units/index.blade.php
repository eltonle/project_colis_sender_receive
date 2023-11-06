@extends('layouts.master')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3 class="m-0 font-weight-bold"> Gestions des Conteneurs</h3>
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
                        <div class="card-header">
                            <h3> Lists des Conteneurs
                                <a href="{{ route('units.create') }}" class="btn  float-right btn-sm"
                                    style="background: #563DEA;color: #fff">
                                    <i class="fa fa-plus-circle"></i> AJOUTER UN CONTENEUR
                                </a>
                            </h3>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead style="text-transform: uppercase;">
                                        <tr>

                                            <th>Numero du Conteneur</th>
                                            <th>Nom du Conteneur</th>
                                            <th>Date Chargement</th>
                                            <th>statut</th>
                                            <th>Change Status</th>

                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($units as $unit)
                                        <tr>

                                            <td>{{ $unit->numero_id }}</td>
                                            <td>{{ $unit->name }}</td>
                                            <td>{{ date('d-M-Y',strtotime($unit->date_chargement )) }} </td>
                                            <td>
                                                <span
                                                    class="badge {{ $unit->statut == 'Charge' ? 'bg-info' : 
                                                                    ($unit->statut == 'En cours de Chargement' ? 'bg-primary' :                                                                     
                                                                    ($unit->statut == 'Arrive' ? 'bg-success' : 
                                                                    ($unit->statut == 'Livre' ? 'bg-success' : 
                                                                    ($unit->statut == 'En cours de Dechargement' ? 'bg-danger' : 
                                                                    ($unit->statut == 'Decharge' ? 'bg-secondary' : 'bg-dark'))))) }}">

                                                    {{ $unit->statut }}
                                                </span> 
                                            </td>
                                            <td>
                                                <form class="container-form" data-unit-id="{{ $unit->id }}" method="POST">
                                                    @csrf                                                   
                                                    <input type="hidden" name="unit_id" value="{{ $unit->id }}">
                                                    <select name="status"
                                                        class=" select2 select2-danger form-control-sm"
                                                        data-dropdown-css-class="select2-danger" id="">
                                                        <option value="">selectionner un status</option>
                                                        <option value="Charge">charge</option>
                                                        <option value="Non Charge">non charge</option>
                                                        <option value="En cours de Chargement">en cours de chargement</option>                                                       
                                                        <option value="Arrive">arrive</option>                                                        
                                                        <option value="En cours de Dechargement">en cours de dechargement</option>
                                                        <option value="Decharge">decharge</option>
                                                    </select>
                                                  </form>
                                             </td>
                                            
                                            <td>



                                                <div class="btn-group">
                                                    
                                                    <button type="button" style="background: #43BD00"
                                                        class="btn  btn-flat btn-sm dropdown-toggle dropdown-icon"
                                                        data-toggle="dropdown">
                                                        <span class=""
                                                            style="background: #43BD00; color: white; padding: 2px">Actions</span>
                                                    </button>
                                                    <div class="dropdown-menu" role="menu">
                                                        @if(!count($unit->colis))                                                      
                                                            <a href="{{  route('units.edit',$unit->id) }}"
                                                                title="editer le conteneur" class="dropdown-item"><span
                                                                    class="text-xs text-dark font-weight-bold"><i
                                                                        class="fa fa-edit"></i> Editer le conteneur</span>

                                                            </a>
                                                        @endif
                                                        @if (count($unit->colis)>0) 
                                                        <a href="{{  route('units.showColis',$unit->id) }}"
                                                            title="Voir les Colis du Conteneur" class="dropdown-item"><span
                                                                class="text-xs text-dark font-weight-bold"><i
                                                                    class="fa fa-eye"></i> Voir les Colis du Conteneur</span>

                                                        </a>
                                                        @endif
                                                        <a href="{{ route('units.show', ['unit' => $unit->id]) }}"
                                                            title="charge le conteneur" class="dropdown-item"><span
                                                                class="text-xs text-dark font-weight-bold"><i
                                                                    class="fas fa-truck-moving"></i> Charger le
                                                                conteneur</span>

                                                        </a>
                                                        <a href="{{ route('units.showScan', ['unit' => $unit->id]) }}"
                                                            title="charge le conteneur" class="dropdown-item"><span
                                                                class="text-xs text-dark font-weight-bold"><i
                                                                    class="fas fa-truck-moving"></i> Charger par code
                                                                barre</span>

                                                        </a>
                                                        @if (count($unit->colis)>0) 
                                                        <a href="{{ route('units.showDecharge',  $unit->id) }}"
                                                            title="decharge le conteneur" class="dropdown-item "><span
                                                                style="background: #a5c29f; "
                                                                class="text-xs text-dark font-weight-bold"><i
                                                                    class="fas fa-truck-moving"></i> Decharger le
                                                                Conteneur</span>

                                                        </a>
                                                        @endif
                                                        @if (count($unit->colis)>0) 
                                                        <a href="{{ route('units.showDechargeScan',  $unit->id) }}"
                                                            title="decharge le conteneur" class="dropdown-item "><span
                                                                style="background: #a5c29f; "
                                                                class="text-xs text-dark font-weight-bold"><i
                                                                    class="fas fa-truck-moving"></i> Decharger par code barre</span>

                                                        </a>
                                                         @endif
                                                      
                                                        @if (!count($unit->colis))                                                                                                                  
                                                            <div class="dropdown-item">


                                                                <form method="POST"
                                                                    action="{{  route('units.delete', $unit->id) }}">
                                                                    @csrf
                                                                    <input name="_method" type="hidden" value="DELETE">
                                                                    <button type="submit" class="border-0 show_confirm"
                                                                        style="margin-left: -5px" data-toggle="tooltip"
                                                                        title='Supprimer'> <span
                                                                            class="text-xs text-dark font-weight-bold"><i
                                                                                class="fa fa-trash"></i> Supprimer
                                                                            le Conteneur</span></button>
                                                                </form>
                                                            </div>
                                                        @endif
                                                      
                                                    </div>
                                                </div>


                                            </td>

                                        </tr>
                                        @endforeach


                                    </tbody>
                                    <tfoot style="text-transform: uppercase;">
                                        <tr>

                                            <th>Numero du Conteneur</th>
                                            <th>Nom du Conteneur</th>
                                            <th>Date Chargement</th>
                                            <th>statut</th>
                                            <th>Change status</th>

                                            <th>Actions</th>
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
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
@section('scripts')
    <script>
        $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()
        })
        //Initialize Select2 Elements
    
    </script>
   <!-- Page specific script -->
    <script>
        $(function () {
        $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
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


    <script >
     $(document).ready(function() {
        $('.container-form select').change(function() {            

            var form = $(this).closest('form');
              var data = form.serialize();
           
            $.ajax({
            type: 'POST',
            url: "{{ route('units.updateUnitStatus') }}",
            data: data,
            success: function(response) {
                location.reload();
                console.log(response); // Afficher la réponse JSON dans la console du navigateur
            },
            error: function(xhr) {
                console.log(xhr.responseText); // Afficher l'erreur dans la console du navigateur
            }
            });
        });
        });

    </script>

@endsection