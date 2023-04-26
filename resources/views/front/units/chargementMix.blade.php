@extends('layouts.master')

@section('css')
<style>
    input::placeholder {
        font-size: 22px;
    }

    input[type="text"].b::placeholder {
        /* Couleur pour le premier champ de saisie */
        color: white;
    }

    input[type="text"].c::placeholder {
        /* Couleur pour le premier champ de saisie */
        color: white;
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
                            <h3>Chargement Conteneur
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

                                            <div class="form-group col-md-12">
                                                <select class="form-control" id="unit_id" name="unit_id"
                                                    style="font-size: 22px;">
                                                    <option value="">Sélectionner un Conteneur</option>
                                                    @foreach ($units as $unit)
                                                    <option value="{{ $unit->id }}">{{ $unit->name }} (No {{
                                                        $unit->numero_id }} )</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group col-md-12 mt-4">
                                                <div class="text-center">
                                                    <strong for="multiple-packages">SCAN Multiples Colis
                                                        (séparés par une
                                                        virgule)</strong>
                                                </div>
                                                <input type="text" class="form-control bg-primary c" id="multiple-codes"
                                                    name="multiple-codes" style="height: 110px"
                                                    placeholder="Exemple: 45364637537,5765378353,3434323433....">
                                            </div>

                                            <div class="form-group col-md-12">
                                                <div class="text-center">
                                                    <strong for="multiple-packages">Scanner un Colis</strong>
                                                </div>
                                                <input type="text" class="form-control bg-primary b" id="single-code"
                                                    name="single-code" style="height: 60px "
                                                    placeholder="Saisir un Code ">
                                            </div>

                                            <div class="d-flex justify-center items-center mx-auto">
                                                <button type="submit" class="btn btn-secondary" style="width: 400px">
                                                    Effectuer l'Action</button>
                                            </div>

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
        
        var form = $(this).closest('form');
        var data = form.serialize();

        // Envoie une requête AJAX pour mettre à jour le statut
        $.ajax({
        url: "{{ route('units.chargementMixSubmit') }}",
        method: 'POST',
        data: data,
       
         success: function(response) {
               var codesNonTrouve = response.codes_non_trouves;
               var codeTrouve = response.codes
                // Afficher le message de mise à jour
                var message = 'Nombre de colis mis à jour : ' + response.count + '\n';
                var codeNonTrouveMessage = 'Codes des colis non trouvés : ' + codesNonTrouve.join(', ');
                message += 'Codes des colis mis à jour : ' + response.codes.join(', ');
                 
                if (codeTrouve.length > 0) {                
                    alert(message);
                }
                
                 // Afficher le message des codes non trouvés
                if (codesNonTrouve.length > 0) {
                    alert(codeNonTrouveMessage);
                }
                // alert('Statut mis à jour avec succès !');
                // Réinitialise les champs du formulaire
               
                $('#unit_id').val('');
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