@extends('adminlte::page')

@section('title', 'Reportes')

@section('content_header')
    <h1>Reportes</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form id="reporteForm" method="POST" action="{{ route('reportes.getReporte') }}">
                @csrf

                <div class="form-group">
                    <label for="tipo_movimiento">Tipo de Movimiento</label>
                    <select class="form-control" id="tipo_movimiento" name="tipo_movimiento">
                        <option value="">Todos</option>
                        <option value="Entrada">Entrada</option>
                        <option value="Alquiler">Alquiler</option>
                        <option value="Uso">Uso</option>
                        <option value="Transferencia">Transferencia</option>
                        <option value="Consumo">Consumo</option>
                        <option value="Venta">Venta</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="bien_id">Bien ID</label>
                    <select name="bien_id" id="bien_id" class="form-control select2">
                        <option value="-1">Seleccione un bien</option>
                        @foreach ($bienes as $bien)
                            <option value="{{ $bien->id }}">{{ $bien->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Generar Informe</button>
            </form>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <div class="d-flex mb-2" style="justify-content:end; gap:1px">
                <button class="btn btn-primary float-right" id="print_button"><i class="fa fa-print"></i></button>
                <button class="btn btn-danger float-right" id="export_pdf_button"><i class="fa fa-file-pdf"></i></button>
                <button class="btn btn-secondary " id="export_excel_button"><i class="fa fa-file-excel"></i></button>
            </div>
            <table class="table" id="reporteTable">
                <thead>
                    <tr>
                        <th>Tipo de Movimiento</th>
                        <th>Descripción</th>
                        <th>Fecha de Movimiento</th>
                        <th>ID de Usuario</th>
                        <th>ID de Bien</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('#reporteForm').on('submit', function(e) {
                e.preventDefault();

                var table = $('#reporteTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route('reportes.getReporte') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            data :$('#reporteForm').serialize()
                        },
                    },
                    buttons: [
                    'print',
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: [0, 1,2,3,4]
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: [0, 1,2,3,4]
                        }
                    }
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
                    },
                    columns: [
                        { data: 'tipo_movimiento', name: 'tipo_movimiento' },
                        { data: 'descripcion', name: 'descripcion' },
                        { data: 'fecha_movimiento', name: 'fecha_movimiento' },
                        { data: 'usuario_id', name: 'usuario_id' },
                        { data: 'bien_id', name: 'bien_id' }
                    ]
                });

                $('#print_button').on('click', function() {
                table.button('0').trigger();
            });

            $('#export_pdf_button').on('click', function() {
                table.button('1').trigger();
            });

            $('#export_excel_button').on('click', function() {
                table.button('2').trigger();
            });
            });
           
        });
    </script>
@stop
