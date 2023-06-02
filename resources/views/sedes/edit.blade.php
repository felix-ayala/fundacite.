@extends('adminlte::page')

@section('title', 'Editar Ubicación')

@section('content_header')
    <h1>Editar Ubicación</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('sedes.update', $sede->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nombre">Nombre de la sede</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el nombre de la sede" value="{{ old('nombre', $sede->nombre) }}" required>
                </div>

                <div class="form-group">
                    <label for="ubicacion_id">Ubicación</label>
                    <select class="form-control" id="ubicacion_id" name="ubicacion_id" required>
                        <option value="">Seleccione una ubicación</option>
                        @foreach($ubicaciones as $ubicacion)
                            <option value="{{ $ubicacion->id }}" {{ ($sede->ubicacion_id == $ubicacion->id) ? 'selected' : '' }}>{{ $ubicacion->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="direccion">Dirección</label>
                    <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Ingrese la dirección" value="{{ old('direccion', $sede->direccion) }}" required>
                </div>

                <div class="form-group">
                    <label for="telefono">Teléfono</label>
                    <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Ingrese el teléfono" value="{{ old('telefono', $sede->telefono) }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Actualizar Sede</button>
            </form>
        </div>
    </div>
@stop
