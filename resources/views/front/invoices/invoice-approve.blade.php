@extends('layouts.master')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3 class="m-0 font-weight-bold">Manage Facture</h3>
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
                            <h3> FACTURE № #{{ $invoice->invoice_no }} du {{ date('d-M-Y',strtotime($invoice->date)) }}
                                <a href="{{ route('invoices.pending.list') }}"
                                    class="btn btn-success float-right btn-sm">
                                    <i class="fa fa-list"></i> Liste facture en attente
                                </a>
                            </h3>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            @php
                            $payment = App\Models\Payement::where('invoice_id',$invoice->id)->first();
                            @endphp
                            <table width="100%">
                                <tbody>
                                    <tr>
                                        <td width="15%">
                                            <p><span class="text-primary font-bold">INFOS EXPEDITEUR:</span></p>
                                        </td>
                                        <td width="10%">
                                            <p><strong>Nom:</strong> {{ $payment['customer']['nom'] }}</p>
                                        </td>
                                        <td width="15%">
                                            <p><strong>Prenom:</strong> {{ $payment['customer']['prenom'] }}</p>
                                        </td>
                                        <td width="15%">
                                            <p><strong>Email:</strong> {{ $payment['customer']['email'] }}</p>
                                        </td>
                                        <td width="15%">
                                            <p><strong>Address:</strong> {{ $payment['customer']['address'] }}</p>
                                        </td>
                                        <td width="15%">
                                            <p><strong>Phone:</strong> {{ $payment['customer']['phone'] }}</p>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td width="15%">
                                            <p><span class="text-primary font-bold">INFOS RECEPTEUR:</span></p>
                                        </td>
                                        <td width="10%">
                                            <p><strong>Nom:</strong> {{ $payment['receive']['nomr'] }}</p>
                                        </td>
                                        <td width="15%">
                                            <p><strong>Prenom:</strong> {{ $payment['receive']['prenomr'] }}</p>
                                        </td>
                                        <td width="15%">
                                            <p><strong>Email:</strong> {{ $payment['receive']['emailr'] }}</p>
                                        </td>
                                        <td width="15%">
                                            <p><strong>Address:</strong> {{ $payment['receive']['addressr'] }}</p>
                                        </td>
                                        <td width="15%">
                                            <p><strong>Phone:</strong> {{ $payment['receive']['phoner'] }}</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <form action="{{ route('invoices.approval.store', $invoice->id) }}" method="post">
                                @csrf

                                <table class="table-bordered table" width='100%' style="margin-bottom: 10px">
                                    <thead>
                                        <tr class="text-center">
                                            <th class="text-center" style="background:#ddd; padding:1px;">#ID</th>
                                            <th>Model&Marque</th>
                                            <th>Chassis</th>
                                            <th>Longueur</th>
                                            <th>Largeur</th>
                                            <th>Hauteur</th>
                                            <th>Prix unite</th>
                                            <th>Qty</th>
                                            <th>Total prix</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $total_sum = '0';
                                        @endphp
                                        @foreach ($invoice['invoice_details'] as $key =>$details )
                                        <tr class="text-center">
                                            <input type="hidden" name="qty[{{ $details->id }}]"
                                                value="{{ $details->qty }}">
                                            <td class="text-center" style="background:#ddd; padding:1px;">{{ $key+1 }}
                                            </td>
                                            <td>{{
                                                $details->model_marque }}</td>
                                            <td>{{ $details->chassis }}</td>
                                            <td>{{ $details->longueur }}</td>
                                            <td>{{ $details->largeur }}</td>
                                            <td>{{ $details->hauteur}}</td>
                                            <td>{{ $details->unit_price }}</td>
                                            <td>{{ $details->qty }}</td>
                                            <td>{{ $details->item_total }}</td>
                                            @php
                                            $total_sum += $details->item_total
                                            @endphp
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="8" class="text-right"><span>Sub Total</span> </td>
                                            <td class="text-center"> <span>{{ $total_sum }}</span></td>
                                        </tr>
                                        <tr>
                                            <td colspan="8" class="text-right"><span>Discount</span> </td>
                                            <td class="text-center"> <span>{{ $payment->discount_amount }}</span></td>
                                        </tr>
                                        <tr>
                                            <td colspan="8" class="text-right"><span>Montant Paye</span> </td>
                                            <td class="text-center"> <span>{{ $payment->paid_amount }}</span></td>
                                        </tr>
                                        <tr>
                                            <td colspan="8" class="text-right"><span>Montant due</span> </td>
                                            <td class="text-center"> <span>{{ $payment->due_amount }}</span></td>
                                        </tr>
                                        <tr>
                                            <td colspan="8" class="text-right"><strong>Grand total</strong> </td>
                                            <td class="text-center"> <strong>{{ $payment->total_amount }}</strong></td>
                                        </tr>
                                    </tbody>
                                </table>

                                <button type="submit" class="btn btn-success">Valider la facture</button>
                            </form>
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