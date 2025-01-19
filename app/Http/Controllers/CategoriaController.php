<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Events\ModelUpdated;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = Categoria::orderBy('id', 'DESC')->paginate(5);
        return view('categoria.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categoria.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'nullable',
        ]);

        Categoria::create($request->all());

        // Redirigir a la página indicada en el campo oculto
        if ($request->has('redirect_to')) {
            return redirect($request->input('redirect_to'))->with('success', 'Categoría creada con éxito');
        }

        // Redirigir al índice por defecto
        return redirect()->route('categoria.index')->with('success', 'Categoría creada con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $categoria = Categoria::find($id);
        if (!$categoria) {
            return redirect()->route('categoria.index')->with('error', 'Categoría no encontrada');
        }
        return view('categoria.show', compact('categoria'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categoria = Categoria::find($id);
        if (!$categoria) {
            return redirect()->route('categoria.index')->with('error', 'Categoría no encontrada');
        }
        return view('categoria.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required|max:255|unique:categorias,nombre,' . $id,
            'descripcion' => 'nullable|string',
        ]);

        $categoria = Categoria::find($id);

        if (!$categoria) {
            return redirect()->route('categoria.index')->with('error', 'Categoría no encontrada');
        }

        $old_value = $categoria->toArray();

        $categoria->update($request->all());

        $new_value = $categoria->toArray();

        event(new ModelUpdated($categoria, $old_value, $new_value));

        return redirect()->route('categoria.index')->with('success', 'Categoría actualizada satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categoria = Categoria::find($id);
        if (!$categoria) {
            return redirect()->route('categoria.index')->with('error', 'Categoría no encontrada');
        }

        $categoria->delete();
        return redirect()->route('categoria.index')->with('success', 'Categoría eliminada satisfactoriamente');
    }
}
