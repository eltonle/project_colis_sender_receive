@extends('layouts.master')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3 class="m-0 font-weight-bold">Control Facture</h3>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Facture</li>
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
                            <h3> liste des factures
                                <a href="{{ route('invoices.create') }}" class="btn btn-success float-right ">
                                    <i class="fa fa-plus-circle"></i> ENREGISTRER UNE TRANSACTION
                                </a>
                            </h3>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No facture</th>
                                            <th>Nom du Client</th>
                                            <th>Date</th>
                                            <th>Montant </th>
                                            <th>Status colis</th>
                                            <th>Status</th>
                                            <th>Status facture</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($allData as $key => $invoice)
                                        <tr>
                                            <td> <span class=""
                                                    style="background: #303952;color:white; font-weight: 500; padding: 3px;">Facture
                                                    №
                                                    #{{
                                                    $invoice->invoice_no
                                                    }}</span>
                                            </td>
                                            <td>
                                                {{ $invoice['payement']['customer']['nom'] }}-
                                                ( {{ $invoice['payement']['customer']['phone'] }},{{
                                                $invoice['payement']['customer']['address'] }})
                                            </td>
                                            <td>{{ date('d-M-Y',strtotime($invoice->date)) }}</td>
                                            <td>{{ number_format($invoice['payement']['paid_amount'],0,' ',',')}} fcfa
                                            </td>
                                            <td><span class="badge badge-info">{{$invoice->status_livraison }}</span>
                                            </td>
                                            <td>
                                                @if ($invoice->status == '0')
                                                <span class="badge"
                                                    style="background: #f82302;color:white; padding: 3px;"> en
                                                    attente</span>
                                                @elseif ($invoice->status == '1')
                                                <span class="badge"
                                                    style="background: #0c1561; color:white; padding: 3px;">
                                                    valider</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($invoice['payement']['paid_status'] == 'partial_paid')
                                                <span class="badge"
                                                    style="background: #43BD00;color:white; padding: 3px;">
                                                    partiel paid</span>
                                                @elseif ($invoice['payement']['paid_status'] == 'full_due')
                                                <span class="badge"
                                                    style="background: #c23616; color:white; padding: 3px;">
                                                    Non payer</span>
                                                @elseif ($invoice['payement']['paid_status']=='full_paid')
                                                <span class="badge"
                                                    style="background: #36BEA6; color:white; padding: 3px;">
                                                    Cash_payment</span>
                                                @endif
                                            </td>

                                            <td>
                                                @if ($invoice->status=='0')
                                                <div style="display: flex; align-items: center">
                                                    <a href="{{ route('invoices.approve',$invoice->id) }}"
                                                        title="approuver" class="btn btn-sm btn-success mr-1"><i
                                                            class="fa fa-check-circle"></i></a>

                                                    <form method="POST"
                                                        action="{{ route('invoices.delete', $invoice->id) }}">
                                                        @csrf
                                                        <input name="_method" type="hidden" value="DELETE">
                                                        <button type="submit"
                                                            class="btn btn-sm rounded btn-danger  show_confirm"
                                                            data-toggle="tooltip" title='Supprimer'><i
                                                                class="fa fa-trash"></i></button>
                                                    </form>
                                                </div>
                                                @endif
                                                @if ($invoice->status=='1')
                                                <a href="{{ route('invoices.print',$invoice->id) }}" target="_blank"
                                                    title="imprimer" class="btn btn-sm btn-primary mr-1">
                                                    <i class="fa fa-print"></i>
                                                </a>
                                                @endif
                                                {{-- <div style="display: flex; align-items: center">


                                                    <a href="{{ route('invoices.deletet',$invoice->id) }}" title="edit"
                                                        class="btn btn-sm btn-primary mr-1">
                                                        <i class="fa fa-edit"></i>
                                                    </a>

                                                    <form method="POST"
                                                        action="{{ route('invoices.delete', $invoice->id) }}">
                                                        @csrf
                                                        <input name="_method" type="hidden" value="DELETE">
                                                        <button type="submit"
                                                            class="btn btn-sm rounded btn-danger btn-flat show_confirm"
                                                            data-toggle="tooltip" title='Supprimer'><i
                                                                class="fa fa-trash"></i></button>
                                                    </form>
                                                </div> --}}
                                            </td>
                                        </tr>
                                        @endforeach


                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No facture</th>
                                            <th>Nom du Client</th>
                                            <th>Date</th>
                                            <th>Montant </th>
                                            <th>Status colis</th>
                                            <th>Status</th>
                                            <th>Status facture</th>
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
             title: `Annuler facture?`,
             text: "voulez vous annuler cette facture.",
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