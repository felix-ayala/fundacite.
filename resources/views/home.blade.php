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
                <canvas id="bienes-ubicaciones-chart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Salidas</h3>
            </div>
            <div class="box-body">
                <canvas id="entradas-chart"></canvas>
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
                    <td>{{ $entrada->ubicacion->nombre }}</td>
                    <td>{{ $entrada->created_at->format('d/m/Y H:i') }}</td>
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
                  @forelse ($entradas as $entrada)
                  <tr>
                    <td>{{ $entrada->id }}</td>
                    <td>{{ $entrada->bien->nombre }}</td>
                    <td>{{ $entrada->ubicacion->nombre }}</td>
                    <td>{{ $entrada->created_at->format('d/m/Y H:i') }}</td>
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
      $(function () {
          // Obtener los datos para la gráfica
          $.get("{{ route('dashboard.data') }}", function (data) {
              var ubicaciones = [];
              var bienes = [];

              // Recorrer los datos y guardar los valores en los arrays correspondientes
              $.each(data, function (index, value) {
                  ubicaciones.push(value.nombre);
                  bienes.push(value.count_bienes);
              });

              // Crear la gráfica con los datos obtenidos
              var ctx = document.getElementById('bienes-ubicaciones-chart').getContext('2d');
              var chart = new Chart(ctx, {
                  type: 'bar',
                  data: {
                      labels: ubicaciones,
                      datasets: [{
                          label: 'Número de bienes',
                          data: bienes,
                          backgroundColor: 'rgba(54, 162, 235, 0.2)',
                          borderColor: 'rgba(54, 162, 235, 1)',
                          borderWidth: 1
                      }]
                  },
                  options: {
                      scales: {
                          yAxes: [{
                              ticks: {
                                  beginAtZero: true
                              }
                          }]
                      }
                  }
              });
              var ctx2 = document.getElementById('entradas-chart').getContext('2d');
              var chart2 = new Chart(ctx2, {
                  type: 'line',
                  data: {
                      labels: ubicaciones,
                      datasets: [{
                          label: 'Número de bienes',
                          data: bienes,
                          backgroundColor: 'rgba(54, 162, 235, 0.2)',
                          borderColor: 'rgba(54, 162, 235, 1)',
                          borderWidth: 1
                      }]
                  },
                  options: {
                      scales: {
                          yAxes: [{
                              ticks: {
                                  beginAtZero: true
                              }
                          }]
                      }
                  }
              });
          });
      });
  </script>
@stop
