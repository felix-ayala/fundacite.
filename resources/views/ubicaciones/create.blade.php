@extends('adminlte::page')

@section('title', 'Crear Ubicación')

@section('content_header')
    <h1>Crear Ubicación</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-body">
                    <form action="{{ route('ubicaciones.store') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name">Nombre de la ubicación</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Ingrese el nombre de la ubicación">
                        </div>
                        <button type="submit" class="btn btn-primary">Crear ubicación</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
