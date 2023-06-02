<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movimiento;
use App\Models\Bien;
use Yajra\DataTables\DataTables;

class ReporteController extends Controller
{
    public function index()
    {
        $bienes = Bien::all();
        return view('reportes.index', compact('bienes'));
    }

    public function getReporte(Request $request)
    {
        $tipoMovimiento = $request->input('tipo_movimiento');
        $bienId = $request->input('bien_id');

        $movimientos = Movimiento::query();

        if ($tipoMovimiento) {
            $movimientos->where('tipo_movimiento', $tipoMovimiento);
        }

        if ($bienId) {
            $movimientos->where('bien_id', $bienId);
        }

        return DataTables::of($movimientos)
            ->addColumn('tipo_movimiento', function ($movimiento) {
                return $movimiento->tipo_movimiento;
            })
            ->addColumn('descripcion', function ($movimiento) {
                return $movimiento->descripcion;
            })
            ->addColumn('fecha_movimiento', function ($movimiento) {
                return $movimiento->fecha_movimiento;
            })
            ->addColumn('usuario_id', function ($movimiento) {
                return $movimiento->usuario->name;
            })
            ->addColumn('bien_id', function ($movimiento) {
                return $movimiento->bien->nombre;
            })
            ->rawColumns(['tipo_movimiento', 'descripcion', 'fecha_movimiento', 'usuario_id', 'bien_id'])
            ->make(true);
    }
}
