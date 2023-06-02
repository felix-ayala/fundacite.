@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')
<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $movimientos }}</h3>
                <p>Movimientos registrados</p>
            </div>
            <div class="icon">
                <i class="fas fa-exchange-alt"></i>
            </div>
            <a href="{{ route('movimientos.index') }}" class="small-box-footer">
                Ver más <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $bienes }}</h3>
                <p>Bienes registrados</p>
            </div>
            <div class="icon">
                <i class="fas fa-boxes"></i>
            </div>
            <a href="{{ route('bienes.index') }}" class="small-box-footer">
                Ver más <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>0</h3>
                <p>Ultimos movimientos</p>
            </div>
            <div class="icon">
                <i class="fas fa-exchange-alt"></i>
            </div>
            <a href="#" class="small-box-footer">
                Ver más <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>0</h3>
                <p>Bienes sin movimientos</p>
            </div>
            <div class="icon">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <a href="#" class="small-box-footer">
                Ver más <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Entradas</h3>
            </div>
            <div class="box-body">
                <canvas id="entradas-chart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Salidas</h3>
            </div>
            <div class="box-body">
                <canvas id="salidas-chart"></canvas>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-xs-12 col-sm-12 col-lg-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Últimas Entradas</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Bien</th>
                            <th>Ubicación</th>
                            <th>Fecha de Entrada</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($entradas as $entrada)
                            <tr>
                                <td>{{ $entrada->id }}</td>
                                <td>{{ $entrada->bien->nombre }}</td>
                                <td>{{ $entrada->descripcion }}</td>
                                <td>{{ $entrada->fecha_movimiento }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No existen entradas</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xs-12 col-sm-12 col-lg-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Últimas Salidas</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Bien</th>
                            <th>Ubicación</th>
                            <th>Fecha de Salida</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($salidas as $salida)
                            <tr>
                                <td>{{ $salida->id }}</td>
                                <td>{{ $salida->bien->nombre }}</td>
                                <td>{{ $salida->ubicacion->nombre }}</td>
                                <td>{{ $salida->fecha_movimiento->format('d/m/Y H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No existen salidas</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    // Datos para la gráfica de últimas entradas
    var entradasData = @json($entradasData);

    // Datos para la gráfica de últimas salidas
    var salidasData = @json($salidasData);

    // Obtener las fechas y conteos de las últimas entradas
    var entradasFechas = entradasData.map(item => item.fecha);
    var entradasConteos = entradasData.map(item => item.count_entradas);

    // Obtener las fechas y conteos de las últimas salidas
    var salidasFechas = salidasData.map(item => item.fecha);
    var salidasConteos = salidasData.map(item => item.count_salidas);

    // Configuración de la gráfica de últimas entradas
    var entradasConfig = {
        type: 'line',
        data: {
            labels: entradasFechas,
            datasets: [{
                label: 'Entradas',
                data: entradasConteos,
                fill: false,
                borderColor: 'rgba(75,192,192,1)',
                backgroundColor: 'rgba(75,192,192,0.4)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    type: 'time',
                    time: {
                        unit: 'day',
                        displayFormats: {
                            day: 'DD/MM/YYYY'
                        }
                    }
                },
                y: {
                    beginAtZero: true,
                    precision: 0,
                    stepSize: 1
                }
            }
        }
    };

    // Configuración de la gráfica de últimas salidas
    var salidasConfig = {
        type: 'line',
        data: {
            labels: salidasFechas,
            datasets: [{
                label: 'Salidas',
                data: salidasConteos,
                fill: false,
                borderColor: 'rgba(255,99,132,1)',
                backgroundColor: 'rgba(255,99,132,0.4)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    type: 'time',
                    time: {
                        unit: 'day',
                        displayFormats: {
                            day: 'DD/MM/YYYY'
                        }
                    }
                },
                y: {
                    beginAtZero: true,
                    precision: 0,
                    stepSize: 1
                }
            }
        }
    };

    // Inicializar las gráficas de últimas entradas y salidas
    var entradasChart = document.getElementById('entradas-chart').getContext('2d');
    new Chart(entradasChart, entradasConfig);

    var salidasChart = document.getElementById('salidas-chart').getContext('2d');
    new Chart(salidasChart, salidasConfig);
</script>
@endsection
