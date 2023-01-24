@extends('layouts.master')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3 class="m-0 font-weight-bold">Gestions des Expeditions</h3>
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
                            <h3> LISTES DES EXPEDITIONS
                                <a href="{{ route('invoices.create') }}" class="btn  float-right"
                                    style="background: #563DEA; color:#fff">
                                    <i class="fa fa-plus-circle"></i> ENREGISTRER UNE EXPEDITION
                                </a>
                            </h3>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Récépissé</th>
                                            <th>Expediteur</th>
                                            <th> Destinataire</th>
                                            <th>Date</th>
                                            <th>Montant Paye </th>
                                            <th> Colis</th>
                                            <th>Paiement</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($allData as $key => $invoice)
                                        <tr>

                                            <td hidden class="id">{{ $invoice->id }}</td>
                                            <td style="color:#2962FF;font-weight: 900; padding: 2px;">
                                                <span>Récép
                                                    №
                                                    #{{
                                                    $invoice->invoice_no
                                                    }}</span>
                                            </td>
                                            <td hidden class="invoice_no">{{
                                                $invoice->invoice_no
                                                }}
                                            </td>
                                            <td class="nom">
                                                {{ $invoice['payement']['customer']['nom'] }}
                                            </td>
                                            {{-- <td hidden class="prenom">
                                                {{ $invoice['payement']['customer']['prenom'] }}
                                            </td>
                                            <td hidden class="phone">
                                                {{ $invoice['payement']['customer']['phone'] }}
                                            </td> --}}
                                            <td class="nomr">
                                                {{ $invoice['payement']['receive']['nom'] }}
                                            </td>
                                            <td hidden class="date">{{ $invoice->date}}</td>
                                            <td>{{ date('d-M-Y',strtotime($invoice->date)) }}</td>
                                            <td>{{ number_format($invoice['payement']['paid_amount'],0,' ',',')}}Fcfa
                                            <td hidden class="due_amounte">{{
                                                number_format($invoice['payement']['due_amount'],0,' ',',')}}Fcfa
                                            <td class="due_amount" hidden>{{
                                                $invoice['payement']['due_amount']}}
                                            </td>
                                            {{-- <td><span class="badge badge-info">{{$invoice->status_livraison
                                                    }}</span>
                                            </td> --}}

                                            <td class="livraison">
                                                @if ($invoice->status_livraison == 'en embarcation')
                                                <span class="badge"
                                                    style="background: #2962FF;color:white; padding: 3px;"> en
                                                    embarcation</span>
                                                @elseif ($invoice->status_livraison == "en cours d'expedition")
                                                <span class="badge"
                                                    style="background: #0c1561; color:white; padding: 3px;">
                                                    en expedition</span>
                                                @elseif ($invoice->status_livraison == 'livre')
                                                <span class="badge"
                                                    style="background: #EF2856; color:white; padding: 3px;">
                                                    livree</span>
                                                @endif
                                            </td>



                                            <td>
                                                @if ($invoice['payement']['paid_status'] == 'partial_paid')
                                                <span class="badge"
                                                    style="background: #43BD00;color:white; padding: 3px;">
                                                    partiel</span>
                                                @elseif ($invoice['payement']['paid_status'] == 'full_due')
                                                <span class="badge"
                                                    style="background: #EF2856; color:white; padding: 3px;">
                                                    Non payer</span>
                                                @elseif ($invoice['payement']['paid_status']=='full_paid')
                                                <span class="badge"
                                                    style="background: #36BEA6; color:white; padding: 3px;">
                                                    payer</span>
                                                @endif
                                            </td>
                                            <td class="">
                                                @if ($invoice->status == '0')
                                                <span class="badge"
                                                    style="background: #EF2856;color:white; padding: 3px;"> en
                                                    attente</span>
                                                @elseif ($invoice->status == '1')
                                                <span class="badge"
                                                    style="background: #2962FF; color:white; padding: 3px;">
                                                    valider</span>
                                                @endif
                                            </td>
                                            <td hidden class="paid_status">{{ $invoice['payement']['paid_status'] }}
                                            </td>
                                            <td>
                                                @if ($invoice->status=='0')
                                                <div style="display: flex; align-items: center">
                                                    <a href="{{ route('invoices.approve',$invoice->id) }}"
                                                        title="verifier la saisier et valider"
                                                        class="btn btn-sm btn-success mr-1"><i
                                                            class="fa fa-eye"></i></a>

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

                                                <div class="btn-group">
                                                    {{-- <button type="button" class="btn btn-default">Action</button>
                                                    --}}
                                                    <button type="button" style="background: #43BD00"
                                                        class="btn  btn-flat btn-sm dropdown-toggle dropdown-icon"
                                                        data-toggle="dropdown">
                                                        <span class=""
                                                            style="background: #43BD00; color: white; padding: 2px">Actions</span>
                                                    </button>
                                                    <div class="dropdown-menu" role="menu">
                                                        <a href="#" type="button"
                                                            title="modifier le status de livraison"
                                                            class="btn btn-default dropdown-item modal-lg1"
                                                            data-toggle="modal" data-target="#modal-lg1">
                                                            <span class="text-xs text-dark font-weight-bold"><i
                                                                    class="fas fa-sync-alt"></i> Status
                                                                Livraison</span>
                                                        </a>
                                                        <a href="#" type="button" title="ajouter un paiement"
                                                            class="btn btn-default dropdown-item modal-lg2"
                                                            data-toggle="modal" data-target="#modal-lg2">
                                                            <span class="text-xs text-dark font-weight-bold"><i
                                                                    class="fas fa-sync-alt"></i> Ajouter un
                                                                Paiement</span>
                                                        </a>
                                                        {{-- <a class="dropdown-item" href="#">Voir credit</a> --}}
                                                        {{-- <a title="voir les paiements" class="dropdown-item"
                                                            href="{{ route('invoices.details.pdf',$invoice->id) }}">
                                                            <span class="text-sm text-dark font-weight-bold">Voir
                                                                les Paiements</span>
                                                        </a> --}}
                                                        {{-- <a class="dropdown-item" href="#">Something else</a>
                                                        <div class="dropdown-divider"></div> --}}
                                                        <a href="javascript:void(0)" id="show-user" data-url="{{
                                                            route('customers.paid_modal',$invoice->id) }}"
                                                            class="dropdown-item" data-toggle="modal"
                                                            data-target="#modal-lg">
                                                            <span class="text-xs text-dark font-weight-bold"><i
                                                                    class="fa fa-eye"></i> Voir les
                                                                Paiement</span>

                                                        </a>
                                                        <a href="{{ route('invoices.print',$invoice->id) }}"
                                                            target="_blank" title="imprimer recépissé"
                                                            class="dropdown-item">
                                                            <span class="text-xs text-dark font-weight-bold"><i
                                                                    class="fa fa-print"></i> imprimer
                                                                recépissé</span>
                                                        </a>
                                                        <a href="#" target="_blank" title="imprimer l'étiquette"
                                                            class="dropdown-item">
                                                            <span class="text-xs text-dark font-weight-bold"><i
                                                                    class="fa fa-print"></i> imprimer l'étiquette</span>
                                                        </a>
                                                    </div>
                                                </div>
                                                {{-- <button type="button" title="modifier le status"
                                                    class="btn btn-info btn-sm" data-toggle="modal"
                                                    data-target="#modal-xl">
                                                    <i class="fas fa-star"></i>
                                                </button> --}}
                                                {{-- <a href="{{ route('invoices.print',$invoice->id) }}"
                                                    target="_blank" title="imprimer"
                                                    class="btn btn-sm btn-primary mr-1">
                                                    <i class="fa fa-print"></i>
                                                </a> --}}
                                                @endif
                                            </td>

                                            <!-- /.modal -->
                                        </tr>

                                        @endforeach


                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Récépissé</th>
                                            <th>Expediteur</th>
                                            <th> Destinataire</th>
                                            <th>Date</th>
                                            <th>Montant Paye </th>
                                            <th> Colis</th>
                                            <th> Paiement</th>
                                            <th>Status</th>
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
    {{-- <button type="button" title="modifier le status" class="btn btn-info btn-sm" data-toggle="modal"
        data-target="#modal-xl">
        <i class="fas fa-star"></i>
    </button> --}}


    {{-- STATUS LIVRAISON --}}
    <div class="modal fade" id="modal-lg1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Modifier le Status de Livraison</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('invoices.updateStatus') }}" method="post" enctype="multipart/form-data"
                    id="myForm">
                    @csrf
                    <div class="modal-body">
                        {{-- <p>One fine body&hellip;</p> --}}
                        <input type="hidden" name="invoice_id" id="invoice_id" value="">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Récépissé № </label>
                                    <input type="text" class="form-control" value="" name="invoice_no" id="e_recep">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Date d'Expedition</label>
                                    <input type="text" class="form-control" value="" name="date" id="e_date">
                                </div>
                            </div>



                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Status livraison</label>
                                    <select name="status_livraison" class="form-control  form-control" id="e_livraison">
                                        {{-- <option value="">selectionner un Status </option> --}}
                                        <option value="en embarcation">En Embarcation</option>
                                        <option value="en cours d'expedition">En cours d'Expedition
                                        </option>
                                        <option value="livre">Livree</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Enregistrer les informations</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    {{-- STATUS PAYEMENT --}}
    <div class="modal fade" id="modal-lg2">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Enregistrer un Paiement</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('customers.update.invoice') }}" id="myForm" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        {{-- <p>One fine body&hellip;</p> --}}

                        <input type="hidden" name="invoice_id" id="invoice" value="">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Récépissé № </label>
                                    <input type="text" class="form-control" value="" name="invoice_no" id="e_recepp">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Date d'Expedition</label>
                                    <input type="text" class="form-control" value="" name="date" id="e_datep">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Dette</label>
                                    <input type="hidden" class="form-control" value="" name="new_paid_amount"
                                        id="e_due_amount">
                                    <input type="text" class="form-control" value="" name="" id="e_due_amounte">
                                </div>
                            </div>



                            <div class="form-group col-md-4">
                                <label for="" style="font-weight:bold ">Status Paiement <i
                                        class="fas fa-donate text-danger"></i></label>
                                <select name="paid_status" class="form-control form-control" id="paid_status">
                                    <option value=""> Status de Paiement de la Dette</option>
                                    <option value="full_paid">entièrement paye</option>
                                    <option value="partial_paid"> payer partiellement</option>
                                    <option value="full_due">Non payer</option>
                                </select>
                                <input type="text" name="paid_amount" class="form-control form-control-sm paid_amount"
                                    placeholder="Saisir le Montant" style="display:none; margin-top:5px;">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Enregistrer les Modifications</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


    {{-- SHOW PAYEMENTDETAIL --}}
    <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Récép № : <span id="recep"></span></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4 class="text-center">sommaire de paiement</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="50%" class="text-right">Date</th>
                                <th width="50%">Montant verse</th>
                            </tr>
                        </thead>
                        <tbody id="tdata">

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

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

