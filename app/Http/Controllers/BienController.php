<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bien;
use App\Models\Categoria;
use App\Models\Ubicacion;
use Illuminate\Support\Facades\DB;
use DataTables;

class BienController extends Controller
{
  
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Bien::with('categoria', 'ubicacion')->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('ubicacion_id', function ($row) {
                    return $row->ubicacion->nombre;
                })
                ->addColumn('action', function($row){
                       $btn = '<a href="'.route('bienes.edit', $row->id).'" class="edit btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>';
                       $btn .= '&nbsp;&nbsp;';
                       $btn .= '<form class="d-flex" action="'.route('bienes.destroy', $row->id).'" method="POST">
                                        '.method_field('DELETE').'
                                        '.csrf_field().'
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                    </form>';
                        return $btn;
                })
                ->rawColumns(['ubicacion_id','action'])
                ->make(true);
        }
        return view('bienes.index');
    }

    public function create()
    {
        $categorias = Categoria::all();
        $ubicaciones = Ubicacion::all();
        return view('bienes.create', compact('categorias', 'ubicaciones'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'numero_serial' => 'required|unique:bienes',
            'modelo' => 'required',
            'estado' => 'required',
            'categoria_id' => 'required',
            'ubicacion_id' => 'required',
        ]);

        DB::beginTransaction();

        try {
            $bien = new Bien();
            $bien->nombre = $request->nombre;
            $bien->descripcion = $request->descripcion;
            $bien->numero_serial = $request->numero_serial;
            $bien->modelo = $request->modelo;
            $bien->estado = $request->estado;
            $bien->categoria_id = $request->categoria_id;
            $bien->ubicacion_id = $request->ubicacion_id;
            $bien->save();

            DB::commit();
            return redirect()->route('bienes.index')->with('success', 'Bien creado correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al crear el bien: ' . $e->getMessage());
        }
    }

    public function edit(Bien $bien)
    {
        $categorias = Categoria::all();
        $ubicaciones = Ubicacion::all();
        return view('bienes.edit', compact('bien', 'categorias', 'ubicaciones'));
    }

    public function update(Request $request, Bien $bien)
    {
        $validatedData = $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'numero_serial' => 'required|unique:bienes,numero_serial,' . $bien->id,
            'modelo' => 'required',
            'estado' => 'required',
            'categoria_id' => 'required',
            'ubicacion_id' => 'required',
        ]);

        DB::beginTransaction();

        //try {
          //  $bien->nombre = $request->nombre;
        //}
    }

    public function destroy(Bien $bien)
    {
        $bien->delete();

        return redirect()->route('bienes.index');
    }
    

}