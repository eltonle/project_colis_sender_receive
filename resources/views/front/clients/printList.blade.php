@extends('layouts.master')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3 class="m-0 font-weight-bold" style="color: #3498db">Manage Clients</h3>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
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
                            <h3> Clients Lists To Print Facture
                                {{-- <a href="{{ route('clients.create') }}" class="btn btn-success float-right btn-sm">
                                    <i class="fa fa-plus-circle"></i> Add Client
                                </a> --}}
                            </h3>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped table-responsive">
                                    <thead>
                                        <tr>
                                            <th>Tracking Number</th>
                                            <th>Sender</th>
                                            {{-- <th>Expedition</th> --}}
                                            <th>Status payement</th>
                                            <th>Etat livraison</th>
                                            <th>Montant paye</th>
                                            <th>Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($clients as $client)
                                        <tr>
                                            <td>{{ $client->client_number }}</td>
                                            <td>{{ $client->name }}-{{ $client->firstname }} <span
                                                    class="font-weight-bold">({{
                                                    $client->email }})</span></td>
                                            {{-- <td> {{ $client->country->name }}</td> --}}
                                            <td>
                                                <strong class="">@if (
                                                    $client['payements'][0]['paid_status'] =='full_paid')
                                                    <strong class="badge badge-success">{{
                                                        $client['payements'][0]['paid_status'] }}</strong>
                                                    @elseif ( $client['payements'][0]['paid_status']=='full_due')
                                                    <strong class="badge badge-danger">{{
                                                        $client['payements'][0]['paid_status'] }}</strong>
                                                    @elseif (
                                                    $client['payements'][0]['paid_status']=='partial_paid')
                                                    <strong class="badge badge-dark">{{
                                                        $client['payements'][0]['paid_status'] }}</strong>
                                                    @endif</strong>
                                            </td>
                                            <td> <strong class="badge badge-info">{{ $client->status_livraison
                                                    }}</strong> </td>
                                            <td> {{ $client['payements'][0]['paid_amount'] }}</td>
                                            <td> {{ date('d M Y',strtotime($client->created_at))}}</td>
                                            <td>
                                                <a href="{{ route('clients.print',$client->id) }}" target="blank"
                                                    title="print" id="" class="btn btn-sm btn-info">
                                                    <i class="fas fa-print"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach


                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Tracking Number</th>
                                            <th>Sender</th>
                                            {{-- <th>Expedition</th> --}}
                                            <th>Status payement</th>
                                            <th>Etat livraison</th>
                                            <th>Montant paye</th>
                                            <th>Date</th>
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