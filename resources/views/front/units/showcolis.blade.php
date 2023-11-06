@extends('layouts.master')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
   
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row mt-3">
                {{-- left col --}}
                <section class="col-md-12">
                    {{-- custom tabs --}}
                    <div class="card">
                       
                        <div class="card-header">
                            <div class="float-left">
                               <span class="" style="font-size: 20px"> {{ strtoupper($unit->name) }} - № :{{ strtoupper($unit->numero_id) }}</span>
                            </div>

                                                                                 
                            <div class="float-right">
                               <a href="{{ route('units.index') }}" class="btn btn-primary"><i class="fa fa-list"></i> Listes des Conteneurs</a>
                            </div>                    
                        </div>
                        <div class="card-header text-center">
                            <h3> Listes des Colis  Chargés
                                {{-- <a href="{{ route('units.create') }}" class="btn  float-right btn-sm"
                                    style="background: #563DEA;color: #fff">
                                    <i class="fa fa-plus-circle"></i> AJOUTER UN CONTENEUR
                                </a> --}}
                            </h3>

                        </div>
                        <div class="card-body" style="margin-top: -20px;">
                            <!-- /.card-header -->
                            <div class="card-body">
                               
                                    <table id="example1" class="table table-bordered table-striped">                                       
                                        <thead style="margin-top: -30px">
                                            <tr>
                                               
                                                <th>Titre Colis</th>
                                                <th>Nom de l'Expediteur</th>
                                                <th>Date</th>
                                                <th>Montant Colis</th>
                                                <th>Etat Chargement</th>
                                                                                             
                                            </tr>
                                        </thead>
                                        <tbody>

                                           @if ($unit->colis()->count() > 0)
                                           @foreach ($unit->colis as $ul)
                                           <tr>
                                           
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
                                           

                                           </tr>
                                           @endforeach
                                           @else
                                               <h5 class="text-center">pas de colis </h5>
                                           @endif
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                               
                                                <th>Titre Colis</th>
                                                <th>Nom de l'Expediteur</th>
                                                <th>Date</th>
                                                <th>Montant Colis</th>
                                                <th>Etat Chargement</th>
                                                                                           
                                              
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

@endsection