<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bien;
use App\Models\Categoria;
use App\Models\Sede;
use App\Models\Ubicacion;
use App\Models\Movimiento;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use DataTables;

class BienController extends Controller
{
  
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Bien::with('categoria', 'sede')->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('ubicacion_id', function ($row) {
                    return $row->sede->ubicacion->nombre;
                })
                ->editColumn('sede_id', function ($row) {
                    return $row->sede->nombre;
                })
                ->editColumn('categoria_id', function ($row) {
                    return $row->categoria->nombre;
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
        $request->validate([
            'codigo' => 'required|unique:bienes',
            'nombre' => 'required',
            'descripcion' => 'required',
            'modelo' => 'required',
            'estatus' => 'required',
            'sede_id' => 'required',
            'categoria_id' => 'required',
        ]);
        try {
            DB::beginTransaction();

            $bien = Bien::create([
                'codigo' => $request->codigo,
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'marca' => $request->marca,
                'modelo' => $request->modelo,
                'estatus' => $request->estatus,
                'cantidad' => $request->cantidad,
                'sede_id' => $request->sede_id,
                'categoria_id' => $request->categoria_id,
            ]);

            // Registrar el movimiento de tipo "Entrada"
            $movimiento = Movimiento::create([
                'fecha_movimiento' => now(),
                'descripcion' => 'Entrada de bien: ' . $bien->nombre,
                'tipo_movimiento' => 'Entrada',
                'usuario_id' => Auth::id(),
                'bien_id' => $bien->id,
            ]);


            DB::commit();

            return redirect()->route('bienes.index')->with('success', 'El bien ha sido creado correctamente.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Ocurrió un error al crear el bien: ' . $e->getMessage());
        }
    }

    public function show(Bien $biene)
    {
        return view('bienes.show', compact('bien'));
    }

    public function edit(Bien $biene)
    {
        $ubicaciones = Ubicacion::where('id', $biene->sede->ubicacion_id)->get();
        $sedes = Sede::where('ubicacion_id', $biene->sede->ubicacion_id)->get();
        $categorias = Categoria::all();
        return view('bienes.edit', [
                                    'bien'        => $biene, 
                                    'categorias'  => $categorias,
                                    'ubicaciones' => $ubicaciones,
                                    'sedes'       =>$sedes]);
    }

    public function update(Request $request, Bien $biene)
    {
        $bien = $biene;
        $request->validate([
            'codigo' => ['required', Rule::unique('bienes')->ignore($bien->id)],
            'nombre' => 'required',
            'descripcion' => 'required',
            'modelo' => 'required',
            'estatus' => 'required',
            'sede_id' => 'required',
            'categoria_id' => 'required',
        ]);

        try {
            DB::beginTransaction();

            $bien->update([
                'codigo' => $request->codigo,
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'marca' => $request->marca,
                'modelo' => $request->modelo,
                'estatus' => $request->estatus,
                'cantidad' => $request->cantidad,
                'sede_id' => $request->sede_id,
                'categoria_id' => $request->categoria_id,
            ]);

            // Realizar cualquier otra lógica o procesamiento adicional aquí

            DB::commit();

            return redirect()->route('bienes.index')->with('success', 'El bien ha sido actualizado correctamente.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Ocurrió un error al actualizar el bien: ' . $e->getMessage());
        }
    }

    public function destroy(Bien $biene)
    {
        try {
            DB::beginTransaction();

            $biene->delete();

            // Realizar cualquier otra lógica o procesamiento adicional aquí

            DB::commit();

            return redirect()->route('bienes.index')->with('success', 'El bien ha sido eliminado correctamente.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Ocurrió un error al eliminar el bien: ' . $e->getMessage());
        }
    }

    public function getSedesByUbicacion(Request $request)
    {
        $ubicacionId = $request->input('ubicacion_id');
        $sedes = Sede::where('ubicacion_id', $ubicacionId)->get();
        $options = '<option value="">Seleccione una sede</option>';
        foreach ($sedes as $sede) {
            $options .= '<option value="' . $sede->id . '">' . $sede->nombre . '</option>';
        }
        return response()->json(['options' => $options]);
    }

}