@extends('layouts.master')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3 class="m-0 font-weight-bold">Control Credit Clients</h3>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">clients</li>
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
                            <h3> Modifier facture les status
                                <a href="{{ route('customers.credit') }}" class="btn btn-success float-right btn-sm">
                                    <i class="fa fa-list"></i> Liste credit client
                                </a>
                            </h3>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table width="100%">
                                            <tr>
                                                <td width="70%">
                                                    <h4 class="" style="font-size: 26px; color: #3c40c6;">
                                                        <i class="fas fa-globe text-indigo"></i> Express, Colis.
                                                    </h4>
                                                </td>
                                                <td width="30%">
                                                    <h4 class="" style="font-size: 26px">Date:{{
                                                        date('d-M-Y',strtotime($payment['invoice']['date'])) }}</h4>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <br>
                                <table style="border: 1px solid #333;" width="100%">
                                    <thead>
                                        <tr>
                                            <th colspan="2">INFORMATION FACTURE</th>
                                        </tr>
                                    </thead>
                                </table>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <table width="100%">
                                            <tr>
                                                {{-- @php
                                                $payment =
                                                App\Models\Payement::where('invoice_id',$invoice->id)->first();
                                                @endphp --}}
                                                <td width="40%">
                                                    <strong>
                                                        <div class="col-sm-12 ">
                                                            <span class="" style="font-size: 18px">partir de</span>
                                                            <address>
                                                                <strong>{{ $payment['customer']['nom'] }}, {{
                                                                    $payment['customer']['prenom']
                                                                    }}.</strong><br>
                                                                {{ $payment['customer']['address'] }}<br>
                                                                San Francisco, CA 94107<br>
                                                                Phone: {{ $payment['customer']['phone'] }}<br>
                                                                Email: {{ $payment['customer']['email'] }}
                                                            </address>
                                                        </div>
                                                    </strong>
                                                </td>
                                                <td width="40%">
                                                    <strong>
                                                        <div class="col-sm-12 ">
                                                            <span class="" style="font-size: 18px">Pour</span>
                                                            <address>
                                                                <strong>{{ $payment['receive']['nom'] }}, {{
                                                                    $payment['receive']['prenom']
                                                                    }}.</strong><br>
                                                                {{ $payment['receive']['address'] }}<br>
                                                                San Lorenipsum, CA 94107<br>
                                                                Phone: {{ $payment['receive']['phone'] }}<br>
                                                                Email: {{ $payment['receive']['email'] }}
                                                            </address>
                                                        </div>
                                                    </strong>
                                                </td>
                                                <td width="40%">
                                                    <strong>
                                                        <div class="">
                                                            <b style="font-size: 17px">Facture N0:<strong
                                                                    class="text-primary">#{{
                                                                    $payment['invoice']['invoice_no'] }}</strong>
                                                            </b><br>
                                                            <br>
                                                            <b style="font-size: 15px;">Zip ID:</b> #{{
                                                            $payment['invoice']['invoice_zip'] }}<br>

                                                            {{-- <b>Order ID:</b> 4F3S8J<br> --}}
                                                            <b>Montant Du :</b> <b class="" style="color: red">{{
                                                                number_format($payment->due_amount,0,' ',',') }}
                                                            </b>fcfa<br>
                                                            <b>Montant Paye :</b> <b style="color: blue">{{
                                                                number_format($payment->paid_amount,0,' ',',') }}</b>
                                                            fcfa
                                                        </div>
                                                    </strong>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>


                            <div>

                                <br>
                                <table style="border: 1px solid #333;" width="100%">
                                    <thead>
                                        <tr>
                                            <th colspan="2">INFORMATION COlIS</th>
                                        </tr>
                                    </thead>
                                </table>
                                <br>
                                <div class="">
                                    <div class="card-body">
                                        @php
                                        $invoice_details =
                                        App\Models\InvoiceDetail::where('invoice_id',$payment->invoice_id)->get();
                                        // $payment = App\Models\Payement::where('invoice_id',$invoice->id)->first();
                                        @endphp
                                        <form action="{{ route('customers.update.invoice',$payment->invoice_id) }}"
                                            method="post" id="myForm">
                                            @csrf
                                            <table class="table table-bordered" width='100%'
                                                style="margin-bottom: 10px">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th class="text-center" style="background:#ddd; padding:1px;">
                                                            #ID
                                                        </th>
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
                                                    @foreach ($invoice_details as $key =>$details )
                                                    <tr class="text-center">
                                                        <input type="hidden" name="qty[{{ $details->id }}]"
                                                            value="{{ $details->qty }}">
                                                        <td class="text-center" style="background:#ddd; padding:1px;">{{
                                                            $key+1 }}
                                                        </td>
                                                        <td>{{
                                                            $details->model_marque }}</td>
                                                        <td>{{ $details->chassis }}</td>
                                                        <td>{{ $details->longueur }}</td>
                                                        <td>{{ $details->largeur }}</td>
                                                        <td>{{ $details->hauteur}}</td>
                                                        <td>{{ number_format($details->unit_price ,0,' ',',')}}</td>
                                                        <td>{{ $details->qty }}</td>
                                                        <td>{{ number_format($details->item_total,0,' ',',')}}</td>
                                                        @php
                                                        $total_sum += $details->item_total
                                                        @endphp
                                                    </tr>
                                                    @endforeach
                                                    <tr>
                                                        <td colspan="8" style="text-align: right"><strong>Sub
                                                                Total</strong>
                                                        </td>
                                                        <td class="text-center"> <span>{{ number_format($total_sum ,0,'
                                                                ',',')}}</span>fcfa</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="8" style="text-align: right"><span>Discount</span>
                                                        </td>
                                                        <td class="text-center"> <span>{{
                                                                number_format($payment->discount_amount ,0,' ',',')
                                                                }}</span>fcfa</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="8" style="text-align: right"><span>Montant
                                                                Paye</span>
                                                        </td>
                                                        <td class="text-center"> <span
                                                                style="background-color: #0be881">{{
                                                                number_format($payment->paid_amount ,0,' ',',')
                                                                }}</span>fcfa</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="8" style="text-align: right"><span>Montant
                                                                due</span>
                                                        </td>
                                                        <input type="hidden" name="new_paid_amount"
                                                            value="{{ $payment->due_amount }}">
                                                        <td class="text-center"> <span
                                                                style="background-color: #ff5e57">{{
                                                                number_format( $payment->due_amount ,0,' ',',')
                                                                }}</span>fcfa</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="8" style="text-align: right"><strong>Grand
                                                                total</strong> </td>
                                                        <td class="text-center"> <strong>{{
                                                                number_format( $payment->total_amount ,0,' ',',')
                                                                }}</strong>fcfa</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <div class="row mt-5">
                                                <div class="form-group col-md-4">
                                                    <label for="" style="font-weight:bold ">Status payment <i
                                                            class="fas fa-donate text-danger"></i></label>
                                                    <select name="paid_status"
                                                        class="form-control select2 select2-danger form-control-sm"
                                                        data-dropdown-css-class="select2-danger" id="paid_status">
                                                        <option value="">Select_Payement_Status</option>
                                                        <option value="full_paid">Full Paid</option>
                                                        <option value="partial_paid">Partial Paid</option>
                                                    </select>
                                                    <input type="text" name="paid_amount"
                                                        class="form-control form-control-sm paid_amount"
                                                        placeholder="Enter Paid Amount"
                                                        style="display:none; margin-top:5px;">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>Date</label>
                                                    <input type="date" name="date" id="date" class="form-control">
                                                </div>
                                                <div class="form-group col-md-3" style="margin-top: 30px">
                                                    <button type="submit" class="btn btn-success ">valider
                                                        l'encaissement</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
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

<script type="text/javascript">
    //paid status
    $(document).on("change","#paid_status",function(){
      var paid_status = $(this).val();
      if (paid_status=='partial_paid') {
        $('.paid_amount').show();
      } else {
        $('.paid_amount').hide();
      }
  })
</script>
<script>
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()
    })
    //Initialize Select2 Elements
   
</script>
<script type="text/javascript">
    $(document).ready(function(){
    $('#myForm').validate({
        rules:{
            paid_status: {
                required:true,
            },
            date: {
                required:true,
            },
        },
            messages: {

            },
            errorElement: 'span',
            errorPlacement:function(error,element){
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight:function(element,errorClass,validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element,errorClass,validClass){
                $(element).removeClass('is-invalid');
            }
    })
 })
</script>
@endsection