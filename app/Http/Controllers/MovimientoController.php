<?php

namespace App\Http\Controllers;

use App\Models\Bien;
use App\Models\Movimiento;
use App\Models\Ubicacion;
use Illuminate\Http\Request;
use DataTables;
use Carbon\Carbon;

class MovimientoController extends Controller
{
    
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Movimiento::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('bien_id', function ($row) {
                    return $row->bien->nombre;
                })
                ->editColumn('usuario_id', function ($row) {
                    return $row->usuario->name;
                })
                ->editColumn('ubicacion_id', function ($row) {
                    return !empty($row->sede_id) ? $row->sede->ubicacion->nombre.' - '. $row->sede->nombre : $row->bien->sede->ubicacion->nombre.' - '. $row->bien->sede->nombre;
                })
                ->addColumn('action', function($row){
                       $btn = '<a href="'.route('movimientos.edit', $row->id).'" class="edit btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>';
                       $btn .= '&nbsp;&nbsp;';
                       $btn .= '<form class="d-flex" action="'.route('movimientos.destroy', $row->id).'" method="POST">
                                        '.method_field('DELETE').'
                                        '.csrf_field().'
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                    </form>';
                        return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('movimientos.index');
    }

    
    public function create()
    {
        $bienes = Bien::all();
        $ubicaciones = Ubicacion::all();
        return view('movimientos.create', compact('bienes','ubicaciones'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'bien_id' => 'required',
            'tipo_movimiento' => 'required',
        ]);

        // Crear el Movimiento
        $movimiento = Movimiento::create([
            'fecha_movimiento' => now(),
            'descripcion' => $request->descripcion,
            'tipo_movimiento' => $request->tipo_movimiento,
            'usuario_id' => auth()->user()->id,
            'bien_id' => $request->bien_id,
            'cantidad' => $request->cantidad,
        ]);
        $bien = Bien::find($request->bien_id);
        $bien->cantidad = $bien->cantidad - $request->cantidad;
        $bien->save();


        // Realizar acciones adicionales según el tipo de movimiento
        if ($request->tipo_movimiento == 'Alquiler' || $request->tipo_movimiento == 'Consumo') {
            $movimiento->fecha_final = $request->fecha_final;
            $movimiento->save();
        } elseif ($request->tipo_movimiento == 'Uso') {

            $movimiento->fecha_final = Carbon::now()->addDay();
            $movimiento->save();

        } elseif ($request->tipo_movimiento == 'Transferencia') {
            // Actualizar el estatus del bien a "inactivo"
            $bien = Bien::find($request->bien_id);
            $bien->sede_id = $request->sede_id;
            $bien->save();

            $movimiento->sede_id = $request->sede_id;
            $movimiento->save();
        } elseif ($request->tipo_movimiento == 'Venta') {
            // Actualizar el estatus del bien a "VENDIDO"
            $bien = Bien::find($request->bien_id);
            $bien->estatus = 'VENDIDO';
            $bien->save();
        }

        return redirect()->route('movimientos.index')->with('success', 'Movimiento registrado exitosamente.');
    }
    

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
