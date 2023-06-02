<?php

namespace App\Http\Controllers;

use App\Models\Bien;
use App\Models\Movimiento;
use App\Models\Ubicacion;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
   
    public function index()
    {
        $movimientos = Movimiento::count();
        $bienes = Bien::count();
        $entradas = Movimiento::where('tipo_movimiento', 'entrada')->orderBy('created_at', 'desc')->limit(5)->get();

        $ubicaciones = Ubicacion::all();
        $bienes_por_ubicacion = [];

        // Obtener el número de bienes por ubicación
        // foreach ($ubicaciones as $ubicacion) {
        //     $bienes_por_ubicacion[] = [
        //         'nombre' => $ubicacion->nombre,
        //         'count_bienes' => Bien::where('ubicacion_id', $ubicacion->id)->count()
        //     ];
        // }
        return view('home', compact('movimientos', 'bienes','entradas','ubicaciones','bienes_por_ubicacion'));
    }

    public function data()
    {
        $ubicaciones = Ubicacion::all();
        $bienes_por_ubicacion = [];

        // Obtener el número de bienes por ubicación
        // foreach ($ubicaciones as $ubicacion) {
        //     $bienes_por_ubicacion[] = [
        //         'nombre' => $ubicacion->nombre,
        //         'count_bienes' => Bien::where('ubicacion_id', $ubicacion->id)->count()
        //     ];
        // }

        return $bienes_por_ubicacion;
    }
}
