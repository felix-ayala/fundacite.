@extends('adminlte::page')

@section('title', 'Crear Permiso')

@section('content_header')
<h1>Crear Permiso</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('permissions.store') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="name">Ruta</label>
                    <input type="text" name="name" class="form-control" placeholder="Ingrese la ruta del permiso" value="{{ old('name') }}">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="description">Descripción</label>
                    <input type="text" name="description" class="form-control" placeholder="Ingrese la descripción del permiso" value="{{ old('description') }}">
                    @error('description')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-success">Crear Permiso</button>
            </form>
        </div>
    </div>
@stop