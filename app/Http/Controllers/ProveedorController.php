<?php

namespace App\Http\Controllers;

use App\Events\ModelUpdated;
use Illuminate\Http\Request;
use App\Models\Proveedor;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proveedores = Proveedor::orderBy('id', 'DESC')->paginate(3);
        return view('proveedor.index', compact('proveedores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('proveedor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'email' => 'required'
        ]);
        Proveedor::create($request->all());
        return redirect()->route('proveedor.index')->with('success', 'Registrado con exito');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $proveedores = Proveedor::find($id);
        return view('proveedor.index', compact('proveedores'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $proveedor = Proveedor::find($id);
        return view('proveedor.edit', compact('proveedor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $proveedor = Proveedor::find($id);
        if (!$proveedor) {
            return redirect()->route('proveedor.index')->with('error', 'Proveedor no encontrado');
        }

        $old_value = $proveedor->toArray();

        $request->validate([
            'nombre' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'email' => 'required'
        ]);

        $proveedor->nombre = $request->input('nombre');
        $proveedor->direccion = $request->input('direccion');
        $proveedor->telefono = $request->input('telefono');
        $proveedor->email = $request->input('email');
        $proveedor->save();

        $new_value = $proveedor->toArray();
        event(new ModelUpdated($proveedor, $old_value, $new_value));

        return redirect()->route('proveedor.index')->with('success', 'Proveedor actualizado satisfactoriamente');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Proveedor::find($id)->delete();
        return redirect()->route('proveedor.index')->with('success', 'Registro eliminado satisfactoriamente');
    }
}
