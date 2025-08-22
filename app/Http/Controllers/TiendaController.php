<?php

namespace App\Http\Controllers;

use App\Models\Tienda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TiendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Tienda::all();
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
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'imagen' => 'nullable|image|max:2048',
        ]);

        $imagenPath = null;
        if ($request->hasFile('imagen')) {
            $imagenPath = $request->file('imagen')->store('tiendas', 'public');
        }

        $tienda = Tienda::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'imagen' => $imagenPath,
        ]);

        return response()->json($tienda, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tienda $tienda)
    {
        return $tienda;
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
    public function update(Request $request, Tienda $tienda)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'imagen' => 'nullable|image|max:2048',
        ]);

        // Si la imagen es null, borra la actual
        if ($request->has('imagen') && $request->imagen === null) {
            if ($tienda->imagen) {
                Storage::disk('public')->delete($tienda->imagen);
            }
            $tienda->imagen = null;
        }

        // Si hay una nueva imagen, reemplaza la anterior
        if ($request->hasFile('imagen')) {
            if ($tienda->imagen) {
                Storage::disk('public')->delete($tienda->imagen);
            }
            $imagenPath = $request->file('imagen')->store('tiendas', 'public');
            $tienda->imagen = $imagenPath;
        }

        $tienda->nombre = $request->nombre;
        $tienda->descripcion = $request->descripcion;
        $tienda->save();

        return response()->json($tienda);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tienda $tienda)
    {
        $tienda->delete();
        return response()->json(null, 204);
    }
}
