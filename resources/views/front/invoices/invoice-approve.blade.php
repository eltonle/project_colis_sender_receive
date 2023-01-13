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
                            <h3> FACTURE № #{{ $invoice->invoice_no }} du {{ date('d-M-Y',strtotime($invoice->date)) }}
                                <a href="{{ route('invoices.pending.list') }}"
                                    class="btn btn-success float-right btn-sm">
                                    <i class="fa fa-list"></i> Liste des factures
                                </a>
                            </h3>
                        </div><!-- /.card-header -->



                        <div class="invoice p-3 mb-3">
                            <!-- title row -->
                            <div class="row">
                                <div class="col-12">
                                    @php
                                    $payment = App\Models\Payement::where('invoice_id',$invoice->id)->first();
                                    @endphp
                                    <h4>
                                        <i class="fas fa-globe"></i> Express, Colis.
                                        <small class="float-right">Date: {{ date('d-M-Y',strtotime($invoice->date))
                                            }}</small>
                                    </h4>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- info row -->
                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                    <span class="text-lg  font-weight-bold">Expedition</span>
                                    <address>
                                        <strong style="font-size: 18px">{{ $payment['customer']['nom'] }}, {{
                                            $payment['customer']['prenom']
                                            }}.</strong><br>
                                        Address: {{ $payment['customer']['address'] }}<br>
                                        <b>{{ $payment['invoice']['country']['name'] }}</b>, <b>{{
                                            $payment['invoice']['state']['name'] }}</b><br>
                                        Phone: {{ $payment['customer']['phone'] }}<br>
                                        Email: {{ $payment['customer']['email'] }}
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 invoice-col">
                                    <span class="text-lg  font-weight-bold">Destination</span>
                                    <address>
                                        <strong style="font-size: 18px">{{ $payment['receive']['nom'] }}, {{
                                            $payment['receive']['prenom']
                                            }}.</strong><br>
                                        Address: {{ $payment['receive']['address'] }}<br>
                                        <b>{{ $payment['invoice']['countryr']['name'] }}</b>, <b>{{
                                            $payment['invoice']['stater']['name'] }}</b><br>
                                        Phone: {{ $payment['receive']['phone'] }}<br>
                                        Email: {{ $payment['receive']['email'] }}
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 invoice-col">
                                    <b style="font-size: 17px">Facture №:<strong class="text-primary">#{{
                                            $payment['invoice']['invoice_no'] }}</strong> </b><br>
                                    <br>
                                    <b>Bordereau №: {{ $payment['invoice']['invoice_zip'] }}</b><br>
                                    <br>
                                    {{-- <b>Order ID:</b> 4F3S8J<br> --}}
                                    <b>Montant Paye:</b> {{
                                    number_format($payment->paid_amount,0,' ',',') }} fcfa<br>
                                    <b>Montant Du:</b> {{
                                    number_format($payment->due_amount,0,' ',',') }} fcfa
                                </div>
                                <!-- /.col -->
                            </div>

                        </div>






                        <div class="card-body">
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
                                            <td>{{ number_format($details->unit_price,0,' ',',')}}</td>
                                            <td>{{ $details->qty }}</td>
                                            <td>{{ number_format($details->item_total,0,' ',',')}} fcfa</td>
                                            @php
                                            $total_sum += $details->item_total
                                            @endphp
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="8" class="text-right"><span>Sub Total</span> </td>
                                            <td class="text-center"> <span class="font-weight-bold">{{
                                                    number_format($total_sum,0,' ',',') }}</span>
                                                fcfa</td>
                                        </tr>
                                        <tr>
                                            <td colspan="8" class="text-right"><span>Discount</span> </td>
                                            <td class="text-center"> <span class="font-weight-bold">{{
                                                    number_format($payment->discount_amount,0,' ',',') }}</span> fcfa
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="8" class="text-right"><span>Montant Paye</span> </td>
                                            <td class="text-center"> <span class="font-weight-bold">{{
                                                    number_format($payment->paid_amount,0,' ',',') }}</span> fcfa</td>
                                        </tr>
                                        <tr>
                                            <td colspan="8" class="text-right"><span>Montant due</span> </td>
                                            <td class="text-center"> <span class="font-weight-bold">{{
                                                    number_format($payment->due_amount,0,' ',',') }}</span> fcfa</td>
                                        </tr>
                                        <tr>
                                            <td colspan="8" class="text-right"><strong>Grand total</strong> </td>
                                            <td class="text-center"> <strong>{{ number_format($payment->total_amount,0,'
                                                    ',',')}}</strong> fcfa
                                            </td>
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