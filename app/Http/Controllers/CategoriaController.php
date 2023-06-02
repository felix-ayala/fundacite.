<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use DataTables;

class CategoriaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Categoria::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                       $btn = '<a href="'.route('categorias.edit', $row->id).'" class="edit btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>';
                       $btn .= '&nbsp;&nbsp;';
                       $btn .= '<form class="d-flex" action="'.route('categorias.destroy', $row->id).'" method="POST">
                                        '.method_field('DELETE').'
                                        '.csrf_field().'
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                    </form>';
                        return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('categorias.index');
    }

    public function create()
    {
        return view('categorias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|unique:categorias',
        ]);

        Categoria::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('categorias.index')->with('success', 'La categoría ha sido creada.');
    }

    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', compact('categoria'));
    }

    public function update(Request $request, Categoria $categoria)
    {
        $request->validate([
            'nombre' => ['required', Rule::unique('categorias')->ignore($categoria->id)],
        ]);

        $categoria->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('categorias.index')->with('success', 'La categoría ha sido actualizada.');
    }

    public function destroy(Categoria $categoria)
    {
        $categoria->delete();

        return redirect()->route('categorias.index')->with('success', 'La categoría ha sido eliminada.');
    }
}
