@extends('layouts.master')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3 class="m-0 font-weight-bold"> Gestions des Entrepôts</h3>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Tableau de Bord</a></li>
                        <li class="breadcrumb-item active">Entrepôt</li>
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
                            <h3> Lists des Entrepôts
                                <a href="{{ route('entrepots.create') }}" class="btn  float-right btn-sm"
                                    style="background: #563DEA;color: #fff">
                                    <i class="fa fa-plus-circle"></i> AJOUTER UN ENTREPOT
                                </a>
                            </h3>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead >
                                        <tr>
                                     
                                            <th>Name</th>
                                            <th>Addresse</th>
                                            <th>Ville</th>
                                            
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($listes as $entrepot)
                                        <tr>
                                       
                                            <td>{{ strtoupper($entrepot->name)  }}</td>
                                            <td>{{ strtoupper($entrepot->address)  }}</td>
                                            <td>{{ strtoupper($entrepot->ville)  }}</td>
                                                                                    
                                            <td>
                                            <div class="btn-group" >
                                                {{-- <button type="button" class="btn btn-default">Action</button>
                                                --}}
                                                <button type="button" style="background: #43BD00"
                                                    class="btn  btn-flat btn-sm dropdown-toggle dropdown-icon"
                                                    data-toggle="dropdown">
                                                    <span class=""
                                                        style="background: #43BD00; color: white; padding: 2px">Actions</span>
                                                </button>
                                                <div class="dropdown-menu" role="menu">
                                                    <a href="{{  route('entrepots.edit',$entrepot->id) }}"
                                                        title="editer l'entrepot"
                                                        class="dropdown-item"><span
                                                            class="text-xs text-dark font-weight-bold"><i
                                                                class="fa fa-eye"></i> Editer l'Entrepot</span>
                                                            
                                                    </a>
                                                    <a href="{{ route('entrepots.show', ['entrepot' => $entrepot->id]) }}"
                                                        title="entrepot et colis"
                                                        class="dropdown-item"><span
                                                            class="text-xs text-dark font-weight-bold"><i
                                                                class="fas fa-truck-moving"></i> Entrepot et Colis </span>
                                                            
                                                    </a>
                                                   

                                                
                                                    <div class="dropdown-item">
                                                       
                                                       
                                                        <form method="POST"
                                                            action="{{  route('entrepots.delete', $entrepot->id) }}">
                                                            @csrf
                                                            <input name="_method" type="hidden" value="DELETE">
                                                            <button type="submit" class="border-0 show_confirm"
                                                                style="margin-left: -5px" data-toggle="tooltip"
                                                                title='Supprimer'> <span
                                                                    class="text-xs text-dark font-weight-bold"><i
                                                                        class="fa fa-trash"></i> Supprimer
                                                                    l'entrepot</span></button>
                                                        </form>
                                                    </div>                                                                                                       

                                                       
                                                        {{-- <a href="{{ route('invoices.etiquette',$invoice->id) }}"
                                                            target="_blank" title="imprimer l'étiquette"
                                                            class="dropdown-item">
                                                            <span class="text-xs text-dark font-weight-bold"><i
                                                                    class="fa fa-print"></i> Imprimer
                                                                l'Etiquette</span>
                                                        </a> --}}
                                                </div>
                                            </div>

                                            
                                          </td>
                                            
                                        </tr>
                                        @endforeach


                                    </tbody>
                                    <tfoot >
                                        <tr>
                                    
                                            <th>Name</th>
                                            <th>Addresse</th>
                                            <th>Ville</th>
                                            
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