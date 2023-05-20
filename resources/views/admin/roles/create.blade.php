@extends('adminlte::page')

@section('title', 'Crear Rol')

@section('content_header')
<h1>Crear Rol</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('roles.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" name="name" class="form-control" placeholder="Ingrese el nombre del rol" value="{{ old('name') }}">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                
                <h2 class="h5">Listado de permisos</h2>
                @foreach ($permissions as $permission)
                    <div>
                        <label>
                            <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" class="mr-1" {{ in_array($permission->id, old('permissions', [])) ? 'checked' : '' }}>
                            {{ $permission->description }}
                        </label>
                    </div>
                @endforeach
                
                <button type="submit" class="btn btn-success">Crear Rol</button>
            </form>
        </div>
    </div>
@stop