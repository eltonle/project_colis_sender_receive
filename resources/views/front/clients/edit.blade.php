@extends('layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3 class="m-0 font-weight-bold">Manage Clients</h3>
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
                            <h3> Clients Edit
                                <a href="#" class="btn btn-success float-right btn-sm">
                                    <i class="fa fa-list"></i> Clients Lists
                                </a>
                            </h3>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form action="{{ route('clients.update',$edit->id) }}" method="POST" id="myForm"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="name">Client Name</label>
                                            <input type="text" id="name" name="name" value="{{ $edit->name }}"
                                                class="form-control">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="firstname">Client Firstname</label>
                                            <input type="text" id="firstname" value="{{ $edit->firstname }}"
                                                name="firstname" class="form-control">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="email">Client email</label>
                                            <input type="email" id="email" name="email" value="{{ $edit->email }}"
                                                class="form-control">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="address">Client address</label>
                                            <input type="text" id="address" value="{{ $edit->address }}" name="address"
                                                class="form-control">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="phone">Client phone_No</label>
                                            <input type="tel" id="phone" name="phone" value="{{ $edit->phone }}"
                                                class="form-control">
                                        </div>
                                        <div class="form-group col-md-6" style="padding-top: 30px">
                                            <input type="submit" value="Enregistrer les Modifications"
                                                class="btn btn-primary">
                                        </div>
                                    </div>

                                </form>
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
<script type="text/javascript">
    $(document).ready(function(){
    $('#myForm').validate({
        rules:{
            name: {
                required:true,
                rangelength :[3,30]
            },
            firstname: {
                required:true,
                rangelength :[3,35]
            },
            email: {
                required:true,
                email: true,
            },
            address: {
                required:true,
                rangelength :[3,25]
            },
            phone: {
                required:true,
                number:true,
            }
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