@extends('adminlte::page')

@section('title', 'Bienes')

@section('content_header')
    <h1>Bienes</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-flex mb-2" style="justify-content:end; gap:1px">
                <button class="btn btn-primary float-right" id="print_button"><i class="fa fa-print"></i></button>
                <button class="btn btn-danger float-right" id="export_pdf_button"><i class="fa fa-file-pdf"></i></button>
                <button class="btn btn-secondary " id="export_excel_button"><i class="fa fa-file-excel"></i></button>
            </div>
            <table id="bienes-table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Categoria</th>
                        <th>Codigo</th>
                        <th>Ubicación</th>
                        <th>Sede</th>
                        <th>Estado</th>
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
        var table =$('#bienes-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('bienes.index') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'nombre', name: 'nombre', className:'mx-auto' },
                    { data: 'categoria_id', name: 'categoria_id' },
                    { data: 'codigo', name: 'codigo' },
                    { data: 'ubicacion_id', name: 'ubicacion_id' },
                    { data: 'sede_id', name: 'sede_id' },
                    { data: 'estatus', name: 'estatus' },
                    { data: 'action', name: 'action', orderable: false, searchable: false, className:'d-flex justify-content-center' },
                ],
                buttons: [
                    'print',
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6]
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6]
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
                }
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
    </script>
@stop
