<?php

namespace App\Http\Controllers;

use App\Models\Bien;
use App\Models\Movimiento;
use Illuminate\Http\Request;
use DataTables;

class MovimientoController extends Controller
{
    
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Movimiento::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
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
        return view('movimientos.create', compact('bienes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'bien_id' => 'required',
            'tipo_movimiento' => 'required',
            'cantidad' => 'required|numeric|min:1'
        ]);

        $movimiento = new Movimiento();
        $movimiento->bien_id = $request->input('bien_id');
        $movimiento->tipo_movimiento = $request->input('tipo_movimiento');
        $movimiento->cantidad = $request->input('cantidad');
        $movimiento->descripcion = $request->input('descripcion');
        $movimiento->save();

        // Actualizar cantidad de bien en función del tipo de movimiento
        $bien = Bien::find($request->input('bien_id'));
        if ($request->input('tipo_movimiento') == 'entrada') {
            $bien->cantidad += $request->input('cantidad');
        } else {
            $bien->cantidad -= $request->input('cantidad');
        }
        $bien->save();

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
