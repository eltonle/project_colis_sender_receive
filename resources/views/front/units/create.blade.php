@extends('layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3 class="m-0 font-weight-bold">Gestions des Conteneurs <i class="nav-icon 	fas fa-truck-moving"></i></h3>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Tableau de Bord</a></li>
                        <li class="breadcrumb-item active">Conteneurs</li>
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
                            <h3> Ajouter un Conteneur
                                <a href="{{ route('units.index') }}" class="btn float-right btn-sm" style="background: #563DEA;color: #fff">
                                    <i class="fa fa-list"></i> LISTES DES CONTENEURS
                                </a>
                            </h3>
                        </div><!-- /.card-heade-->
                        <div class="card-body">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form action="{{ route('units.store') }}" method="POST" id="myForm" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="name">Nom du Conteneur</label>
                                            <input type="text" id="name" name="name" class="form-control" placeholder="entrer un nom" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="name">Identifiant ou Numero Conteneur</label>
                                            <input type="text" id="name" name="numero_id" class="form-control" placeholder="entrer un identifiant du conteneur" required>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="date">Date De Chargement Du Conteneur </label>
                                            <input type="date" id="date" name="date_chargement" class="form-control" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="status">Statut</label>
                                            <input type="text" id="status" name="statut" class="form-control" value="Non Charge" disabled>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="descriptio">Description Du Conteneur</label>
                                            <textarea id="descriptio" name="description" class="form-control"></textarea>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <input type="submit" value="Enregistrer les Informations" class="btn" style="background: #563DEA;color: #fff">
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
    $(document).ready(function() {
        $('#myForm').validate({
            rules: {
                name: {
                    required: true,
                    rangelength: [3, 30]
                },
                numero_id: {
                    required: true,
                    rangelength: [3, 30]
                },
            },
            messages: {

            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        })
    })
</script>
@endsection