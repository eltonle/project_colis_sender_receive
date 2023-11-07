@extends('layouts.master')
@section("css")
<link rel="stylesheet" href="{{ asset('build/css/intlTelInput.min.css') }}">
<link rel="stylesheet" href="{{ asset('build/css/intlTelInput.css') }}">
<style>
    .hide {
        display: none;
    }

    .error0 {
        color: green;
    }

    .error1 {
        color: red;
    }
</style>
<style>
    .btn,
    /* .NoPrint {
        display: none;
    } */

    .form-control {
        border: 0px;
    }

    .input-group-text {
        border: 0px;
        color: black ;
        font-weight: bold;
        background-color: white;
        width: 100px;
    }

    table {
        border: 1px solid black;
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
                    <h3 class="m-0 font-weight-bold"> Gestions des Expeditions</h3>
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
                <div class="">
                    <form action="{{ route('invoices.store') }}" method="post" enctype="multipart/form-data"
                        id="myForm">
                        @csrf
                        {{-- left col
                        <section class="col-md-12">
                            {{-- custom tabs --}}
                            <div class="card">
                                <div class="card-header">
                                    <h3> Ajouter une Expedition
                                        <a href="{{ route('invoices.pending.list') }}" class="btn float-right btn-sm"
                                            style="background: #563DEA;color: #fff">
                                            <i class="fa fa-list"></i> LISTES DES EXPEDITIONS
                                        </a>
                                    </h3>
                                </div><!-- /.card-header -->
                                <div class="card-body">
                                    <!-- /.card-header -->
                                    <div class="form-row">
                                        <div class="form-group col-md-2">
                                            <label> Récépissé No:</label>
                                            <input type="text" name="invoice_no" value="{{ $invoice_no }}"
                                                id="invoice_no" class="form-control form-control-sm font-bold" readonly
                                                style="background: #2962FF;color: #fff">
                                        </div>
                                        <div class="form-group col-md-6">
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label>Date</label>
                                            <input type="date" name="date" id="date" value="{{ $date }}"
                                                class="form-control datepicker form-control-sm" placeholder="YYY-MM-DD"
                                                readonly>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                
                                    {{-- left col --}}
                                    <section class="col-md-12">

                                        <div class="card-header">
                                            <h3><i class="fas fa-user-friends" style="color: #2c3e50"></i>
                                                Information
                                                sur l'Expediteur:
                                            </h3>
                                        </div>
                                        <!-- expediteur -->
                                        <div class="form-group col-md-12" style="margin-top: 20px">
                                            <label>NOM DE L'EXPEDITEUR</label> <button type="button" data-toggle="modal"
                                                id="btn_id" data-target="#modal-lg" title="Ajouter un Expediteur"
                                                class="btn btn-sm float-end"
                                                style="background: #563DEA; color: #fff;  margin-bottom: 5px;"><i
                                                    class="fa fa-plus"></i></button>

                                            <select name="customer_id" id="customer_id" required
                                                class="form-control select2 select2-danger form-control-sm"
                                                data-dropdown-css-class="select2-gray">
                                                <option value="">Selectionner un Expediteur</option>
                                                @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}">
                                                    {{ $customer->nom }}-({{ $customer->email }} - {{
                                                    $customer->phone }} - {{ $customer->address }})
                                                </option>
                                                @endforeach

                                                {{-- <option value="0"> Ajouter un Nouveau Expediteur</option> --}}

                                            </select>
                                        </div>


                                        <br><br>
                                        <!-- destinataire -->
                                        <div class="card-header">
                                            <h3><i class="fas fa-user-friends" style="color: #2c3e50"></i>
                                                Information
                                                sur le Destinataire:
                                            </h3>
                                        </div>
                                        <div class="form-group col-md-12" style="margin-top: 20px">
                                            <label>NOM DU DESTINATAIRE</label>
                                            <button type="button" id="btn_id_1" title="Ajouter un Destinataire"
                                                data-toggle="modal" data-target="#modal-lg1"
                                                class="btn btn-sm float-end"
                                                style="background: #563DEA; color: #fff;  margin-bottom: 5px;"><i
                                                    class="fa fa-plus"></i></button>

                                            <select name="receive_id" id="receive_id"
                                                class="form-control select2 select2-danger form-control-sm"
                                                data-dropdown-css-class="select2-gray">
                                                <option value="">Selectionner un Destinataire</option>
                                                @foreach ($receives as $receive)
                                                <option value="{{ $receive->id }}">
                                                    {{ $receive->nom }}-({{ $receive->email }} - {{
                                                    $receive->phone }} - {{ $receive->address }})
                                                </option>
                                                @endforeach
                                                {{-- <option value="0"> Ajouter un Nouveau Destinataire</option>
                                                --}}
                                            </select>
                                        </div>


                                        {{-- country sender and receive --}}
                                        <div class="row mt-5">
                                            {{-- send --}}
                                            <div class="col-md-6">
                                                <div class="card card-gray">
                                                    <div class="card-header">

                                                        <h3 class="card-title">
                                                            <i class="fas fa-globe-africa text-dark"></i>
                                                            Expedition
                                                        </h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="form-group">
                                                            <label>Pays d'Expedition</label>
                                                            <div class="input-group">
                                                                <select
                                                                    class="form-control select2 select2-danger form-control-sm" 
                                                                    data-dropdown-css-class="select2-gray"
                                                                    id="country_id" name="country_id">
                                                                    <option value="">Selectionner un Pays</option>
                                                                    @foreach ($countries as $country)
                                                                    <option value="{{ $country->id }}">{{
                                                                        $country->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Ville d'Expedition</label>
                                                            <div class="input-group">
                                                                <select name="state_id"
                                                                    class="form-control select2 select2-danger form-control-sm"
                                                                    data-dropdown-css-class="select2-gray"
                                                                    id="state_id">
                                                                    <option value="">Selectionner une Ville</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- receive --}}
                                            <div class="col-md-6">
                                                <div class="card card-gray">
                                                    <div class="card-header">
                                                        <h3 class="card-title">

                                                            <i class="fas fa-globe-africa text-dark"></i>
                                                            Destination
                                                        </h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="form-group">
                                                            <label>Pays Destination</label>

                                                            <div class="input-group">
                                                                <select
                                                                    class="form-control select2 select2-danger form-control-sm"
                                                                    data-dropdown-css-class="select2-gray"
                                                                    id="countryr_id" name="countryr_id">
                                                                    <option value="">Selectionner un Pays</option>
                                                                    @foreach ($countries as $country)
                                                                    <option value="{{ $country->id }}">{{
                                                                        $country->name }}</option>
                                                                    @endforeach
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Ville Destination</label>

                                                            <div class="input-group">
                                                                <select
                                                                    class="form-control select2 select2-danger form-control-sm"
                                                                    data-dropdown-css-class="select2-gray"
                                                                    id="stater_id" name="stater_id">
                                                                    <option value="">Selectionner une Ville</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                                
                                      
                                      
                                        {{-- DISPLAY COLIS --}}
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card  card-tabs">
                                                    <div class="card-header" style="margin-bottom: 10px">
                                                        <h3><i class="	fas fa-file-alt" style="color: #2c3e50"></i>
                                                            Liste Colis Ajouter

                                                        </h3>
                                                    </div>
                                                    {{-- <div class="row"> --}}

                                                        <div id="card-container" class=" row  m-1">

                                                        </div>
                                                        <div id="card-container1" class=" row  m-1">

                                                        </div>

                                                        {{--
                                                    </div> --}}

                                                    <!-- /.card -->
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row mt-3">
                                            <div class="col-7">
                                            </div>
                                            <div class="col-5">
                                                {{-- <div class="input-group mb-3">
                                                    <span class="input-group-text">Total</span>
                                                    <input type="text" class="form-control text-end" id="FTotal"
                                                        name="FTotal" disabled="" value="0">
                                                </div> --}}
                                                {{-- <div class="input-group mb-3">
                                                    <span class="input-group-text">TAX</span>
                                                    <input type="text" class="form-control text-end" id="tva" name="tva"
                                                        onchange="GetTotal()" value="0">
                                                </div> --}}
                                                {{-- <div class="input-group mb-3">
                                                    <span class="input-group-text">Remise</span>
                                                    <input type="text" class="form-control text-end" id="FGST" value="0"
                                                        name="discount_amount" onchange="GetTotal()">
                                                </div> --}}
                                                {{-- <div class="input-group mb-3">
                                                    <span class="input-group-text">GST</span>
                                                    <input type="number" class="form-control text-end" id="FGST"
                                                        name="FGST" onchange="GetTotal()">
                                                </div> --}}
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text text-danger font-weight-bold">Grand
                                                        Total </span>
                                                    <input type="text" class="form-control text-end" id="FNet"
                                                        name="total_amount" readonly>
                                                    <div class="mt-2 ml-1 font-bold">FCFA</div>
                                                </div>


                                            </div>
                                        </div>
                                   


                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card  card-tabs">
                                            <div class="card-header" style="margin-bottom: 10px">
                                                <h3><i class="	fas fa-file-alt" style="color: #2c3e50"></i>
                                                    Ajouter Colis
                                                    :
                                                </h3>
                                            </div>
                                            {{-- button modal colis dimmensionne --}}
                                            <div class="d-flex justify-content-between p-4">
                                                <button type="button" class="btn btn-dark" data-toggle="modal"
                                                    data-target="#modal-lg-dim">
                                                    Ajouter un Colis Dimensionne
                                                </button>
                                                <button type="button" class="btn btn-dark" data-toggle="modal"
                                                    data-target="#modal-lg-prix">
                                                    Ajouter un Colis A Prix
                                                </button>
                                                <button type="button" class="btn btn-dark" data-toggle="modal"
                                                    data-target="#modal-lg-standard">
                                                    Ajouter un Colis Standard
                                                </button>
                                            </div>

                                            <!-- /.card -->
                                        </div>
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="" style="font-weight:bold ">Entrer un Montant <i
                                                class="fas fa-donate text-danger"></i></label>

                                        <input type="text" name="paid_amount" class="form-control form-control-sm"
                                            placeholder="Entrer un Montant" value="0" id="paid_amount">
                                        <div id="somme" style="display: none">
                                            <span class="text-sm text-danger font-weight-bold font-italic">Le
                                                Montant saisi est superieur au Grand Total
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="" style="font-weight:bold ">Status de l'expedition <i
                                                class="fas fa-dolly-flatbed text-danger"></i></label>
                                        <select name="status_livraison"
                                            class="form-control select2 select2-danger form-control-sm"
                                            data-dropdown-css-class="select2-danger" id="status_livraison">
                                            <option value="">Selectionner le Status de l'expedition</option>
                                            <option value="en embarcation">En Embarcation</option>                                            
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="package_id" style="font-weight:bold ">Selectionner Entrepot
                                            <i class="fas fa-truck text-danger"></i></label>
                                        <select name="entrepot_id"
                                            class="form-control select2 select2-danger form-control-sm"
                                            data-dropdown-css-class="select2-danger" id="package_id">
                                            <option value="">Selectionner un Conteneur</option>
                                            @foreach ($entrepots as $entrepot )
                                            <option value="{{ $entrepot->id }}">{{ $entrepot->name }}-({{
                                                $entrepot->address
                                                }} - {{ $entrepot->ville }})
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="package_id" style="font-weight:bold ">
                                            Description</label>
                                        <textarea name="description" class="form-control col-md-12"></textarea>
                                    </div>
                                </div>
                                <div class="col-row">
                                    <div class="form-group col-md-4">
                                        <button type="submit" class="btn btn-dark w-100" id="submit">
                                            Enregistrer les
                                            Informations </button>
                                    </div>

                                    <div class="col-5"></div>
                                    <div class="col-3"></div>
                                </div>

                        </section>
                        {{--
                </div> --}}

            </div>
            </section>

            </form>
        </div>
    </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->

<!-- /.MODAL Exp -->
<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-user-alt"></i>
                    Ajouter un Expediteur
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('customers.storeExp') }}" method="post" id="myFomExp">
                @csrf
                <div class="modal-body">
                    {{-- <p>One fine body&hellip;</p> --}}
                    <div class="form-row col-md-12 ">
                        <div class="form-group col-md-4">
                            <label for="">Nom</label>
                            <input type="text" name="nom" class="form-control form-control-sm"
                                placeholder="Nom du Client">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Prenom</label>
                            <input type="text" name="prenom" class="form-control form-control-sm"
                                placeholder="Prenom du Client">
                        </div>
                        <div class="form-group col-md-4">
                            <label for=""> Email</label>
                            <input type="email" name="email" class="form-control form-control-sm"
                                placeholder="Email du Client">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Address</label>
                            <input type="text" name="address" class="form-control form-control-sm"
                                placeholder="Address du Client">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Phone</label>
                            <input type="tel" id="phone" name="phone" class="form-control form-control-sm">
                            <span id="valid-msg" class="hide error0 text-sm">✓
                                Valid</span>
                            <span id="error-msg" class="hide error1"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">
                        Sauvegarder</button>
                </div>
            </form>
        </div>

    </div>

