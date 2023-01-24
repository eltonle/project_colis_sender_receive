@extends('layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0 font-weight-bold">Tableau de Bord</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Tableau de Bord</a></li>
                        {{-- <li class="breadcrumb-item active">dashboard</li> --}}
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <hr>
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h4>{{ $expeditionCountThisYear }}</h4>

                            <p>Expeditions de l'Année</p>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h4>{{ $livraisonCountThisYear }}</h4>

                            <p>Livraisons de l'Année</p>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h4>{{ $livraisonCountThisMonth }}</h4>

                            <p>Livraisons du Mois</p>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h4>{{ $nbrConteneur }}</h4>

                            <p>Nombre de Conteneurs </p>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <hr>
            </div>
            <div class="card dark-mode">
                <div class="card-footer">
                    <div class="row">
                        <div class="col-sm-3 col-6">
                            <div class="description-block border-right">
                                {{-- <span class="description-percentage text-success">
                                    <i class="fas fa-caret-up"></i>
                                    17%</span> --}}
                                <h5 class="description-header">{{ number_format( $thisYearDuSum,0,'
                                    ',',') }} Fcfa</h5> <br>
                                <span class="description-text">TOTAL DÛ DE L'ANNEE</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-3 col-6">
                            <div class="description-block border-right">
                                {{-- <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i>
                                    0%</span> --}}
                                <h5 class="description-header">{{ number_format( $thisYearPaidSum,0,'
                                    ',',') }} Fcfa</h5> <br>
                                <span class="description-text">TOTAL PAIEMENT DE L'ANNEE</span>
                            </div>
                            <!-- /.description-block -->Û
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-3 col-6">
                            <div class="description-block border-right">
                                {{-- <span class="description-percentage text-success"><i class="fas fa-caret-up"></i>
                                    20%</span> --}}
                                <h5 class="description-header">{{ number_format( $thisYearDiscountSum,0,'
                                    ',',') }} Fcfa</h5> <br>
                                <span class="description-text">TOTAL REMISE DE L'ANNEE</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-3 col-6">
                            <div class="description-block">
                                {{-- <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i>
                                    18%</span> --}}
                                <h5 class="description-header">{{ number_format( $thisYearTotalSum,0,'
                                    ',',') }} Fcfa</h5> <br>
                                <span class="description-text">GRAND TOTAL DE L'ANNEE</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.row -->
            </div>
            <hr>
            <div class="card">
                <div class="card-footer">
                    <div class="row">
                        <div class="col-sm-3 col-6">
                            <div class="description-block border-right">
                                {{-- <span class="description-percentage text-success">
                                    <i class="fas fa-caret-up"></i>
                                    17%</span> --}}
                                <h5 class="description-header">{{ number_format( $thisMonthDuSum,0,'
                                    ',',')}} fcfa</h5><br>
                                <span class="description-text">TOTAL DÛ DU MOIS</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-3 col-6">
                            <div class="description-block border-right">
                                {{-- <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i>
                                    0%</span> --}}
                                <h5 class="description-header">{{ number_format( $thisMonthPaidSum,0,'
                                    ',',') }} fcfa</h5><br>
                                <span class="description-text">TOTAL PAIEMENT DU MOIS</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-3 col-6">
                            <div class="description-block border-right">
                                {{-- <span class="description-percentage text-success"><i class="fas fa-caret-up"></i>
                                    20%</span> --}}
                                <h5 class="description-header">{{ number_format( $thisMonthDiscountSum,0,'
                                    ',',') }} fcfa</h5><br>
                                <span class="description-text">TOTAL DE REMISE DU MOIS</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-3 col-6">
                            <div class="description-block">
                                {{-- <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i>
                                    18%</span> --}}
                                <h5 class="description-header">{{ number_format( $thisMonthTotalSum,0,'
                                    ',',') }} fcfa</h5><br>
                                <span class="description-text">GRAND TOTAL DU MOIS </span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.row -->
            </div>
            <hr>


            <div class="card dark-mode">
                <div class="card-footer">
                    <div class="row">
                        <div class="col-sm-3 col-6">
                            <div class="description-block border-right">
                                {{-- <span class="description-percentage text-success">
                                    <i class="fas fa-caret-up"></i>
                                    17%</span> --}}
                                <h5 class="description-header">{{ number_format( $thisDayDuSum,0,'
                                    ',',')}} Fcfa</h5><br>
                                <span class="description-text">TOTAL DÛ DE LA JOURNEE</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-3 col-6">
                            <div class="description-block border-right">
                                {{-- <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i>
                                    0%</span> --}}
                                <h5 class="description-header">{{ number_format( $thisDayPaidSum,0,'
                                    ',',') }} Fcfa</h5><br>
                                <span class="description-text">TOTAL PAIEMENT DE LA JOURNEE</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-3 col-6">
                            <div class="description-block border-right">
                                {{-- <span class="description-percentage text-success"><i class="fas fa-caret-up"></i>
                                    20%</span> --}}
                                <h5 class="description-header">{{ number_format( $thisDayDiscountSum,0,'
                                    ',',') }} Fcfa</h5><br>
                                <span class="description-text">TOTAL DE REMISE DE LA JOURNEE</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-3 col-6">
                            <div class="description-block">
                                {{-- <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i>
                                    18%</span> --}}
                                <h5 class="description-header">{{ number_format( $thisDayTotalSum,0,'
                                    ',',') }} Fcfa</h5><br>
                                <span class="description-text">GRAND TOTAL DE LA JOURNEE </span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.row -->
            </div>
            <hr>
            <div class="row" style="margin-top: 30px;">
                <div class="col-md-12">
                    <div>
                        <div class="btn-group" role="group" aria-label="basic exemple">
                            <button type="button" data-group="day" class="btn btn-sm btn-dark">Jour</button>
                            <button type="button" data-group="week" class="btn btn-sm btn-dark">La semaine</button>
                            <button type="button" data-group="month" class="btn btn-sm btn-dark">
                                Mois</button>
                            <button type="button" data-group="year" class="btn btn-sm btn-dark">Année</button>
                        </div>
                    </div>
                    <canvas id="myChart" w="100%" h="50%"></canvas>
                </div>
            </div>

            <!-- /.modal -->
            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-lg">
                Launch Large Modal
            </button>
            <div class="modal fade" id="modal-lg">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Large Modal</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>One fine body&hellip;</p>
                            <div class="card-header">
                                <h3> Modifier Récépissé de Paiement
                                    <a href="{{ route('customers.credit') }}"
                                        class="btn btn-success float-right btn-sm">
                                        <i class="fa fa-list"></i> LISTE CREDITS CLIENTS
                                    </a>
                                </h3>
                            </div><!-- /.card-header -->
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->



        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
@section('scripts')

{{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}



<script>
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart =  new Chart(ctx, {
      type: 'bar',
     
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
      function displayChart(group= 'month') {
        fetch("{{ route('charts') }}?group=" + group)
          .then(response => response.json())
          .then(json=>{
                myChart.data.labels= json.labels,
                myChart.data.datasets= json.datasets,   
                myChart.update();
          })
      }    
   $('.btn-group .btn').on('click',function(e) {
     e.preventDefault();
     displayChart($(this).data('group'));
   })
   displayChart();
</script>
{{-- <script>
    const ctx = document.getElementById('myChart');
  
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
          label: '# of Votes',
          data: [12, 19, 3, 5, 2, 3],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
</script> --}}
@endsection

{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}