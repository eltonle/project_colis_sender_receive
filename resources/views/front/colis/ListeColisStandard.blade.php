@extends('layouts.master')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3 class="m-0 font-weight-bold"> Gestions des Colis Standards</h3>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Tableau de Bord</a></li>
                        <li class="breadcrumb-item active">Colis Standard</li>
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
                            <h3> Listes Colis Type Normal
                                <a href="{{ route('colis.createStandard') }}" class="btn  float-right btn-sm"
                                    style="background: #563DEA;color: #fff">
                                    <i class="fa fa-plus-circle"></i> AJOUTER UN COLIS STANDARD
                                </a>
                            </h3>
                        </div><!-- /.card-header -->
                        <div class="card-body">


                            <!-- Default box -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Liste des colis Enregistrés</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                            title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Titre </th>
                                                <th>Prix </th>
                                                <th>Longueur (m)</th>
                                                <th>Largeur (m)</th>
                                                <th>Hauteur (m)</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($colisStandard as $unit)
                                            <tr>
                                                <td> {{ strtoupper($unit->titre) }}</td>
                                                <td> {{ number_format($unit->prix,0,' ',',')}} FCFA</td>
                                                <td>{{ $unit->longueuer ? $unit->longueuer . ' m' : '0' }} </td>
                                                <td>{{ $unit->largeur ? $unit->largeur . ' m' : '0' }}</td>
                                                <td>{{ $unit->hauteur ? $unit->hauteur . ' m' : '0' }}</td>
                                                <td>
                                                    <div style="display: flex; align-items: center">


                                                        <a href="{{ route('colis.editStandard',$unit->id) }}"
                                                            title="edit" class="btn btn-sm btn-primary mr-1">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        {{-- <a href="#" title="delete" id="delete"
                                                            class="btn btn-sm btn-danger">
                                                            <i class="fa fa-trash"></i>
                                                        </a> --}}
                                                        <form method="POST"
                                                            action="{{ route('colis.deleteStandard', $unit->id) }}">
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
                                        <tfoot>
                                            <tr>
                                                <th>Titre </th>
                                                <th>Prix </th>
                                                <th>Longueur (m)</th>
                                                <th>Largeur (m)</th>
                                                <th>Hauteur (m)</th>
                                                <th>Actions</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer text-center">Fin Listes Colis Standards Normal</div>
                                <!-- /.card-footer-->
                            </div>
                        </div>
                    </div>
                </section>

                <section class="col-md-12">
                    {{-- custom tabs --}}
                    <div class="card">
                        <div class="card-header">
                            <h3> Listes Colis Type Voiture
                                <a href="{{ route('colis.createStandardVoiture') }}" class="btn  float-right btn-sm"
                                    style="background: #563DEA;color: #fff">
                                    <i class="fa fa-plus-circle"></i> AJOUTER UN COLIS STANDARD
                                </a>
                            </h3>
                        </div><!-- /.card-header -->
                        <div class="card-body">


                            <!-- Default box -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Liste des colis Enregistrés</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                            title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Titre </th>
                                                <th>Prix </th>
                                                <th>Type</th>
                                                <th>Capacite</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($colisStandardVoiture as $unit)
                                            <tr>
                                                <td> {{ strtoupper($unit->titre) }}</td>
                                                <td> {{ number_format($unit->prix,0,' ',',')}} FCFA</td>
                                                <td>{{ $unit->type }} </td>
                                                <td>{{ $unit->capacite }} </td>
                                                <td>
                                                    <div style="display: flex; align-items: center">


                                                        <a href="{{ route('colis.editStandardVoiture',$unit->id) }}"
                                                            title="edit" class="btn btn-sm btn-primary mr-1">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                      
                                                        <form method="POST"
                                                            action="{{ route('colis.deleteStandard', $unit->id) }}">
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
                                        <tfoot>
                                            <tr>
                                                <th>Titre </th>
                                                <th>Prix </th>
                                                <th>Type</th>
                                                <th>Capacite</th>
                                                <th>Actions</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer text-center">Fin Listes Colis Standards Normal</div>
                                <!-- /.card-footer-->
                            </div>
                        </div>
                    </div>
                </section>


                <section class="col-md-12">
                    {{-- custom tabs --}}
                    <div class="card">
                        <div class="card-header">
                            <h3> Lists Colis Type Camion
                                <a href="{{ route('colis.createStandardCamion') }}" class="btn  float-right btn-sm"
                                    style="background: #563DEA;color: #fff">
                                    <i class="fa fa-plus-circle"></i> AJOUTER UN COLIS STANDARD
                                </a>
                            </h3>
                        </div><!-- /.card-header -->
                        <div class="card-body">


                            <!-- Default box -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Liste des colis Enregistrés</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                            title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Titre </th>
                                                <th>Prix </th>
                                                <th>Type</th>
                                                <th>Longueur (m)</th>
                                                <th>Capacite</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($colisStandardCamion as $unit)
                                            <tr>
                                                <td> {{ strtoupper($unit->titre) }}</td>
                                                <td> {{ number_format($unit->prix,0,' ',',')}} FCFA</td>
                                                <td>{{ $unit->type }} </td>
                                                <td>{{ $unit->longueur ? $unit->longueur . ' m' : '0' }} </td>
                                                <td>{{ $unit->capacite }} </td>
                                                <td>
                                                    <div style="display: flex; align-items: center">


                                                        <a href="{{ route('colis.editStandardCamion',$unit->id) }}"
                                                            title="edit" class="btn btn-sm btn-primary mr-1">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                       
                                                        <form method="POST"
                                                            action="{{ route('colis.deleteStandard', $unit->id) }}">
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
                                        <tfoot>
                                            <tr>
                                                <th>Titre </th>
                                                <th>Prix </th>
                                                <th>Type</th>
                                                <th>Longueur (m)</th>
                                                <th>Capacite</th>
                                                <th>Actions</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer text-center">Fin Listes Colis Standards Normal</div>
                                <!-- /.card-footer-->
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
@endsection