@extends('layouts.master')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3 class="m-0 font-weight-bold">Gestion des Villes</h3>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Tableau de Bord</a></li>
                        <li class="breadcrumb-item active">Villes</li>
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
                            <h3> Listes des Villes
                                <a href="{{ route('states.create') }}" class="btn btn-success float-right btn-sm">
                                    <i class="fa fa-plus-circle"></i> AJOUTER UNE VILLE
                                </a>
                            </h3>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Pays</th>
                                            <th>Villes</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($states as $state)
                                        <tr>
                                            <td>{{ $state['country']['name'] }}</td>
                                            <td>{{ $state->name }}</td>
                                            <td>
                                                <div style="display: flex; align-items: center">


                                                    <a href="{{ route('states.edit',$state->id) }}" title="edit"
                                                        class="btn btn-sm btn-primary mr-1">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    {{-- <a href="#" title="delete" id="delete"
                                                        class="btn btn-sm btn-danger">
                                                        <i class="fa fa-trash"></i>
                                                    </a> --}}
                                                    <form method="POST"
                                                        action="{{ route('states.delete', $state->id) }}">
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
                                            <th>Pays</th>
                                            <th>Villes</th>
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