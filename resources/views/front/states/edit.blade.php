@extends('layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3 class="m-0 font-weight-bold">Control villes</h3>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">ville</li>
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
                            <h3> Edit ville
                                <a href="{{ route('states.index') }}" class="btn btn-success float-right btn-sm">
                                    <i class="fa fa-list"></i> Listes des villes
                                </a>
                            </h3>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form action="{{ route('states.update',$edit->id) }}" method="POST" id="myForm"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="country_id">Pays associe</label>
                                            <select class="form-control select2 select2-danger" id="country_id"
                                                data-dropdown-css-class="select2-blue" style="width: 100%;"
                                                name="country_id">
                                                @foreach ($countries as $country )
                                                <option value="{{ $country->id }}" {{ $country->id == $edit->country_id
                                                    ?
                                                    'selected' : '' }}>{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="name">Nom ville</label>
                                            <input type="text" id="name" name="name" value="{{ $edit->name }}"
                                                class="form-control">
                                        </div>

                                        <div class="form-group col-md-6">
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