@extends('layouts.master')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3 class="m-0 font-weight-bold"> Gestions des Entrepôts <i class="nav-icon	fas fa-cubes"></i></h3>
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
                        <div class="card-header text-center">
                            <h3> {{ $entrepot->name }}_&_{{ $entrepot->address }}_&_{{ $entrepot->ville }}

                            </h3>
                        </div><!-- /.card-header -->
                        <div class="card-header ">
                            <h4><strong>Listes des Colis decharge dans l'Entrepôt</strong>
                                @if( count($colis) > 0)
                                <a href="{{ route('entrepotListesDecharges.pdf', $entrepot) }}" target="_blank" class="btn btn-success float-right btn-sm ml-2">
                                    <i class="fa fa-download"></i> Telecharger liste des colis decharges Pdf
                                </a>
                                @endif
                                <a href="{{ route('entrepots.index') }}" class="btn  float-right btn-sm" style="background: #563DEA;color: #fff">
                                    <i class="fa fa-list"></i> Listes des Entrepôts
                                </a>
                            </h4>

                        </div>
                        <div class="card-body">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead style="text-transform: uppercase;">
                                        <tr>

                                            <th>Titre</th>
                                            <th>Poids</th>
                                            <th>Code</th>
                                            <th>Status </th>

                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($colis as $item)
                                        <tr>
                                            <td>{{ strtoupper($item->titre) }}</td>

                                            <td>{{ ($item->poids) ? $item->poids : '0' }} Kg</td>
                                            <td>Code_zip №:{{ $item->code_zip }} </td>
                                            <td>
                                                @if (($item->charge == 2) && ($item->decharge == 1) )
                                                <span class="badge " style="background:  #b614a9; color:white; padding: 3px;">
                                                    <i class="fas fa-check"></i> Colis Dechargé</span>
                                                @else
                                                <span class="badge " style="background:  #B61418; color:white; padding: 3px;">
                                                    <i class="fas fa-times"></i> erreur</span>
                                                @endif

                                            </td>
                                            <td>
                                                <!-- <a href="#"
                                            title="livré colis"
                                                            class="btn btn-xs btn-success" >
                                                            <span class="text-xs font-weight-bold"><i class="fas fa-check"></i> 
                                                                Livré</span>
                                                        </a> -->
                                                <form action="{{route('entrepot.livraison',$item->id)}}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-success"><span class="text-xs "><i class="fas fa-check fa-xs"></i>
                                                            Valider la livraison</span></button>
                                                </form>

                                            </td>
                                        </tr>

                                        @endforeach
                                    </tbody>
                                    <tfoot style="text-transform: uppercase;">
                                        <tr>

                                            <th>Titre</th>
                                            <th>Poids</th>
                                            <th>Code</th>
                                            <th>Status </th>

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