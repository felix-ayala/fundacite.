@extends('adminlte::page')

@section('title', 'Crear Ubicación')

@section('content_header')
    <h1>Crear Ubicación</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-body">
                    <form action="{{ route('ubicaciones.store') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="nombre">Nombre de la ubicación</label>
                            <input type="text" class="form-control" value="{{ old('nombre') }}" id="nombre" name="nombre" placeholder="Ingrese el nombre de la ubicación">
                            @error('nombre')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Crear ubicación</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
