@extends('layouts.master')
@section("css")
<style>
    input[type="radio"] {
        transform: scale(1.3);
    }
</style>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3 class="m-0 font-weight-bold"> Dechargement Conteneur <i class="fas fa-sync"></i></h3>
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
    <div class="content" id="contenu2">
        <div class="container-fluid">
            <div class="row">
                {{-- left col --}}
                <section class="col-md-12">
                    {{-- custom tabs --}}
                    <div class="card">

                        <div class="card-header">
                            <h4 class="text-center mt-2">
                                {{ strtoupper($unit->name) }} - № :({{ strtoupper($unit->numero_id) }}) && statut: ({{
                                strtoupper($unit->statut) }})
                            </h4>



                        </div>
                        <div class="card-body">

                            <!-- partir pour telecharge le fichier text -->

                            <div class="row">
                                <form method="POST" action="{{ route('upload.file') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-md-6 ">
                                            <label for="fichier" class="text-center ">{{ __('telecharger le fichier') }}</label>

                                            <input type="file" name="fichier" id="fichier" class="form-control" readonly>
                                        </div>
                                        <div class="col-md-6 " style="margin-top: 30px;">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __(' telecharger') }}
                                            </button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form id="myForm" method="POST" action="{{ route('unitsColisScannerDecharge.update',  $unit->id) }}">
                                    @csrf

                                    <div class="mb-5">
                                        <select name="entrepot_id" id="entrepot_id" class="form-control">
                                            <option value="">Selectionner un entrepot</option>
                                            @foreach($entrepots as $entrepot)
                                            <option value="{{$entrepot->id}}">{{$entrepot->name}}_{{$entrepot->address}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group row">

                                        <label for="codes_scannes" class="text-center ">{{ __('SCAN Multiples des Codes-barres des colis
                                                (séparés par une
                                                        virgule les differents codes )') }}</label>

                                        <div class="col-md-12">
                                            <input type="text" id="fileContents" name="codes_scannes" class="form-control">
                                        </div>

                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __(' Dechargement des colis') }}
                                            </button>
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

<script>
    $(document).ready(function() {
        var fileContents = @json(session('fileContents'));

        if (fileContents) {
            $('#fileContents').val(fileContents);
        }
    });
</script>

<!-- VALIDATION -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#myForm').validate({
            rules: {
                codes_scannes: {
                    required: true,
                },
                entrepot_id: {
                    required: true,
                },
            },
            messages: {
                entrepot_id: "Veuillez sélectionner un Entrepot.",
            },
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                error.appendTo(element.closest('.form-group').find('.error-message'));
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        })
    });
</script>

@endsection