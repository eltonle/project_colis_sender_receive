@extends('layouts.master')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3 class="m-0 font-weight-bold">Gestions des Finances</h3>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Tableau de Bord</a></li>
                        <li class="breadcrumb-item active">Clients</li>
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
                            <h3> Listes de Paiement des Clients
                                <a href="{{ route('customers.paid.pdf') }}" target="_blank"
                                    class="btn btn-success float-right btn-sm">
                                    <i class="fa fa-download"></i> TELECHARGER LA LISTE PDF
                                </a>
                            </h3>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Récépissé</th>
                                            <th>Nom du Client</th>
                                            <th>Date</th>
                                            <th>Montant Paye</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $total_paid = '0';
                                        @endphp
                                        @foreach ($allData as $key => $payment)
                                        <tr>
                                            <td>Récépissé №# {{ $payment['invoice']['invoice_no'] }}</td>
                                            <td>{{ $payment['customer']['nom']}}-({{ $payment['customer']['prenom']
                                                }}-{{ $payment['customer']['phone'] }}-{{ $payment['customer']['email']
                                                }})
                                            </td>
                                            <td>{{ date('d-m-Y',strtotime($payment['invoice']['date'])) }}</td>
                                            <td><span class="badge badge-success">{{ number_format($payment->paid_amount
                                                    ,0,' ',',')}} Fcfa</span> </td>
                                            <td>
                                                {{-- <a href="{{ route('invoices.details.pdf',$payment->invoice_id) }}"
                                                    target="_blank" title="details" class="btn btn-sm btn-success mr-1">
                                                    <i class="fa fa-eye"></i>
                                                </a> --}}
                                                <div class="btn-group">
                                                    <button type="button" style="background: #43BD00"
                                                        class="btn  btn-flat btn-sm dropdown-toggle dropdown-icon"
                                                        data-toggle="dropdown">
                                                        <span class=""
                                                            style="background: #43BD00; color: white; padding: 2px">Actions</span>
                                                    </button>
                                                    <div class="dropdown-menu" role="menu">
                                                        <a href="{{ route('invoices.details.pdf',$payment->invoice_id) }}"
                                                            target="_blank" title="details" class="dropdown-item"><span
                                                                class="text-xs text-dark font-weight-bold"
                                                                style="margin-left: -8px">
                                                                <i class="fa fa-eye"></i> Voir les details
                                                                paiements</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                            @php
                                            $total_paid += $payment ->paid_amount;
                                            @endphp
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Récépissé</th>
                                            <th>Nom du Client</th>
                                            <th>Date</th>
                                            <th>Montant Paye</th>
                                            <th>Actions</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                <table class="table table-bordered table-hover">
                                    <tbody>
                                        <tr>
                                            <td colspan="3" style="text-align: right;">
                                                <span class="text-success font-bold font-weight-bold">Grand Total de
                                                    Paiements</span>
                                            </td>
                                            <td><strong>{{ number_format($total_paid ,0,' ',',')}} Fcfa</strong></td>
                                        </tr>
                                    </tbody>
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
             title: `Are you sure?`,
             text: "If you delete this, it will be gone forever.",
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