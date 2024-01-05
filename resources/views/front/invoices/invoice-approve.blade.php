@extends('layouts.master')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3 class="m-0 font-weight-bold">Gestion Expedition <i class="far fa-keyboard"></i></h3>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Tableau de Bord</a></li>
                        <li class="breadcrumb-item active">Expedition</li>
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
                            <h3>Récépissé № #{{ $invoice->invoice_no }} du {{ date('d-M-Y',strtotime($invoice->date)) }}
                                <a href="{{ route('invoices.pending.list') }}" class="btn btn-success float-right btn-sm">
                                    <i class="fa fa-list"></i> LISTES DES EXPEDITIONS
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
                                    <b style="font-size: 17px">Récépissé №:<strong class="text-primary">#{{
                                            $payment['invoice']['invoice_no'] }}</strong> </b><br>
                                    <br>
                                    <b>Bordereau №: {{ $payment['invoice']['invoice_zip'] }}</b><br>

                                    {{-- <b>Order ID:</b> 4F3S8J<br> --}}
                                    <b class="text-dark font-weight-bold">Montant Expedition:</b> {{
                                    number_format($payment->total_amount,0,' ',',') }} Fcfa<br>
                                    <b class="text-green">Montant Paye:</b> {{
                                    number_format($payment->paid_amount,0,' ',',') }} Fcfa<br>
                                    <b class="text-danger">Montant Du:</b> {{
                                    number_format($payment->due_amount,0,' ',',') }} Fcfa
                                </div>
                                <!-- /.col -->
                            </div>

                        </div>






                        <div class="card-body">
                            {{-- <form action="{{ route('invoices.approval.store', $invoice->id) }}" method="post">
                            @csrf --}}

                            <table class="table-bordered table" width='100%' style="margin-bottom: 10px">
                                <thead>
                                    <tr class="text-center">
                                        <th class="text-center" style="background:#ddd; padding:1px;">#ID</th>
                                        <th>Code_zip</th>
                                        <th>Type</th>
                                        <th>Titre</th>
                                        <th>Prix</th>
                                        <!-- <th>Hauteur</th> -->
                                        <!-- <th>Prix unit</th> -->
                                        <!-- <th>Qty</th> -->
                                        <!-- <th>Total prix</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $total_sum = '0';
                                    @endphp
                                    @foreach ($invoice['colis_dimensions'] as $key =>$details )
                                    <tr class="text-center">
                                        <input type="hidden" name="qty[{{ $details->id }}]" value="{{ $details->qty }}">
                                        <td class="text-center" style="background:#ddd; padding:1px;">{{ $key+1 }}
                                        </td>
                                        <td>№: {{
                                                $details->code_zip }}</td>
                                        <td>{{
                                                $details->type }}</td>
                                        <td>{{ $details->titre }}</td>
                                        <!-- <td>{{ $details->longueur }}</td>
                                            <td>{{ $details->largeur }}</td>
                                            <td>{{ $details->hauteur}}</td> -->
                                        <td>{{ number_format($details->prix,0,' ',',')}} Fcfa</td>
                                        <!-- <td>{{ $details->qty }}</td> -->
                                        <!-- <td>{{ number_format($details->item_total,0,' ',',')}} Fcfa</td> -->
                                        @php
                                        $total_sum += $details->prix
                                        @endphp
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="4" class="text-right font-weight-bold"><span>Grand total</span> </td>
                                        <td class="text-center"> <span class="font-weight-bold">{{
                                                    number_format($total_sum,0,' ',',') }}</span>
                                            Fcfa</td>
                                    </tr>
                                    <!-- <tr>
                                            <td colspan="4" class="text-right"><span>Remise</span> </td>
                                            <td class="text-center"> <span class="font-weight-bold">{{
                                                    number_format($payment->discount_amount,0,' ',',') }}</span> Fcfa
                                            </td> 
                                        </tr> -->
                                    <tr>
                                        <td colspan="4" class="text-right text-green font-weight-bold"><span>Montant Paye</span> </td>
                                        <td class="text-center text-green"> <span class="font-weight-bold ">{{
                                                    number_format($payment->paid_amount,0,' ',',') }}</span> Fcfa</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-right text-danger font-weight-bold"><span>Montant due</span> </td>
                                        <td class="text-center text-danger font-weight-bold"> <span class="font-weight-bold">{{
                                                    number_format($payment->due_amount,0,' ',',') }}</span> Fcfa</td>
                                    </tr>
                                    <!-- <tr>
                                            <td colspan="4" class="text-right"><strong>Grand total</strong> </td>
                                            <td class="text-center"> <strong>{{ number_format($payment->total_amount,0,'
                                                    ',',')}}</strong> Fcfa
                                            </td>
                                        </tr> -->
                                </tbody>
                            </table>

                            {{-- <button type="submit" class="btn btn-success">Valider les Données</button> --}}
                            {{--
                            </form> --}}
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