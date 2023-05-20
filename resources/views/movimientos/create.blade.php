@extends('adminlte::page')

@section('title', 'Registrar Movimiento')

@section('content_header')
    <h1>Registrar Movimiento</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-body">
                    <form method="POST" action="{{ route('movimientos.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="bien_id">Bien</label>
                            <select name="bien_id" id="bien_id" class="form-control select2" style="width: 100%;">
                                @foreach ($bienes as $bien)
                                    <option value="{{ $bien->id }}">{{ $bien->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tipo_movimiento">Tipo de Movimiento</label>
                            <select name="tipo_movimiento" id="tipo_movimiento" class="form-control" required>
                                <option value="entrada">Entrada</option>
                                <option value="salida">Salida</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cantidad">Cantidad</label>
                            <input type="number" name="cantidad" id="cantidad" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <textarea name="descripcion" id="descripcion" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
