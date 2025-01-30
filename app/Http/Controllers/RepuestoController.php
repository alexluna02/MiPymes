<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Repuesto;
use App\Models\Categoria;
use App\Events\ModelUpdated;

class RepuestoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $repuestos = Repuesto::orderBy('id', 'DESC')->paginate(3);
        return view('repuesto.index', compact('repuestos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::All();
        return view('repuesto.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'precio' => 'required|numeric',
            'cantidad_stock' => 'required|integer',
            'categoria_id' => 'required',
            'marca' => 'required',
            'modelo' => 'required',
            'año_fabricacion' => 'required|integer',
        ]);

        // Crear el nuevo repuesto
        Repuesto::create($request->all());

        return redirect()->route('repuesto.index')->with('success', 'Repuesto creado satisfactoriamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $repuesto = Repuesto::find($id);
        return view('repuesto.show', compact('repuesto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $repuesto = Repuesto::find($id);
        $categorias = Categoria::All();
        return view('repuesto.edit', compact('repuesto', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'precio' => 'required|numeric',
            'cantidad_stock' => 'required|integer',
            'categoria_id' => 'required',
            'marca' => 'required',
            'modelo' => 'required',
            'año_fabricacion' => 'required|integer',
        ]);

        $repuesto = Repuesto::find($id);

        if (!$repuesto) {
            return redirect()->route('repuesto.index')->with('error', 'Repuesto no encontrado');
        }

        $old_value = $repuesto->toArray();

        $repuesto->nombre = $request->input('nombre');
        $repuesto->descripcion = $request->input('descripcion');
        $repuesto->precio = $request->input('precio');
        $repuesto->cantidad_stock = $request->input('cantidad_stock');
        $repuesto->categoria_id = $request->input('categoria_id');
        $repuesto->marca = $request->input('marca');
        $repuesto->modelo = $request->input('modelo');
        $repuesto->año_fabricacion = $request->input('año_fabricacion');

        $repuesto->save();

        $new_value = $repuesto->toArray();

        event(new ModelUpdated($repuesto, $old_value, $new_value));

        return redirect()->route('repuesto.index')->with('success', 'Repuesto actualizado satisfactoriamente');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Repuesto::find($id)->delete();
        return redirect()->route('repuesto.index')->with('success', 'Repuesto eliminado satisfactoriamente');
    }
}
