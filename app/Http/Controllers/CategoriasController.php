<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorias;

class CategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Categorias::with('marcas')->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:191',
            'marcas' => 'array',
            'marcas.*' => 'string|max:191',
        ]);

        $categoria = Categorias::create([
            'nombre' => $request->nombre,
        ]);
        // Si se envían marcas, guárdalas
        if ($request->has('marcas') && is_array($request->marcas)) {
            foreach ($request->marcas as $marcaNombre) {
                \App\Models\Marca::create([
                    'nombre' => $marcaNombre,
                    'categoria_id' => $categoria->id,
                ]);
            }
        }
        return response()->json($categoria, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:191',
        ]);

        $categoria = Categorias::findOrFail($id);
        $categoria->nombre = $request->nombre;
        $categoria->save();

        return response()->json($categoria);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categoria = Categorias::findOrFail($id);
        $categoria->delete();

        return response()->json(null, 204);
    }
}