</div>
<!-- /.Modal End-->

<!-- MODAL Dex -->
<div class="modal fade" id="modal-lg1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-user-alt"></i>
                    Ajouter un Destinataire
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('customers.storeDex') }}" method="post" id="myFomDex">
                @csrf
                <div class="modal-body">
                    {{-- <p>One fine body&hellip;</p> --}}
                    <div class="form-row col-md-12">
                        <div class="form-group col-md-4">
                            <label for="">Nom</label>
                            <input type="text" name="nomr" class="form-control form-control-sm"
                                placeholder="Nom du recepteur">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Prenom</label>
                            <input type="text" name="prenomr" class="form-control form-control-sm"
                                placeholder="prenom du recepteur">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Email</label>
                            <input type="email" name="emailr" class="form-control form-control-sm"
                                placeholder="email du recepteur">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Address</label>
                            <input type="text" name="addressr" class="form-control form-control-sm"
                                placeholder="Address du recepteur">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Phone</label>
                            <input type="tel" id="phoner" name="phoner" class="form-control form-control-sm">
                            <span id="valid-msgr" class="hide error0 text-sm">✓ Valid</span>
                            <span id="error-msgr" class="hide error1"></span>
                        </div>

                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">
                        Sauvegarder</button>
                </div>
            </form>
        </div>

    </div>

