@extends('layouts.master')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3 class="m-0 font-weight-bold"> Gestions des Véhicule</h3>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Tableau Bord</a></li>
                        <li class="breadcrumb-item active">Véhicule</li>
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
                                    <i class="fa fa-plus-circle"></i> AJOUTER chauffeur
                                </a>
                                <a href="#" class="btn float-right btn-sm"
                                    style="background: #563DEA;color: #fff;margin-right: 50px;" data-toggle="modal"
                                    data-target="#modal-defaults">
                                    <i class="fa fa-plus-circle"></i> AJOUTER VEHICULE
                                </a>

                            </h3>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead style="text-transform: uppercase;">
                                        <tr>
                                        <th>Id</th>
                                            <th>Immatriculation</th>
                                            <th>Model</th>
                                            <th>Type</th>
                                            <th>Numéro Serie</th>
                                            <th>Statut</th>
                                            <th>Description</th>
                                            <th>Actions</th>


                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($vehicules as $vehicule)
                                        <tr>
                                        <td class="u_id" >{{ $vehicule->id }}</td>
                                            <td class="u_Immatriculation">{{ $vehicule->Immatriculation }}</td>
                                            <td  class="u_Model">{{ $vehicule->Model }}</td>
                                            <td  class="u_Type_Véhicule">{{ $vehicule->Type_Véhicule }}</td>
                                            <td  class="u_Numero_Serie">{{ $vehicule->Numero_Serie }}</td>
                                            <td  class="u_status">{{ $vehicule->status }}</td>
                                            <td  class="u_Description">{{ $vehicule->Description }}</td>
                                            <td>
                                                <div style="display: flex; align-items: center">
                                                    <a href="#" title="edit"
                                                        class="btn btn-sm btn-primary mr-1 update_user"  data-toggle="modal" data-target="#update_user">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    {{-- <a href="#" title="delete" id="delete"
                                                        class="btn btn-sm btn-danger">
                                                        <i class="fa fa-trash"></i>
                                                    </a> --}}
                                                    <form method="POST"
                                                        action="{{route('vehicule.delete',$vehicule->id)}}">
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
                                        <th>Id</th>
                                            <th>Immatriculation</th>
                                            <th>Model</th>
                                            <th>Type</th>
                                            <th>Numéro Serie</th>
                                            <th>Statut</th>
                                            <th>Description</th>
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

<!-- /.ajouter vehicule ajouter vehiculeajouter vehiculeajouter vehiculeajouter vehiculeajouter vehiculeajouter vehicule
-->
<div class="modal fade" id="modal-defaults">
    <div class="modal-dialog">
        <form action="{{route('vehicule.index.store')}}" method="post">
            @csrf
            <div class="modal-content " style="width: 800px ">
                <div class="modal-header">
                    <h4 class="modal-title">Ajout D'un Véhicule</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel"
                        aria-labelledby="custom-tabs-one-home-tab">

                        <div class="col-sm-12 w-100">

                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Immatriculation Du Véhicule :</label>
                                        <input type="text" class="form-control" style="text-transform: uppercase;"
                                            placeholder="Ex : rtydv4742 " name="Immatriculation" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Model Du Véhicule :</label>
                                        <input type="text" class="form-control" style="text-transform: uppercase;"
                                            placeholder="  Ex : Toyota " name="Model" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Type Du Véhicule :</label>
                                        <input type="text" class="form-control" style="text-transform: uppercase;"
                                            placeholder="Ex : Caterpillar" name="Type_Véhicule" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Numero Serie Du Véhicule :</label>
                                        <input type="text" class="form-control" style="text-transform: uppercase;"
                                            placeholder="Ex : ngt0452jt" name="Numero_Serie" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 ">

                                    <label>Statut Du Véhicule:</label>
                                    <select class="form-control select2 select2-danger form-control-md"
                                        data-dropdown-css-class="select2-gray" id="country_id" name="status" required>
                                        <option value="">Selectionner un statut</option>

                                        <option>EN FONCTIONNEMENT </option>
                                        <option>EN DÉPANNAGE </option>


                                    </select>

                                </div>
                                <div class="col-sm-12 mt-3">

                                    <label>Description Du Véhicule :</label>
                                    <textarea name="Description" id="" class="form-control"
                                        placeholder="Ex : véhicule adapté au trajets longs  " required>

                                </textarea>


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
<!-- /end .ajouter vehicule ajouter vehiculeajouter vehiculeajouter vehiculeajouter vehiculeajouter vehiculeajouter vehicule
-->
 <!-- /update_vehicule update_vehiculeupdate_vehiculeupdate_vehicule update_vehicule update_vehicule -->
