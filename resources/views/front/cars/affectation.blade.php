@extends('layouts.master')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3 class="m-0 font-weight-bold"> Affectation Véhicule</h3>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Tableau Bord</a></li>
                        <li class="breadcrumb-item active">Affectation</li>
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
                            <h3> Listes des Véhicule
                                <a href="#" class="btn float-right btn-sm"
                                    style="background: #563DEA;color: #fff;text-transform: uppercase;"
                                    data-toggle="modal" data-target="#modal-default">
                                    <i class="fa fa-plus-circle"></i> Affectation chauffeur
                                </a>


                            </h3>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead style="text-transform: uppercase;">
                                        <tr>
                                            <th>Immatriculation</th>
                                            <th>Chauffeur</th>

                                            <th>Date d'affectation</th>
                                            <th>Durée du contrat </th>
                                            <th>Actions</th>


                                        </tr>
                                    </thead>
                                    <tbody>

                                        
                                    @foreach ($affectations as $key => $affectation)
                                    
                                    <tr>
                                    <td  class="u_id">{{ $affectation->id}}</td>
                                        <td  class="u_vehicule">{{ $affectation->vehicule ->Immatriculation}}</td>
                                        <td  class="u_chauffeur">{{ $affectation->chauffeur->nom }}</td>
                                            <td  class="u_dateDebut">{{ $affectation->dateDebut }}</td>
                                            <td  class="u_dateFin">{{ $affectation->dateFin }}</td>
                                            <td>
                                                <div style="display: flex; align-items: center">
                                                    <a href="#" title="edit"
                                                        class="btn btn-sm btn-primary mr-1 modal-defaults"  data-toggle="modal" data-target="#modal-defaults">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    {{-- <a href="#" title="delete" id="delete"
                                                        class="btn btn-sm btn-danger">
                                                        <i class="fa fa-trash"></i>
                                                    </a> --}}
                                                    <form method="POST"
                                                        action="{{route('delete_affection',$affectation->id)}}">
                                                        @csrf
                                                        <input name="_method" type="hidden" value="DELETE">
                                                        <button type="submit"
                                                            class="btn btn-sm rounded btn-danger btn-flat show_confirm"
                                                            data-toggle="tooltip" title='Delete'><i
                                                                class="fa fa-trash"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>

                                        
                                        @endforeach

                                    </tbody>
                                    <tfoot class="" style="text-transform: uppercase;">
                                        <tr>
                                            <th>Immatriculation</th>
                                            <th>Chauffeur</th>

                                            <th>Date d'affectation</th>
                                            <th>Durée du contrat </th>
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

<!-- /affectation affectation affectation affectationaffectation affectation affectation affectation affectation affectation-->
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <form action="{{route('add_affectation')}}" method="post">
            @csrf
            <div class="modal-content ">
                <div class="modal-header">
                    <h4 class="modal-title">Ajout D'une Affectation</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel"
                        aria-labelledby="custom-tabs-one-home-tab">




                        <!-- col1 -->

                        <div class="col-sm-12 w-100">
                            <div class="row">
                                <div class="col-sm-12 ">

                                    <label>Chauffeur :</label>
                                    <select class="form-control select2 select2-danger form-control-md"
                                        data-dropdown-css-class="select2-gray" id="country_id" name="chauffeur_id">
                                        <option value="">Selectionner un Chauffeur </option>
                                        @foreach ($chauffeurs as $chauffeur)
                                                <option value="{{ $chauffeur->id }}">
                                                    {{$chauffeur->nom }}, {{$chauffeur->prenom }} {{$chauffeur->phone}}
                                                </option>
                                                @endforeach

                                    </select>


                                </div>
                                <div class="col-sm-12 mt-3">

                                    <label>Véhicule :</label>
                                    <select class="form-control select2 select2-danger form-control-md"
                                        data-dropdown-css-class="select2-gray" id="country_id" name="vehicule_id">
                                        @foreach ($vehicules as $vehicule)
                                                <option value="{{ $vehicule->id }}">
                                                    {{$vehicule->Immatriculation }}
                                                </option>
                                                @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row  mt-3">
                                <div class="col-sm-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Date Affectation :</label>
                                        <input type="date" class="form-control" style="text-transform: uppercase;"
                                           name="dateDebut">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label> Date Fin Affectation:</label>
                                        <input type="date" class="form-control" style="text-transform: uppercase;"
                                        name="dateFin">
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </div>
                </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /affectation affectation affectation affectationaffectation affectation affectation affectation affectation affectation-->
<div class="modal fade" id="modal-defaults">
    <div class="modal-dialog">
        <form action="{{ route('affectation.update') }}" method="post">
            @csrf
            <div class="modal-content ">
                <div class="modal-header">
                    <h4 class="modal-title">modifier une Affectation</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel"
                        aria-labelledby="custom-tabs-one-home-tab">




                        <!-- col1 -->

                        <div class="col-sm-12 w-100">
                            <div class="row">
                                <div class="col-sm-12 ">
                                <input type="text" name="id" id="id">
                                    <label>Chauffeur :</label>
                                    <select class="form-control select2 select2-danger form-control-md"
                                        data-dropdown-css-class="select2-gray" id="chauffeur" name="chauffeur_id">
                                        <option value="">Selectionner un Chauffeur </option>
                                        @foreach ($chauffeurs as $chauffeur)
                                                <option value="{{ $chauffeur->id }}">
                                                    {{$chauffeur->nom }}, {{$chauffeur->prenom }} {{$chauffeur->phone}}
                                                </option>
                                                @endforeach

                                    </select>


                                </div>
                                <div class="col-sm-12 mt-3">

                                    <label>Véhicule :</label>
                                    <select class="form-control select2 select2-danger form-control-md"
                                        data-dropdown-css-class="select2-gray" id="vihicule" name="vehicule_id">
                                        @foreach ($vehicules as $vehicule)
                                                <option value="{{ $vehicule->id }}">
                                                    {{$vehicule->Immatriculation }}
                                                </option>
                                                @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row  mt-3">
                                <div class="col-sm-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Date Affectation :</label>
                                        <input type="date" class="form-control"  id="dateDate" style="text-transform: uppercase;"
                                           name="dateDebut">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label> Date Fin Affectation:</label>
                                        <input type="date" class="form-control" id="dateFin" style="text-transform: uppercase;"
                                        name="dateFin">
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </div>
                </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal-dialog -->
</div>
@endsection
@section('scripts')
<!-- Page specific script -->
<script>
        $(document).on('click','.modal-defaults',function()
        {
            var _this = $(this).parents('tr');
            $('#id').val(_this.find('.u_id').text());
            $('#chauffeur').val(_this.find('.u_chauffeur').text());
            $('#vehicule').val(_this.find('.u_vehicule').text());
            $('#dateDebut').val(_this.find('.u_dateDebut').text());
            $('#dateFin').val(_this.find('.u_dateFin').text());
            
            
        });
    </script>
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
@endsection