<?php

namespace App\Http\Controllers;

use App\Models\Movimiento;
use App\Models\Bien;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Obtener las últimas entradas
        $movimientos = Movimiento::count();
        $bienes = Bien::count();
        $entradas = Movimiento::where('tipo_movimiento', 'Entrada')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Obtener las últimas salidas
        $salidas = Movimiento::whereIn('tipo_movimiento', ['Uso', 'Alquiler', 'Transformacion', 'Consumo', 'Venta'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Obtener los datos para la gráfica de últimas entradas
        $entradasData = Movimiento::where('tipo_movimiento', 'Entrada')
            ->groupBy('fecha_movimiento')
            ->selectRaw('DATE(fecha_movimiento) as fecha, COUNT(*) as count_entradas')
            ->orderBy('fecha_movimiento')
            ->get();

        // Obtener los datos para la gráfica de últimas salidas
        $salidasData = Movimiento::whereIn('tipo_movimiento', ['Uso', 'Alquiler', 'Transformacion', 'Consumo', 'Venta'])
            ->groupBy('fecha_movimiento')
            ->selectRaw('DATE(fecha_movimiento) as fecha, COUNT(*) as count_salidas')
            ->orderBy('fecha_movimiento')
            ->get();

        return view('home', compact('movimientos','bienes','entradas', 'salidas', 'entradasData', 'salidasData'));
    }
}
