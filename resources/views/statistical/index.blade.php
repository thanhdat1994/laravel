@extends('adminlte::page')

@section('title', 'Orders')

@section('content_header')
    <h1>Revenue statistics</h1>
@stop

@section('css')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"/>
@stop

@section('content')
    <div class="row">
        <div id="tabs" class="col-lg-8 col-md-8 col-xs-12 align-content-center">
            <ul class="nav">
                <li class="active"><a href="#container-column">Column Chart</a></li>
                <li><a href="#container-spline">Spline Chart</a></li>
            </ul>

            <div class="col-12">
                <figure class="highcharts-figure">
                    <div id="container-column"></div>
                </figure>
            </div>
            <div class="col-12">
                <figure class="highcharts-figure">
                    <div id="container-spline"></div>
                </figure>
            </div>
        </div>
        <div id="tabs" class="col-lg-4 col-md-4 col-xs-12 align-content-center">
            <form action="{{ route('statistical.revenue') }}" method="POST" class="form-horizontal justify-content-center align-items-center">
                @csrf
                @method('POST')
                <div class="card-body col-12">
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <div class="input-group date">
                                <input type="text" id="datepicker-start" name="inputDateStart" placeholder="Start date" class="form-control"/>
                                <label class="col-form-label">~</label>
                                <input type="text" id="datepicker-end" name="inputDateEnd" placeholder="End date" class="form-control"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success"><i class="fas fa-plus-square"></i> Search</button>
                </div>
            </form>
        </div>
    </div>
@stop

@section('js')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="../../js/custom.js"></script>
    <script type="text/javascript">
        $(function () {
            $("#tabs").tabs();
            $('#datepicker-start').datepicker({
                format: 'dd/mm/yyyy',
                autoclose: true,
                todayHighlight: true,
            });
            $('#datepicker-end').datepicker({
                format: 'dd/mm/yyyy',
                autoclose: true,
                todayHighlight: true,
            });
        });
        Highcharts.chart('container-spline', {
            chart: {
                type: 'spline'
            },
            title: {
                text: 'Revenue Statistics'
            },
            xAxis: {
                categories: @json($date)
            },
            yAxis: {
                title: {
                    text: 'Việt Nam Đồng'
                },
                labels: {
                    formatter: function () {
                        return number_format(this.value) + ' VNĐ';
                    }
                }
            },
            tooltip: {
                crosshairs: true,
                shared: true
            },
            plotOptions: {
                spline: {
                    marker: {
                        radius: 4,
                        lineColor: '#666666',
                        lineWidth: 1
                    }
                }
            },
            series: [{
                name: 'Doanh thu',
                marker: {
                    symbol: 'square'
                },
                data: {{ json_encode($revenue) }}

            }, {
                name: 'Doanh chi',
                marker: {
                    symbol: 'diamond'
                },
                data: {{ json_encode($expense) }}
            }]
        });
        Highcharts.chart('container-column', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Revenue Statistics'
            },
            xAxis: {
                categories: @json($date)
            },
            yAxis: {
                title: {
                    text: 'Việt Nam Đồng'
                },
                labels: {
                    formatter: function () {
                        return number_format(this.value) + ' VNĐ';
                    }
                }
            },
            tooltip: {
                crosshairs: true,
                shared: true
            },
            plotOptions: {
                spline: {
                    marker: {
                        radius: 4,
                        lineColor: '#666666',
                        lineWidth: 1
                    }
                }
            },
            series: [{
                name: 'Doanh thu',
                marker: {
                    symbol: 'square'
                },
                data: {{ json_encode($revenue) }}

            }, {
                name: 'Doanh chi',
                marker: {
                    symbol: 'diamond'
                },
                data: {{ json_encode($expense) }}
            }]
        });
    </script>
@stop