</div>
<!-- /.Modal End-->


<!-- MODAL COlIS DIMENSIONNE-->
<div class="modal fade" id="modal-lg-dim">
    <div class="modal-dialog modal-lg">

        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fas fa-cubes text-primary"></i> Colis Dimensionné</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="text-center mt-5">
                 <p id="messageDim" style="display: none; color: #2962FF; font-size: 25px;"></p>
            </div>
            <form id="formDim" action="{{ route('colisDim.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <!-- col1 -->
                        <div class="col-sm-8" style="margin-left:20px;">

                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Titre :</label>
                                        <input type="text" id="titre" class="form-control" placeholder="Titre"
                                            name="titre" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Nombre de colis :</label>
                                        <input type="number" id="quantite" class="form-control"
                                            placeholder="Nombre de colis" name="quantite" value="1">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Largeur (en cm) :</label>
                                        <input type="number" class="form-control" placeholder="Largeur du colis"
                                            id="largeur" name="largeur">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Longueur (en cm) :</label>
                                        <input type="number" class="form-control" placeholder="Longueur du colis"
                                            id="longueur" name="longueur">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Hauteur (en cm) :</label>
                                        <input type="number" class="form-control" placeholder="Hauteur du colis"
                                            id="hauteur" name="hauteur">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <!-- text input -->
                                    {{-- <div class="form-group">
                                        <label>Ajouter une photo...</label>
                                        <input type="file" class="form-control" id="photo" placeholder="Enter ..."
                                            name="photo">
                                    </div> --}}
                                    <div class="form-group">
                                        <label>Poids du colis (en kg)</label>
                                        <input type="number" class="form-control" id="poids" placeholder="Enter ..."
                                            name="poids">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <textarea name="description" placeholder="description ...."
                                        class="form-control"></textarea>
                                </div>
                            </div>

                        </div>
                        <!-- col2 -->
                        <div class="col-sm-3 text-center " style="border:2px solid black;  margin-left:40px;">
                            <div class="row mx-auto ">
                                <div class="form-group">
                                    <label>Prix par kilogramme</label>
                                    <input type="number" class="form-control" id="prix_kilo" value="650"
                                        name="prix_kilo">
                                </div>
                                <div class="form-group">
                                    <label>prix par metre cube </label>
                                    <input type="number" class="form-control" id="prix_vol" value="650" name="prix_vol">
                                </div>
                                <div class="form-group">
                                    <label>Facteur de Conversion</label>
                                    <input type="number" class="form-control" id="conversion" value="1000"
                                        name="conversion">
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 50px">
                            <div class="col-md-6 ">
                                <div class="row">
                                    <div class="col-md-6 font-weight-bold mt-2">
                                        Prix groupé en FCFA:
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="total" id="total" class="form-control" value="0"
                                            readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">

                                <div class="row">
                                    <div class="col-md-6 mt-2 font-weight-bold">
                                        Prix d'un colis en FCFA
                                        :
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="prix" id="prix" class="form-control" value="0"
                                            readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-around m-3">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Enregistrer le Colis
                    </button>
                </div>
            </form>
           
        </div>
        <!-- /.modal-content -->

    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.Modal End-->

