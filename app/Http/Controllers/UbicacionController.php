<?php

namespace App\Http\Controllers;

use App\Models\Ubicacion;
use Illuminate\Http\Request;
use DataTables;

class UbicacionController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Ubicacion::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                       $btn = '<a href="'.route('ubicaciones.edit', $row->id).'" class="edit btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>';
                       $btn .= '&nbsp;&nbsp;';
                       $btn .= '<form class="d-flex" action="'.route('ubicaciones.destroy', $row->id).'" method="POST">
                                        '.method_field('DELETE').'
                                        '.csrf_field().'
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                    </form>';
                        return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('ubicaciones.index');
    }
    
    public function create()
    {
        return view('ubicaciones.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'direccion' => 'required',
            'ciudad' => 'required',
            'pais' => 'required',
        ]);
    
        Ubicacion::create($request->all());
     
        return redirect()->route('ubicaciones.index')
                        ->with('success','Ubicación creada correctamente.');
    }
    
    public function edit(Ubicacion $ubicacione)
    {
        return view('ubicaciones.edit',['ubicacion'=> $ubicacione ]);
    }
    
    public function update(Request $request, Ubicacion $ubicacion)
    {
        $request->validate([
            'nombre' => 'required',
            'direccion' => 'required',
            'ciudad' => 'required',
            'pais' => 'required',
        ]);
    
        $ubicacion->update($request->all());
    
        return redirect()->route('ubicaciones.index')
                        ->with('success','Ubicación actualizada correctamente.');
    }
    
    public function destroy(Ubicacion $ubicacion)
    {
        $ubicacion->delete();
    
        return redirect()->route('ubicaciones.index')
                        ->with('success','Ubicación eliminada correctamente.');
    }

    public function show(Ubicacion $ubicacion)
    {
        return view('ubicaciones.show',compact('ubicacion'));
    }
}
