@extends('adminlte::page')

@section('title', 'Registrar Movimiento')

@section('content_header')
    <h1>Registrar Movimiento</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-body">
                    <form role="form" method="POST" action="{{ route('movimientos.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <input type="text" class="form-control" id="descripcion" name="descripcion" value="{{ old('descripcion') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="tipo_movimiento">Tipo de Movimiento</label>
                            <select class="form-control" id="tipo_movimiento" name="tipo_movimiento" required>
                                <option value="">Seleccione un tipo de movimiento</option>
                                <option value="Alquiler">Alquiler</option>
                                <option value="Uso">Uso</option>
                                <option value="Transformacion">Transformación</option>
                                <option value="Consumo">Consumo</option>
                                <option value="Venta">Venta</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="bien_id">Bien</label>
                            <select name="bien_id" id="bien_id" class="form-control select2">
                                <option value="-1">Seleccione un bien</option>
                                @foreach ($bienes as $bien)
                                    <option value="{{ $bien->id }}">{{ $bien->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div id="fecha_final_field" class="form-group" style="display: none;">
                            <label for="fecha_final">Fecha Final</label>
                            <input type="date" class="form-control" id="fecha_final" name="fecha_final">
                        </div>

                        <div id="ubicacion_sede_fields" style="display: none;">
                            <div class="form-group">
                                <label for="ubicacion_id">Ubicación</label>
                                <select class="form-control" id="ubicacion_id" name="ubicacion_id">
                                    <option value="">Seleccione una ubicación</option>
                                    @foreach ($ubicaciones as $ubicacion)
                                        <option value="{{ $ubicacion->id }}">{{ $ubicacion->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="sede_id">Sede</label>
                                <select class="form-control" id="sede_id" name="sede_id" disabled>
                                    <option value="">Seleccione una sede</option>
                                </select>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('#tipo_movimiento').on('change', function() {
                var tipoMovimiento = $(this).val();

                if (tipoMovimiento === 'Alquiler' || tipoMovimiento === 'Consumo') {
                    $('#fecha_final_field').show();
                } else {
                    $('#fecha_final_field').hide();
                }

                if (tipoMovimiento === 'Transformacion') {
                    $('#ubicacion_sede_fields').show();
                    $('#ubicacion_id').prop('required', true);
                    $('#sede_id').prop('required', true);
                    $('#sede_id').prop('disabled', false);
                } else {
                    $('#ubicacion_sede_fields').hide();
                    $('#ubicacion_id').prop('required', false);
                    $('#sede_id').prop('required', false);
                    $('#sede_id').prop('disabled', true);
                }
            });

            $('#ubicacion_id').on('change', function() {
                var ubicacionId = $(this).val();
                if (ubicacionId) {
                    $('#sede_id').prop('disabled', false);
                    $.ajax({
                        url: '{{ route('sedes.byUbicacion') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            ubicacion_id: ubicacionId
                        },
                        success: function(data) {
                            $('#sede_id').html(data.options);
                        }
                    });
                } else {
                    $('#sede_id').prop('disabled', true);
                    $('#sede_id').html('<option value="">Seleccione una sede</option>');
                }
            });
        });
    </script>
@stop
