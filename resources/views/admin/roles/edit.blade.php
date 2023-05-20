@extends('adminlte::page')

@section('title', 'Editar Rol')

@section('content_header')
<h1>Editar Rol</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('roles.update', $role->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" name="name" class="form-control" placeholder="Ingrese el nombre del rol" value="{{ old('name', $role->name) }}">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                
                <h2 class="h5">Listado de permisos</h2>
                
                @foreach ($permissions as $permission)
                    <div>
                        <label>
                            <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" class="mr-1" {{ in_array($permission->id, $role->permissions->pluck('id')->toArray()) ? 'checked' : '' }}>
                            {{ $permission->description }}
                        </label>
                    </div>
                @endforeach
                
                <button type="submit" class="btn btn-success">Actualizar Rol</button>
            </form>
        </div>
    </div>
@stop