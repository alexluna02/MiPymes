<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MantenimientoMaquinaria;
use App\Events\ModelUpdated;

class MantenimientoMaquinariaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mantenimientomaquinarias = MantenimientoMaquinaria::orderBy('id', 'DESC')->paginate(3);
        return view('mantenimientomaquinaria.index', compact('mantenimientomaquinarias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mantenimientomaquinaria.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos
        $request->validate([
            'producto_id' => 'required|exists:producto,id',
            'venta_id' => 'required|exists:venta,id',
            'fecha_mantenimiento' => 'required|date',
            'tipo_mantenimiento' => 'required|string|max:100',
            'descripcion' => 'required|string',
            'costo' => 'required|numeric|min:0',
            'estado_post_mantenimiento' => 'required|string|max:100',
        ]);

        // Crear un nuevo registro
        MantenimientoMaquinaria::create($request->all());

        // Redirigir con mensaje de éxito
        return redirect()->route('mantenimientomaquinaria.index')->with('success', 'Registro creado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $mantenimientomaquinarias = MantenimientoMaquinaria::find($id);
        return view('mantenimientomaquinaria.index', compact('mantenimiento_maquinaria'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $mantenimientomaquinaria = MantenimientoMaquinaria::find($id);
        return view('mantenimientomaquinaria.edit', compact('mantenimientomaquinaria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'producto_id' => 'required|exists:producto,id',
            'venta_id' => 'required|exists:venta,id',
            'fecha_mantenimiento' => 'required|date',
            'tipo_mantenimiento' => 'required|string|max:100',
            'descripcion' => 'required|string',
            'costo' => 'required|numeric|min:0',
            'estado_post_mantenimiento' => 'required|string|max:100',
        ]);

        $mantenimiento = MantenimientoMaquinaria::findOrFail($id);

        if (!$mantenimiento) {
            return redirect()->route('mantenimientomaquinaria.index')->with('error', 'Registro no encontrado');
        }

        $old_value = $mantenimiento->toArray();

        $mantenimiento->update($request->all());

        $new_value = $mantenimiento->toArray();

        event(new ModelUpdated($mantenimiento, $old_value, $new_value));

        return redirect()->route('mantenimientomaquinaria.index')->with('success', 'Registro actualizado con éxito');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        MantenimientoMaquinaria::find($id)->delete();
        return redirect()->route('mantenimientomaquinaria.index')->with('success', 'Registro eliminado satisfactoriamente');
    }
}