{{-- modal update status --}}
<script>
    $(document).on('click','.modal-lg1',function () {
        var _this = $(this).parents('tr');
        $('#invoice_id').val(_this.find('.id').text());
        $('#e_nom').val(_this.find('.nom').text());
        // $('#e_nomr').val(_this.find('.nomr').text());
        $('#e_date').val(_this.find('.date').text());
        $('#e_recep').val(_this.find('.invoice_no').text());
        $('#e_livraison').val(_this.find('.livraison').text());
    })
</script>
{{-- modal update Payemeny --}}
<script>
    $(document).on('click','.modal-lg2',function () {
        var _this = $(this).parents('tr');
        $('#invoice').val(_this.find('.id').text());
        // $('#e_nom').val(_this.find('.nom').text());
        // $('#e_nomr').val(_this.find('.nomr').text());
        $('#e_datep').val(_this.find('.date').text());
        $('#e_recepp').val(_this.find('.invoice_no').text());
        $('#e_due_amount').val(_this.find('.due_amount').text());
        $('#e_due_amounte').val(_this.find('.due_amounte').text());
        // $('#e_paid_status').val(_this.find('.paid_status').text());


        // var leave_type = (_this.find(".paid_status").text());

        // var _option = '<option selected value="' + leave_type+ '">' + _this.find('.leave_type').text() + '</option>'
        // $( _option).appendTo('#paid_status');
    })
</script>
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
<script type="text/javascript">
    $(document).ready(function(){
    $('#myForm').validate({
        rules:{
            paid_status: {
                required:true,
            },
            status_livraison: {
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

<script type="text/javascript">
    $(document).ready(function () {
     $('body').on('click', '#show-user', function () {
        var userUrl  = $(this).data('url');
        // console.log(userUrl);
        $.getJSON(userUrl, function(data){
            // $('#userShowModal').modal('show');
            console.log(data);
            $('#recep').text(data[0].invoice_id);
            data.forEach(function(index) {
                $('#tdata').append(
                    
                    "<tr>"+
                    "<td>"+index.date+"</td>"+
                    "<td>"+index.current_paid_amount+"</td>"
                    +"</tr>"
                    );
            });
       
        })
     })
  })
</script>
@endsection