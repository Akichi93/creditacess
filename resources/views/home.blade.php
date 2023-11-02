@extends('layouts.app')

@section('content')
    @push('graph')
        <script src="code/highcharts.js"></script>
        <script src="code/modules/variable-pie.js"></script>
        <script src="code/modules/data.js"></script>
        <script src="code/modules/drilldown.js"></script>
        <script src="code/modules/exporting.js"></script>
        <script src="code/modules/export-data.js"></script>
        <script src="code/modules/accessibility.js"></script>




        <script type="text/javascript">
            // Data retrieved from https://worldpopulationreview.com/country-rankings/countries-by-density
            Highcharts.chart('container', {
                chart: {
                    type: 'pie'
                },
                title: {
                    text: 'Collaborateur par sexe'
                },
                tooltip: {
                    valueSuffix: ''
                },


                series: [{
                    name: 'Nombre',
                    colorByPoint: true,
                    data: {!! $tbjson !!}
                }]
            });
        </script>

        <script type="text/javascript">
            // Data retrieved from https://gs.statcounter.com/browser-market-share#monthly-202201-202201-bar

            // Create the chart
            Highcharts.chart('exemple', {
                chart: {
                    type: 'column'
                },
                title: {
                    align: 'left',
                    text: 'Collaborateur par service'
                },
              
                accessibility: {
                    announceNewData: {
                        enabled: true
                    }
                },
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    title: {
                        text: 'Total'
                    }

                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y:.1f}'
                        }
                    }
                },

                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}</b><br/>'
                },

                series: [{
                    name: 'Nombre',
                    colorByPoint: true,
                    data:  {!! $json !!}
                }],
              
            });
        </script>
    @endpush

    <div class="content container-fluid">

        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Bienvenue {{ Auth::user()->name }}!</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item active">Tableau de bord</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
                <div class="card dash-widget">
                    <div class="card-body">
                        <span class="dash-widget-icon"><i class="fa-solid fa-cubes"></i></span>
                        <div class="dash-widget-info">
                            <h3>{{ $conges }}</h3>
                            <span>CONGE</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
                <div class="card dash-widget">
                    <div class="card-body">
                        <span class="dash-widget-icon"><i class="fa-solid fa-dollar-sign"></i></span>
                        <div class="dash-widget-info">
                            <h3>{{ $demandes }}</h3>
                            <span>Demande</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
                <div class="card dash-widget">
                    <div class="card-body">
                        <span class="dash-widget-icon"><i class="fa-regular fa-gem"></i></span>
                        <div class="dash-widget-info">
                            <h3>{{ $missions }}</h3>
                            <span>Mission</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-md-6">
                <div id="container"></div>
            </div>

            <div class="col-md-6">
                <div id="exemple"></div>
            </div>

        </div>
    </div>
@endsection
