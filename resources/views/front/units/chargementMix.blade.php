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
   
        .red-border {
            border: 1px solid red;
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
                        <div id="messageErreur" style="display: none; text-align: center;color: red;font-weight: bold;"></div>
                        <div class="card-body">
                              <!-- partir pour telecharge le fichier text -->

                              <div class="row">
                             <form  method="POST" action="{{ route('upload.file') }}" enctype="multipart/form-data">
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
                                    <div class="">
                                        <div id="messageContainerTrouve" style="display: none;">
                                                <div style="display: flex; justify-content: space-between;align-items: center;">
                                                    <p id="codeTrouveMessage" style="color:darkgreen; font-weight: bold;"></p>
                                                    
                                                    <p style="margin-left: 30px;"><i id="closeMessageTrouve"  class='far fa-window-close' style='font-size: medium; color:red'></i></p>
                                                </div>
                                               
                                            </div>
                                            <div id="messageContainer" style="display: none;">
                                                <div style="display: flex; justify-content: space-between;align-items: center;">
                                                    <p id="codeNonTrouveMessage" style="color: #D50000;font-weight: bold;"></p>
                                                    <!-- <button id="closeMessage" class="" style="width: 70px;height: 30px; margin-left: 10px; margin-top: -10px;">Fermer</button> -->
                                                    <p style="margin-left: 30px;"><i id="closeMessage"  class='far fa-window-close' style='font-size: medium; color:red'></i></p>
                                                </div>
                                               
                                            </div>
                                    </div>
                                    <form id="update-form" method="post">
                                        @csrf
                                        <div class="form-row">
                                             
                                            <div class="form-group col-md-12">
                                                <select class="form-control" id="unit_id" name="unit_id"
                                                    >
                                                    <option value="">Sélectionner un Conteneur</option>
                                                    @foreach ($units as $unit)
                                                    <option value="{{ $unit->id }}">{{ $unit->name }} (No {{
                                                        $unit->numero_id }} )</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div  style="text-align: center;">
                                           
                                               <span id="error-message_champ" style="color: red;"></span>
                                          
                                            </div>
                                            
                                            <div class="form-group col-md-12 mt-4"> 
                                                <div class="text-center">
                                                    <strong for="multiple-packages">SCAN Multiples des Codes-barres des colis
                                                        (séparés par une
                                                        virgule les differents codes )</strong>
                                                </div>
                                               
                                                    <input type="text" id="fileContents" name="codes_scannes" class="form-control">
                                                   
                                            </div>

                                            <div class="form-group col-md-12">
                                                <div class="text-center">
                                                    <strong for="multiple-packages">Scan d'un Code-barre d'un colis (veuillez saisir un seul code.)</strong>
                                                </div>
                                                <input type="text" class="form-control b " id="single-code"
                                                    name="single-code" style="height: 60px "
                                                    placeholder="Saisir un Code ">
                                                    <div id="error-message"></div>
                                            </div>

                                            <div class="d-flex justify-center items-center mx-auto">
                                                <button type="submit" class="btn btn-secondary" style="width: 400px">
                                                    Effectuer l'Action</button>
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



<script>
    $(document).ready(function() {
    $('#update-form').submit(function(event) {
        event.preventDefault(); // Empêche la soumission normale du formulaire
        
        $('#error-message').text('');
        $('#error-message_champ').text('');
          // Récupérer la valeur de l'input
          var inputValue = $('#single-code').val();
        //..................................................
        var input1Value = $('#fileContents').val();

            if (input1Value !== '' && inputValue !== '') {
                // Les deux champs sont remplis, afficher le message d'erreur
                $('#error-message_champ').text('🛑 Veuillez remplir un champ 🛑.');
                return false;
            } 

        //..................................................
        // Vérifier s'il y a des espaces ou des virgules
        if (inputValue.includes(' ') || inputValue.includes(',')) {
            // Afficher le message d'erreur
            $('#error-message').text('Veuillez saisir un seul code : espace et virgule non conseillé 📛.');
            $('#error-message').css('color', 'red');
            return false;

        } 


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
                var message = 'Nombre de colis charges : ' + response.count + '\n';
                var codeNonTrouveMessage = 'Codes des colis non trouvés : ' + codesNonTrouve.join(', ');
                // message += 'Codes des colis mis à jour : ' + response.codes.join(', ');
                 
                if (codeTrouve.length > 0) {                
                    // alert(message);
                  
                    $('#codeTrouveMessage').text(message);
                    $('#messageContainerTrouve').show(); // Affiche la div
                }
                
                 // Afficher le message des codes non trouvés
                if (codesNonTrouve.length > 0) {
                    $('#codeNonTrouveMessage').text(codeNonTrouveMessage);
                    $('#messageContainer').show(); // Affiche la div
                    // alert(codeNonTrouveMessage);
                }
               
                // alert('Statut mis à jour avec succès !');
                // Réinitialise les champs du formulaire
               
                $('#unit_id').val('');
                $('#fileContents').val('');
                $('#single-code').val('');

                // if (response.success==='false') {
                //     alert('response.success');
                // }
            },
            error: function(xhr,error) {
                var errorMessage = JSON.parse(xhr.responseText).error;
                    // alert('Erreur lors du chargement de la vue : ' + errorMessage);
                    // alert('Une erreur est survenue lors de la mise à jour du statut.');
                    $('#messageErreur').text(errorMessage).show();

                    // Cachez le message d'erreur après 3 secondes
                    setTimeout(function () {
                        $('#messageErreur').hide();
                    }, 3000);
            }

         });

        });

        $('#closeMessage').click(function () {
            $('#messageContainer').hide(); // Cache la div lorsque l'utilisateur clique sur "Fermer"
        });
        $('#closeMessageTrouve').click(function () {
            $('#messageContainerTrouve').hide(); // Cache la div lorsque l'utilisateur clique sur "Fermer"
        });
    });
</script>



<script>
    $(document).ready(function() {
        var fileContents = @json(session('fileContents'));

        if (fileContents) {
            $('#fileContents').val(fileContents);
        }
    });
</script>
@endsection