<!-- MODAL COlIS A PRIX -->
<div class="modal fade" id="modal-lg-prix">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> <i class="fas fa-cubes text-primary"></i> Colis a Prix</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="text-center mt-5">
                 <p id="messagePrix" style="display: none; color: #2962FF; font-size: 25px;"></p>
            </div>
            <form id="formPrice" action="{{ route('colisDim.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="">Titre :</label>
                            <input type="text" name="titre" id="titre1" placeholder="titre..." class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Nombres de Pieces :</label>
                            <input type="number" name="quantite" id="qty" min="1" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="poids">Poids du Colis :</label>
                            <input type="number" name="poids" id="poids" min="1" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Coût en FCFA :</label>
                            <input type="number" name="prix_unitaire" id="prix1" min="1" value="0" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Prix d'un colis en FCFA :</label>
                            <input type="number" name="prix" id="prix_unit" min="0" value="0" readonly
                                class="form-control">
                        </div>
                        <div class="form-group col-md-12">
                            <textarea name="description" id="" class="form-control"
                                placeholder="description ....."></textarea>
                        </div>
                        <div class=" row">
                            <div class="col-md-4 text-md mt-2 ml-0">Prix Total en FCFA :</div>
                            <div class="col-md-4">
                                <input type="number" name="total" id="prix_total" min="0" value="0" readonly
                                    class="form-control ">
                            </div>
                            <div class="col-md-4 text-md mt-2"> FCFA </div>

                        </div>
                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Enregistrer le Colis
                    </button>
                </div>
            </form>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- MODAL COlIS STANDARD -->