<div class="modal fade" id="update_user">
    <div class="modal-dialog">
        <form action="{{ route('vehicule.update') }}" method="post">
            @csrf
            <div class="modal-content " style="width: 800px ">
                <div class="modal-header">
                    <h4 class="modal-title">Modifier un Véhicule</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel"
                        aria-labelledby="custom-tabs-one-home-tab">

                        <div class="col-sm-12 w-100">

                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <input type="hidden" name="id" id="id">
                                        <label>Immatriculation Du Véhicule :</label>
                                        <input type="text" class="form-control" style="text-transform: uppercase;"
                                            placeholder="Ex : rtydv4742 " name="Immatriculation" required id="Immatriculation"
                                                >
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Model Du Véhicule :</label>
                                        <input type="text" class="form-control" style="text-transform: uppercase;"
                                            placeholder="  Ex : Toyota " name="Model" required
                                                 required id="Model">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Type Du Véhicule :</label>
                                        <input type="text" class="form-control" style="text-transform: uppercase;"
                                            placeholder="Ex : Caterpillar"name="Type_Véhicule" required
                                            id="Type_Véhicule"  >
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Numero Serie Du Véhicule :</label>
                                        <input type="text" class="form-control" style="text-transform: uppercase;"
                                            placeholder="Ex : ngt0452jt" name="Numero_Serie" required
                                            id="Numero_Serie" >
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 ">

                                    <label>Statut Du Véhicule:</label>
                                    <select class="form-control select2 select2-danger form-control-md"
                                        data-dropdown-css-class="select2-gray" id="status" name="status"
                                        required>
                                        <option >
                                            
                                        </option>

                                        <option >EN FONCTIONNEMENT </option>
                                        <option >EN DÉPANNAGE </option>


                                        </select>

                                </div>
                                <div class="col-sm-12 mt-3">

                                    <label>Description Du Véhicule :</label>
                                    <textarea name="Description" id="Description" class="form-control"
                                        placeholder="Ex : véhicule adapté au trajets longs  " required>

                                </textarea>


                                </div>
                            </div>


                        </div>


                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Modifier</button>
                </div>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /end update_vehicule update_vehiculeupdate_vehiculeupdate_vehicule update_vehicule update_vehicule -->
 <!-- /.chauffeur  chauffeur chauffeur chauffeur chauffeur chauffeur chauffeur chauffeur chauffeur chauffeur chauffeur -->
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <form action="{{ route('vehicule.chauffeur') }}" method="post">
            @csrf
            <div class="modal-content " style="width: 800px ">
                <div class="modal-header">
                    <h4 class="modal-title">Ajouter un Chauffeur</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel"
                        aria-labelledby="custom-tabs-one-home-tab">

                        <div class="col-sm-12 w-100">

                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Nom :</label>
                                        <input type="text" class="form-control" style="text-transform: uppercase;"
                                            name="nom" required id="">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Prénom :</label>
                                        <input type="text" class="form-control" style="text-transform: uppercase;"
                                            name="prenom" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Email :</label>
                                        <input type="text" class="form-control" style="text-transform: uppercase;"
                                            name="email" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" class="form-control" style="text-transform: uppercase;"
                                            name="address" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 ">
                                    <label>Téléphone</label>
                                    <input type="number" class="form-control" style="text-transform: uppercase;"
                                        name="phone" required>
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

@endsection
@section('scripts')
<!-- Page specific script -->
<script>
        $(document).on('click','.update_user',function()
        {
            var _this = $(this).parents('tr');
            $('#id').val(_this.find('.u_id').text());
            $('#Immatriculation').val(_this.find('.u_Immatriculation').text());
            $('#Model').val(_this.find('.u_Model').text());
            $('#Type_Véhicule').val(_this.find('.u_Type_Véhicule').text());
            $('#Numero_Serie').val(_this.find('.u_Numero_Serie').text());
            $('#status').val(_this.find('.u_status').text());
            $('#Description').val(_this.find('.u_Description').text());
            
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