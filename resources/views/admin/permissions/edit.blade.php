@extends('adminlte::page')

@section('title', 'Crear Permiso')

@section('content_header')
<h1>Crear Permiso</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.permissions.update', $permission->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="name">Ruta</label>
                    <input type="text" name="name" class="form-control" placeholder="Ingrese la ruta del permiso" value="{{ old('name', $permission->name) }}">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="description">Descripción</label>
                    <input type="text" name="description" class="form-control" placeholder="Ingrese la descripción del permiso" value="{{ old('description', $permission->description) }}">
                    @error('description')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-success">Actualizar Permiso</button>
            </form>
            
        </div>
    </div>
@stop