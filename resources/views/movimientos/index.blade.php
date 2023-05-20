@extends('adminlte::page')

@section('title', 'Movimientos')

@section('content_header')
    <h1>Movimientos</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <table id="movimientos-table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Fecha movimiento</th>
                        <th>Tipo movimiento</th>
                        <th>Equipo</th>
                        <th>Usuario</th>
                        <th>Ubicación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@stop

@section('js')
    <script>
       
       $(function () {
            $('#movimientos-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('movimientos.index') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'fecha_movimiento', name: 'fecha_movimiento', className:'mx-auto' },
                    { data: 'tipo_movimiento', name: 'tipo_movimiento' },
                    { data: 'bien_id', name: 'bien_id' },
                    { data: 'usuario_id', name: 'usuario_id' },
                    { data: 'ubicacion_id', name: 'ubicacion_id' },
                    { data: 'action', name: 'action', orderable: false, searchable: false, className:'d-flex justify-content-center' },
                ],
                language: {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sSearch": "Buscar:",
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                }
            });
        });
    </script>
@stop
