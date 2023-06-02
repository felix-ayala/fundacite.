@extends('adminlte::page')

@section('title', 'Categorías')

@section('content_header')
    <h1>Categorías</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header with-border">
                    <h3 class="card-title">Editar Categoría</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="POST" action="{{ route('categorias.update', $categoria->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el nombre de la categoría" value="{{ $categoria->nombre }}">
                        </div>

                        <div class="form-group">
                            <label for="descripcion">Descripcion</label>
                            <textarea class="form-control" name="descripcion" id="descripcion" cols="30" rows="10">{{ $categoria->descripcion }}</textarea>
                        </div>
                    </div>
                    <!-- /.card-body -->
                
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
@stop
