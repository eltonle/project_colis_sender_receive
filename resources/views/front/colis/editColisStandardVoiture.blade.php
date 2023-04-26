@extends('layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3 class="m-0 font-weight-bold">Gestions de Colis Standards</h3>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Tableau de Bord</a></li>
                        <li class="breadcrumb-item active">Colis Standard</li>
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
                            <h3> Mise à jour du Colis-Standard de Type Voiture
                                <a href="{{ route('colis.listes') }}" class="btn float-right btn-sm"
                                    style="background: #563DEA;color: #fff">
                                    <i class="fa fa-list"></i> LISTES DES COLIS STANDARDS 
                                </a>
                            </h3>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form action="{{ route('colis.updateStandardVoiture', $colisStandardEditVoiture->id) }}" method="POST" id="myForm"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-row">

                                        <div class="form-group col-md-12">
                                            <label for="name">Titre</label>
                                            <input type="text" id="titre" name="titre" class="form-control" value="{{ $colisStandardEditVoiture->titre }}">
                                        </div>
                                                                                                               

                                        <div class="form-group col-md-6">
                                            <label for="type">Type Voiture</label>
                                            <input type="text" id="type" name="type" class="form-control" value="{{ $colisStandardEditVoiture->type }}">
                                        </div>
                                       
                                        <div class="form-group col-md-6">
                                            <label for="capacite">Capacité</label>
                                            <input type="text" id="capacite" name="capacite"  class="form-control" value="{{ $colisStandardEditVoiture->capacite }}">
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label for="prix">Prix (en FCFA)</label>
                                            <input type="number" id="prix" name="prix"  class="form-control" value="{{ $colisStandardEditVoiture->prix }}">
                                        </div>                                        
                                        
                                        <div class="form-group col-md-12">
                                            <label >Description</label>
                                            <textarea name="description" class="form-control" >{{ $colisStandardEditVoiture->description }}</textarea>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <input type="submit" value="Enregistrer les Informations" class="btn"
                                                style="background: #563DEA;color: #fff">
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