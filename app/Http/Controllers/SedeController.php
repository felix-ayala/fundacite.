<?php

namespace App\Http\Controllers;

use App\Models\Sede;
use App\Models\Ubicacion;
use Illuminate\Http\Request;
use DataTables;

class SedeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Sede::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('ubicacion_id', function ($row) {
                    return $row->ubicacion->nombre;
                })
                ->addColumn('action', function($row){
                       $btn = '<a href="'.route('sedes.edit', $row->id).'" class="edit btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>';
                       $btn .= '&nbsp;&nbsp;';
                       $btn .= '<form class="d-flex" action="'.route('sedes.destroy', $row->id).'" method="POST">
                                        '.method_field('DELETE').'
                                        '.csrf_field().'
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                    </form>';
                        return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('sedes.index');
    }

    public function create()
    {
        $ubicaciones = Ubicacion::all();
        return view('sedes.create', compact('ubicaciones'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'ubicacion_id' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
        ]);

        Sede::create($request->all());

        return redirect()->route('sedes.index')
            ->with('success', 'Sede creada correctamente.');
    }

    public function show(Sede $sede)
    {
        return view('sedes.show', compact('sede'));
    }

    public function edit(Sede $sede)
    {
        $ubicaciones = Ubicacion::all();
        return view('sedes.edit', compact('sede', 'ubicaciones'));
    }

    public function update(Request $request, Sede $sede)
    {
        $request->validate([
            'nombre' => 'required',
            'ubicacion_id' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
        ]);

        $sede->update($request->all());

        return redirect()->route('sedes.index')
            ->with('success', 'Sede actualizada correctamente.');
    }

    public function destroy(Sede $sede)
    {
        $sede->delete();

        return redirect()->route('sedes.index')
            ->with('success', 'Sede eliminada correctamente.');
    }
}
