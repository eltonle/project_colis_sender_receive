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
                    <h3 class="m-0 font-weight-bold"> Chargement Conteneur</h3>
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

                            {{-- <div style="display:flex; justify-content: space-between; align-items: center">
                                <p><strong>Poids du Conteneur :</strong> <span class="badge badge-dark text-sm">{{ $unit->max_capacity }}</span> kg</p>
                                <p><strong>Poids total des Colis :</strong> <span class="badge badge-secondary text-sm">{{ $totalWeight }}</span> kg</p>
                                <p><strong>Capacité restante du Conteneur :</strong> <span class="badge badge-danger text-sm">{{ $restePoids }}</span> kg</p>
                            </div> --}}

                        </div>
                        <div class="card-body" style="margin-top: -20px;">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form  method="POST" action="{{ route('unitsColisScanner.update',  $unit->id) }}">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="codes_scannes" class="text-center ">{{ __('Codes scannés') }}</label>
            
                                        <div class="col-md-12">
                                            <textarea id="codes_scannes" class="form-control @error('codes_scannes') is-invalid @enderror" name="codes_scannes" rows="4" required autofocus>{{ old('codes_scannes') }}</textarea>
            
                                            @error('codes_scannes')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
            
                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __(' le chargement des colis') }}
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
<!-- Page specific script -->
<script>
   
</script>

@endsection