<div class="modal fade" id="modal-lg-standard">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fas fa-cubes text-primary"></i> <strong> Listes des colis
                        standards</strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">

                    <div class="card-header">
                        <h2 class="card-title" style="font-size: 22px;">
                            <strong>Enregistrer un Colis</strong>
                        </h2>
                    </div>
                    <div class="text-center mt-3">
                        <p id="messagePrix" style="display: none; color: #2962FF; font-size: 25px;"></p>
                    </div>
                    <div class="card-body ">
                        <form action="" method="POST" id="formStand">
                            @csrf

                            <div class="row" style="width: 100%; margin-left: 4px; height:300px ;background:#f2f2f6;">
                                <h5 class=" text-center mt-2"><strong>Ajout d'un colis standard</strong></h5>
                            
                                <div class=" col-sm-12 text-center mt-2">
                                    <input type="text" name="titre" class="form-control" placeholder="titre...">
                                </div>
                                <div class=" col-sm-6 text-center mt-2">
                                    <input type="number" name="prix" class="form-control" placeholder="prix ...">
                                </div>
                                <div class=" col-sm-6 text-center mt-2">
                                    <input type="number" name="largeur" class="form-control" placeholder="largeur ...">
                                </div>
                                <div class=" col-sm-6 text-center mt-2">
                                    <input type="number" name="longueur" class="form-control"
                                        placeholder="longueur ...">
                                </div>
                                <div class=" col-sm-6 text-center mt-2">
                                    <input type="number" name="hauteur" class="form-control" placeholder="hauteur ...">
                                </div>
                                
                                <div class="col-md-12 mt-2">
                                    <textarea name="description" id="" class="form-control"
                                        placeholder="une description ..." cols="5" rows=""></textarea>
                                </div>
                                <div class="mt-2 text-center">
                                    <button type="submit" class="btn btn-primary btn-sm">Ajouter
                                        colis</button>
                                </div>
                            </div>
                        </form>
                        <div class="text-center mt-5">
                          <p id="messageStand" style="display: none; color: #2962FF; font-size: 25px;"></p>
                        </div>
                        <table class="table table-bordered mt-3 " id="tableColisStandard">
                            <thead style="background-color:#636e72; color:white;">
                                <tr>
                                    <th>#</th>
                                    <th>Type</th>
                                    <th>Titre</th>
                                    <th>Prix en FCFA</th>
                                </tr>
                            </thead>
                            <tbody id="tbodycol">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer float-right">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Fermer
                </button>
                
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

</div>
<!-- /.Modal End-->


<!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
@section('scripts')
<!-- ADD IN INVOICE -->
<script>

   function sumAjax() {
    $.ajax({
        url: "{{ route('sommeTotal') }}",
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            console.log(data);
            var totalsum = 0;
       $.each(data, function(i,elt){
          console.log(elt);
          totalsum += parseInt(elt);
        })
        console.log(totalsum);
        GetTotal(totalsum);
        //  return totalsum;
        }
    });
   }

    function GetTotal(t) {
       
        var net =  t;
        document.getElementById('FNet').value = net;
    }
</script>
<!-- Number script -->
<script src="{{ asset('build/js/intlTelInput.min.js') }}"></script>
<script src="{{ asset('build/js/intlTelInput.js') }}"></script>
<script>
    var input = document.querySelector("#phone"),
    errorMsg = document.querySelector("#error-msg"),
    validMsg = document.querySelector("#valid-msg");

    // here, the index maps to the error code returned from getValidationError - see readme
    var errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];

    // initialise plugin
    var iti = window.intlTelInput(input, {
    utilsScript: "{{ asset('build/js/utils.js') }}", 
    initialCountry:"tr",
    nationalMode: false
    });

    var reset = function() {
    input.classList.remove("error");
    errorMsg.innerHTML = "";
    errorMsg.classList.add("hide");
    validMsg.classList.add("hide");
    };

    // on blur: validate 
    input.addEventListener('blur', function() {
    reset();
    if (input.value.trim()) {
    if (iti.isValidNumber()) {
    validMsg.classList.remove("hide");
    } else {
    input.classList.add("error");
    var errorCode = iti.getValidationError();
    errorMsg.innerHTML = errorMap[errorCode];
    errorMsg.classList.remove("hide");
    }
    }
    });

    // on keyup / change flag: reset
    input.addEventListener('change', reset);
    input.addEventListener('keyup', reset);
</script>


{{-- number recieve --}}
<script>
    var inputr = document.querySelector("#phoner"),
    errorMsgr = document.querySelector("#error-msgr"),
    validMsgr = document.querySelector("#valid-msgr");

    // here, the index maps to the error code returned from getValidationError - see readme
    var errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];

    // initialise plugin
    var itir = window.intlTelInput(inputr, {
    utilsScript: "{{ asset('buildr/js/utils.js') }}", 
    initialCountry:"tr",
    nationalMode: false
    });

    var reset = function() {
    input.classList.remove("error");
    errorMsg.innerHTML = "";
    errorMsg.classList.add("hide");
    validMsg.classList.add("hide");
    };

    // on blur: validate
    input.addEventListener('blur', function() {
    reset();
    if (inputr.value.trim()) {
    if (itir.isValidNumber()) {
    validMsgr.classList.remove("hide");
    } else {
    inputr.classList.add("error");
    var errorCoder = itir.getValidationError();
    errorMsgr.innerHTML = errorMap[errorCoder];
    errorMsgr.classList.remove("hide");
    }
    }
    });

    // on keyup / change flag: reset
    inputr.addEventListener('change', reset);
    inputr.addEventListener('keyup', reset);
</script>>


<script>
    //  Compare value 
  $(document).ready(function () {
    $('#paid_amount').change(function () {
        // console.log($(this).val());
        var paid_amount = document.getElementById('paid_amount').value;
       console.log(paid_amount);
       var total_paid = document.getElementById('FNet').value;
       console.log(total_paid);
       if (parseInt(paid_amount) > parseInt(total_paid)) {
         $('#somme').show('');
         $('#paid_amount').addClass('is-invalid');
         $('#submit').addClass('disabled');
       }else{
        $('#somme').hide('');    
        $('#submit').removeClass('disabled');
       }
    })
      
    })
