@extends('adminlte::page')

@section('title', 'Registrar Bien')

@section('content_header')
    <h1>Registrar Bien</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="box box-primary">
                <div class="box-body">
                    <form role="form" method="POST" action="{{ route('bienes.store') }}">
                        @csrf

                        <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}" required autofocus>
                            @if ($errors->has('nombre'))
                                <span class="help-block">{{ $errors->first('nombre') }}</span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('descripcion') ? ' has-error' : '' }}">
                            <label for="descripcion">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion">{{ old('descripcion') }}</textarea>
                            @if ($errors->has('descripcion'))
                                <span class="help-block">{{ $errors->first('descripcion') }}</span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('categoria') ? ' has-error' : '' }}">
                            <label for="categoria">Categoría</label>
                            <input type="text" class="form-control" id="categoria" name="categoria" value="{{ old('categoria') }}" required>
                            @if ($errors->has('categoria'))
                                <span class="help-block">{{ $errors->first('categoria') }}</span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('modelo') ? ' has-error' : '' }}">
                            <label for="modelo">Modelo</label>
                            <input type="text" class="form-control" id="modelo" name="modelo" value="{{ old('modelo') }}" required>
                            @if ($errors->has('modelo'))
                                <span class="help-block">{{ $errors->first('modelo') }}</span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('numero_serie') ? ' has-error' : '' }}">
                            <label for="numero_serie">Número de Serie</label>
                            <input type="text" class="form-control" id="numero_serie" name="numero_serie" value="{{ old('numero_serie') }}" required>
                            @if ($errors->has('numero_serie'))
                                <span class="help-block">{{ $errors->first('numero_serie') }}</span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('cantidad') ? ' has-error' : '' }}">
                            <label for="cantidad">Cantidad</label>
                            <input type="number" class="form-control" id="cantidad" name="cantidad" value="{{ old('cantidad') }}" required>
                            @if ($errors->has('cantidad'))
                                <span class="help-block">{{ $errors->first('cantidad') }}</span>
                            @endif
                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop