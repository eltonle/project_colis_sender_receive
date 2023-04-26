@extends('layouts.master')

@section('css')
<style>
    input::placeholder {
        color: red;
        font-size: 22px;
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
                    <h3 class="m-0 font-weight-bold">Gestions des Conteneurs</h3>
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
                            <h3> Dechargement Conteneur
                                <a href="{{ route('units.index') }}" class="btn float-right btn-sm"
                                    style="background: #563DEA;color: #fff">
                                    <i class="fa fa-list"></i> LISTES DES CONTENEURS
                                </a>
                            </h3>
                        </div><!-- /.card-heade-->
                        <div class="card-body">
                            <!-- /.card-header -->
                            <div class="card-body">
                                {{-- <div class="container"> --}}
                                    <form id="update-form" method="post">
                                        @csrf
                                        <div class="form-row">

                                            <div class="form-group col-md-6">
                                                <input type="text" class="form-control" id="conteneur-barcode"
                                                    name="conteneur-barcode" placeholder="Saisir le code du conteneur">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <select class="form-control" id="vehicule_id" name="vehicule_id"
                                                    style="font-size: 22px;">
                                                    <option value="">Sélectionner un véhicule</option>
                                                    @foreach ($vehicules as $vehicule)
                                                    <option value="{{ $vehicule->id }}">{{ $vehicule->Model }} ( {{
                                                        $vehicule->Type_Véhicule }}-Numero_Serie: {{
                                                        $vehicule->Numero_Serie }} )</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group col-md-12 mt-4">
                                                <label for="multiple-packages">SCAN Multiples des Code-barre des colis
                                                    (séparés par une
                                                    virgule)</label>
                                                <input type="text" class="form-control" id="multiple-codes"
                                                    name="multiple-codes" style="height: 110px"
                                                    placeholder="Exemple: 45364637537,5765378353,3434323433....">
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label for="single-package">Scanner un Colis</label>
                                                <input type="text" class="form-control" id="single-code"
                                                    name="single-code" style="height: 60px"
                                                    placeholder="Saisir un Code ">
                                            </div>

                                            <button type="submit" class="btn btn-primary"> Effectuer L'action</button>

                                        </div>
                                    </form>
                                    {{--
                                </div> --}}
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

<script>
    $(document).ready(function() {
    $('#update-form').submit(function(event) {
        event.preventDefault(); // Empêche la soumission normale du formulaire

        // Récupère les valeurs des champs
        // var conteneurBarcode = $('#conteneur-barcode').val();
        // var vehiculeId = $('#vehicule_id').val();
        // var multipleCodes = $('#multiple-codes').val();
        // var singleCode = $('#single-code').val();
        var form = $(this).closest('form');
        var data = form.serialize();
        // Envoie une requête AJAX pour mettre à jour le statut
        $.ajax({
        url: "{{ route('units.dechargementSubmit') }}",
        method: 'POST',
        data: data,
        // data: {
        //     conteneurBarcode: conteneurBarcode,
        //     vehiculeId: vehiculeId,
        //     multipleCodes: multipleCodes,
        //     singleCode: singleCode,
        //     _token: $('meta[name="csrf-token"]').attr('content')
        // },
         success: function(response) {
                alert('Statut mis à jour avec succès !');
                // Réinitialise les champs du formulaire
                $('#conteneur-barcode').val('');
                $('#vehicule_id').val('');
                $('#multiple-codes').val('');
                $('#single-code').val('');
            },
            error: function(xhr) {
            alert('Une erreur est survenue lors de la mise à jour du statut.');
            }

         });

        });
    });
</script>
@endsection