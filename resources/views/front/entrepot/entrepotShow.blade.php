@extends('layouts.master')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3 class="m-0 font-weight-bold"> Gestions des Entrepôts <i class="nav-icon 	fas fa-cubes"></i></h3>
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
                                {{-- <a href="{{ route('entrepots.create') }}" class="btn float-right btn-sm"
                                style="background: #563DEA;color: #fff">
                                <i class="fa fa-plus-circle"></i> AJOUTER UN ENTREPOT
                                </a> --}}
                            </h3>
                        </div><!-- /.card-header -->
                        <div class="card-header ">
                            <h4><strong>Listes des Colis de l'Entrepôt</strong>
                                @if( count($colis) > 0)
                                <a href="{{ route('entrepotListes.pdf', $entrepot) }}" target="_blank" class="btn btn-success float-right btn-sm ml-2">
                                    <i class="fa fa-download"></i> Telecharger la liste Pdf
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
                                            {{-- <th>Description</th> --}}
                                            <th>Poids</th>
                                            <th>Code</th>
                                            <th>Status </th>

                                            {{-- <th>Actions</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($colis as $item)
                                        <tr>
                                            <td>{{ strtoupper($item->titre) }}</td>
                                            {{-- <td>{{ strtoupper($item->description) }}</td> --}}

                                            <td>{{ ($item->poids) ? $item->poids : '0' }} Kg</td>
                                            <td>Code_zip №:{{ $item->code_zip }} </td>
                                            <td>
                                                @if (($item->charge == 1) && ($item->decharge == null) )
                                                <span class="badge " style="background: #2962FF;color:white; padding: 3px;">
                                                    <i class="fas fa-truck-moving"></i> Colis Chargé</span>
                                                @elseif (($item->charge == 2) && ($item->decharge == 1) && ($item->vehicule_id == Null))
                                                <span class="badge " style="background:  #b614a9; color:white; padding: 3px;">
                                                    <i class="fas fa-check"></i> Colis Dechargé</span>
                                                @elseif (($item->charge == 2) && ($item->decharge == 1) && ($item->vehicule_id !== 0))
                                                <span class="badge " style="background:  #198000bd; color:white; padding: 3px;">
                                                    <i class="fas fa-check"></i> Colis charge dans un vehicule</span>
                                                @else
                                                <span class="badge " style="background:  #B61418; color:white; padding: 3px;">
                                                    <i class="fas fa-times"></i> Colis Non Chargé</span>
                                                @endif

                                            </td>
                                            <td>
                                                {{-- @if ($item->decharge == 1)
                                            <span class="badge "
                                                style="background: #2962FF;color:white; padding: 3px;">
                                                <i class="fas fa-truck-moving"></i> Dechargé</span>
                                            @elseif ($item->decharge == 2)
                                            <span class="badge "
                                                style="background:  #14b6ae; color:white; padding: 3px;">
                                                <i class="fas fa-times"></i> En Attente</span> 
                                            @else
                                                <span class="badge "
                                                style="background:  #B61418; color:white; padding: 3px;">
                                                <i class="fas fa-times"></i> Non Dehargé</span> 
                                            @endif
                                           
                                        </td> --}}
                                        </tr>

                                        @endforeach
                                    </tbody>
                                    <tfoot style="text-transform: uppercase;">
                                        <tr>

                                            <th>Titre</th>
                                            {{-- <th>Description</th> --}}
                                            <th>Poids</th>
                                            <th>Code</th>
                                            <th>Status </th>
                                            {{-- <th>Status Dechargement</th> --}}

                                            {{-- <th>Actions</th> --}}
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