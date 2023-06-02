@extends('adminlte::page')

@section('title', 'Crear Sede')

@section('content_header')
    <h1>Crear Sede</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('sedes.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="nombre">Nombre de la sede</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el nombre de la sede" value="{{ old('nombre') }}" required>
                </div>

                <div class="form-group">
                    <label for="ubicacion_id">Ubicación</label>
                    <select class="form-control" id="ubicacion_id" name="ubicacion_id" required>
                        <option value="">Seleccione una ubicación</option>
                        @foreach($ubicaciones as $ubicacion)
                            <option value="{{ $ubicacion->id }}">{{ $ubicacion->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="direccion">Dirección</label>
                    <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Ingrese la dirección" value="{{ old('direccion') }}" required>
                </div>

                <div class="form-group">
                    <label for="telefono">Teléfono</label>
                    <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Ingrese el teléfono" value="{{ old('telefono') }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Crear Sede</button>
            </form>
        </div>
    </div>
@stop