</script>
<script>
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()
    })
    //Initialize Select2 Elements
   
</script>

<script type="text/javascript">
    $(function(){
    $(document).on('change','#country_id', function() {
        var country_id = $(this).val();
        $.ajax({
            url:"{{ route('get-states') }}",
            type:"GET",
            data:{country_id:country_id},
            success:function(data){
                var html = '<option value="">Selectionner une ville</option>';
                $.each(data,function(key,v) {
                    html +='<option value="'+v.id+'">'+v.name+'</option>';
                });
                $('#state_id').html(html);
            }
        });
    });
  });
</script>
<script type="text/javascript">
    $(function(){
    $(document).on('change','#countryr_id', function() {
        var countryr_id = $(this).val();
        $.ajax({
            url:"{{ route('get-states-receive') }}",
            type:"GET",
            data:{countryr_id:countryr_id},
            success:function(data){
                var html = '<option value="">Selectionner une ville</option>';
                $.each(data,function(key,v) {
                    html +='<option value="'+v.id+'">'+v.name+'</option>';
                });
                $('#stater_id').html(html);
            }
        });
    });
  });
</script>
<!-- Page specific script -->
<script type="text/javascript">
    $(document).ready(function(){
    $('#myFomExp').validate({
        rules:{
            nom: {
                required:true,
            },
            prenom: {
                required:true,
            },
            email: {
                required:true,
            },
            address: {
                required:true,
            },
            phone: {
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
    $(document).ready(function(){
    $('#myFomDex').validate({
        rules:{
            nomr: {
                required:true,
            },
            prenomr: {
                required:true,
            },
            emailr: {
                required:true,
            },
            addressr: {
                required:true,
            },
            phoner: {
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
    $(document).ready(function(){
    $('#myForm').validate({
        rules:{
            status_livraison: {
                required:true,
            },
            customer_id: {
                    required: true, // Ajoutez cette règle pour le champ de sélection
            },
            receive_id: {
                required:true,
            },
            country_id: {
                required:true,
            },
            state_id: {
                required:true,
            },
            countryr_id: {
                required:true,
            },
            stater_id: {
                required:true,
            },
            entrepot_id: {
                required:true,
            },
        },
            messages: {
                customer_id: "Veuillez sélectionner un Expediteur.",
                receive_id: "Veuillez sélectionner un Destinataire.",
                entrepot_id: "Veuillez sélectionner un Entrepot.",
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

{{-- SCRIPT des COLIS DIMENSIONS --}}

<script>
    function refreshContent() {
    // getData
    $.ajax({
        url: "{{ route('getDataDim') }}",
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            console.log(data);
            $('#card-container').empty(); // vider la div
            $.each(data, function(index, element) {

                var cardHtml = '<div class="card col-md-3  data-list"  id="element-' + element.id + '">';
                cardHtml += '<div class=" d-flex justify-content-between mt-1">';
                cardHtml += '<h6 class="font-bold text-lg">' + element.titre + '</h6>';
                cardHtml += '<p id="' + element.id + '"> <i class="far fa-window-close delete-btn" style="font-size:24px"></i> </p>';
            

                cardHtml += '</div>';
                if(element.type == "colis a prix" ){
                cardHtml += '<div class="d-flex justify-content-between align-items-center">';
                cardHtml += '<p  style="font-size:18px; font-weight:bold;">' + 'type :' + '</p>';
                    cardHtml += '<p class="font-bold">' + 'Colis a Prix' + '</p>';
                    cardHtml += '</div>';
                }
                if(element.type == "colis standard"){
                cardHtml += '<div class="d-flex justify-content-between align-items-center">';
                cardHtml += '<p  style="font-size:18px; font-weight:bold;">' + 'type :' + '</p>';
                    cardHtml += '<p class="font-bold">' + 'Colis Standard' + '</p>';
                    cardHtml += '</div>';
                }
                if(element.type == "colis dimension" ){
                cardHtml += '<div class="d-flex justify-content-between align-items-center">';
                cardHtml += '<p style="font-size:18px; font-weight:bold;">' + 'type :' + '</p>';
                    cardHtml += '<p class="">' + 'Colis  dimensionné' + '</p>';
                    cardHtml += '</div>';
                }
                if(!(element.largeur == null) ){
                cardHtml += '<div class="d-flex justify-content-between align-items-center" style="margin-top:-5px;">';
                cardHtml += '<p class="text-md">' + 'Largeur :' + '</p>';
                    cardHtml += '<p class="">' + element.largeur + '</p>';
                    cardHtml += '</div>';
                }
                if(!(element.longueur == null) ){
                cardHtml += '<div class="d-flex justify-content-between align-items-center" style="margin-top:-20px;">';
                cardHtml += '<p class="text-md">' + 'Longueur :' + '</p>';
                cardHtml += '<p class="">' + element.longueur + '</p>';
                cardHtml += '</div>';
                }
                if(!(element.hauteur == null) ){
                cardHtml += '<div class="d-flex justify-content-between align-items-center" style="margin-top:-20px;">';
                cardHtml += '<p class="text-md">' + 'Hauteur :' + '</p>';
                cardHtml += '<p class="">' + element.hauteur + '</p>';
                cardHtml += '</div>';
                }

               

                // cardHtml += '<div class="d-flex justify-content-between align-items-center">';
                // cardHtml += '<p class="text-md">' + 'Poids  :' + '</p>';
                // cardHtml += '<p class="">' + element.poids + ' Kg' + '</p>';
                // cardHtml += '</div>';

                cardHtml += '<div class="d-flex justify-content-between align-items-center" style="margin-top:-20px;">';
                cardHtml += '<p class="text-md">' + 'prix :' + '</p>';
                cardHtml += '<p class="">' + element.prix + ' FCFA' + '</p>';
                cardHtml += '</div>';

                cardHtml += '</div></div>';

              $('#card-container').append(cardHtml);
        
          });
          sumAjax(); 
        }
    });
 }
    $(document).ready(function () {
        // Store
        $('#formDim').submit(function (event) {
             event.preventDefault();
             var formData = $(this).serialize();
              
             console.log(formData);
             var q = $('#quantite').val();
             for(var i = 0;i < q; i++){
             $.ajax({
                type: 'POST',
                url: "{{ route('colisDim.store') }}",
                data: formData,
                success: function(response) {
                    $('#formDim')[0].reset(); // Réinitialiser le formulaire
                    $('#messageDim').text(response.message).fadeIn();                    
                    setTimeout(function () {
                    $('#messageDim').fadeOut();
                    }, 2000);
                    refreshContent();
                },
                error : function (error) {
                    console.log(error);
                }
             })
            }
        })

         refreshContent(); // appeler refreshContent pour la première fois
        //  setInterval(refreshContent, 2000); // actualiser toutes les 2 secondes

            //    DELETE DATA
            $('#card-container').on('click', '.delete-btn', function() {
                var id = $(this).parent().attr('id'); // Récupère l'ID de l'élément parent
                console.log(id);
                // Envoyer une requête AJAX à votre route de suppression avec l'ID récupéré
                $.ajax({
                    url: '/expeditions/delet/' + id,
                    // url: '/invoices/delet/' + id,
                type: 'POST',
                success: function(data) { 
                    console.log('delete');
                    $('#element-' + id).remove();
                    sumAjax(); 
                },
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                });
            });

           
     })

</script>

{{-- SOMME COLIS DIM --}}
<script>
    $(document).ready(function () {
          //    CALCUL DE LA SOMME 
     
          function calcul(quantite,largeur,longueur,hauteur,poids,prix_kilo,prix_vol,conversion) {
             
            var volume = longueur*largeur*hauteur / conversion;
            var prixVolume = volume*prix_vol;

            var prixPoidsUn = poids*prix_kilo;
            
            var prixTotalUn = Math.round(prixPoidsUn + prixVolume);
            var prixTotalNbre = Math.round(prixPoidsUn*quantite + prixVolume*quantite);
            $("#prix").val(prixTotalUn);
            $("#total").val(prixTotalNbre);
            console.log(volume);
        }

            // Événement à déclencher quand les inputs de poids et de volume sont modifiés
            $("#largeur,#longueur,#hauteur,#poids,#prix_kilo,#prix_vol, #total, #prix,#quantite,#conversion").on("input", function() {
            // Récupération des valeurs de poids et de volume

            var quantite = $('#quantite').val();
            var largeur = $('#largeur').val();
            var longueur = $('#longueur').val();
            var hauteur = $('#hauteur').val();
            var conversion = $('#conversion').val();
            var poids = $('#poids').val();
            var prix_kilo = $('#prix_kilo').val();
            var prix_vol = $('#prix_vol').val();
            var total = $("#total").val();
            var prix = $("#prix").val();
            
            // Calcul du prix en fonction du poids et du volume
             calcul(quantite,largeur,longueur,hauteur,poids,prix_kilo,prix_vol,conversion);
        });
    })
</script>


{{-- SCRIPT de COLIS PRIX --}}

<script>
    function refreshContentPrice() {
        // getData
        // $.ajax({
        //     url: "{{ route('getDataPrix') }}",
        //     type: 'GET',
        //     dataType: 'json',
        //     success: function(data) {
        //         console.log(data);
        //         $('#card-container1').empty(); // vider la div
        //         $.each(data, function(index, element) {
        //             var cardHtml1 = '<div class="card col-md-3  data-list"  id="element-' + element.id + '">';
        //             cardHtml1 += '<div class=" d-flex justify-content-between mt-1">';
        //             cardHtml1 += '<h6 class="font-bold text-lg">' + element.titre + '</h6>';
        //             cardHtml1 += '<p id="' + element.id + '"> <i class="far fa-window-close delete-btn1" style="font-size:24px"></i> </p>';
        //             cardHtml1 += '</div>';
                
        //             cardHtml1 += '<div class="d-flex justify-content-between align-items-center">';
        //             cardHtml1 += '<p class="text-md">' + 'Quantité  :' + '</p>';
        //             cardHtml1 += '<p class="">' + element.qty + ' PCs' + '</p>';
        //             cardHtml1 += '</div>';

        //             cardHtml1 += '<div class="d-flex justify-content-between align-items-center">';
        //             cardHtml1 += '<p class="text-md">' + 'prix Total  :' + '</p>';
        //             cardHtml1 += '<p class="">' + element.prix_total + ' FCFA' + '</p>';
        //             cardHtml1 += '</div>';

        //             cardHtml1 += '</div></div>';

        //           $('#card-container1').append(cardHtml1);
            
        //       });
        //       sumAjax(); 
        //     }
        // });
     }

    $(document).ready(function () {

        //  STORE
         $('#formPrice').submit(function (event) {
             event.preventDefault();
             var formDataC = $(this).serializeArray();
             var q = $('#qty').val();
             for(var i = 0;i < q; i++){
             $.ajax({
                type: 'POST',
                url: "{{  route('colisPrix.store') }}",
                data: formDataC,
                success: function(response) {
                    $('#formPrice')[0].reset(); // Réinitialiser le formulaire
                    $('#messagePrix').text(response.message).fadeIn();                    
                    setTimeout(function () {
                    $('#messagePrix').fadeOut();
                    }, 2000);
                    refreshContent();
                },
                error : function (error) {
                    console.log(error);
                }
             })
            } 
        })

        // refreshContent();

          //    DELETE DATA
        // $('#card-container1').on('click', '.delete-btn1', function() {
        //     var id = $(this).parent().attr('id'); // Récupère l'ID de l'élément parent
        //     console.log(id);
        //     // Envoyer une requête AJAX à votre route de suppression avec l'ID récupéré
        //     $.ajax({
        //     url: '/invoices/deletPrix/' + id,
        //     type: 'POST',
        //     success: function(data) {
        //         console.log('delete');
        //         $('#element-' + id).remove();
        //         sumAjax(); 
        //     },
        //     data: {
        //         "_token": "{{ csrf_token() }}"
        //     },
        //     });
        //  });
     })
</script>

{{-- SOMME COLIS PRIX --}}

<script>
    $(document).ready(function () {
          //    CALCUL DE LA SOMME 
     
          function calculPrix(qty,prix1) {
             
            var prix_unit = prix1;
            var prix_unitNbr = prix1*qty;
            
            var prixTotalUn = Math.round(prix_unit);
            var prixTotalNbre = Math.round(prix_unitNbr);
            $("#prix_unit").val(prixTotalUn);
            $("#prix_total").val(prixTotalNbre);
           
        }

            // Événement à déclencher quand les inputs de poids et de volume sont modifiés
            $("#qty,#prix1").on("input", function() {
           // Récupération des valeurs de poids et de volume

            var qty = $('#qty').val();
            var prix1 = $('#prix1').val();
            
           // Calcul du prix en fonction du poids et du volume
             calculPrix(qty,prix1);
        });
     })
</script>


{{-- SCRIPT des COLIS STANDARD --}}

<script>
    function refreshContentDataColisStandard() {
    // getData
    $.ajax({
        url: "{{ route('getDataStand') }}",
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            console.log(data);
             $('#tableColisStandard tbody' ).empty(); // vider la div
            $.each(data, function(index, element) {
              var loop = index + 1;
              var cardHtml = "<tr class='data-row cursor-pointer' title='cliquer pour ajouter' data-id='" + element.id + "'>" +
                                "<td>"+ "#" + loop + "</td>" +
                                "<td>" + element.nature + "</td>" +
                                "<td>" + element.titre + "</td>" +
                                "<td>" + element.prix + " FCFA " + "</td>" +
                            "</tr>";
                               

              $('#tableColisStandard tbody').append(cardHtml);
        
            });
            }
        });
    }

    $(document).ready(function () {
        
            // Store
            $('#formStand').submit(function (event) {
                event.preventDefault();
                var formData = $(this).serialize();
                
                console.log(formData);
                $.ajax({
                    type: 'POST',
                    url: "{{ route('colisStand.store') }}",
                    data: formData,
                    success: function(response) {
                        $('#formStand')[0].reset(); // Réinitialiser le formulaire
                        $('#messagePrix').text(response.message).fadeIn();                    
                        setTimeout(function () {
                        $('#messagePrix').fadeOut();
                        }, 2000);
                        refreshContentDataColisStandard(); // celui qui va recuperer les donnees
                    },
                    error : function (error) {
                        console.log(error);
                    }
                })
            })

          refreshContentDataColisStandard(); // appeler refreshContent pour la première fois

            //    DETAILS et enregistrement
            $('#tbodycol').on('click', '.data-row', function() {

                var id = $(this).data("id");// Récupère l'ID de l'élément parent
                console.log(id);
                // Envoyer une requête AJAX pour enregistrer
                $.ajax({
                    url: '/expeditions/storeStand/' + id,
                    // url: '/invoices/storeStand/' + id,
                    type: 'GET',
                    dataType: "json",
                    success: function(response) {
                    $('#messageStand').text(response.message).fadeIn();                    
                    setTimeout(function () {
                    $('#messageStand').fadeOut();
                    }, 2000);
                    refreshContent();
                        // sumAjax(); 
                    },
                   
                });
            });
     })
</script>

@endsection