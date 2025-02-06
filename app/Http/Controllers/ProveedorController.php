<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Events\ModelUpdated;
use Illuminate\Http\Request;
use App\Models\Proveedor;
use App\Events\ModelCreated;

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
        try {
        $proveedor=Proveedor::create($request->all());
        
        $new_value = $proveedor->only(['nombre','telefono','email','direccion']);
        
        event(new ModelCreated($proveedor, $new_value));
        return redirect()->route('proveedor.index')->with('success', 'Registrado con exito');

    } catch (\Illuminate\Database\QueryException $e) {
        // Revertir la transacción en caso de error
        DB::rollBack();

        // Verificar si el error proviene de un trigger
        if ($e->getCode() === 'P0001') { // Código de error para excepciones RAISE en PostgreSQL
            return redirect()->back()->withErrors(['El nombre de proveedor no debe contener carateres especiales ']);
        }

        // Otros errores de la base de datosS
        return redirect()->back()->withErrors(['error' => 'Error al registrar la venta: ' . $e->getMessage()]);
    } catch (\Exception $e) {
        // Manejo de otros errores
        DB::rollBack();
        return redirect()->back()->withErrors(['error' => 'Error inesperado: ' . $e->getMessage()]);
    }
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

        $old_value = $proveedor->only(['nombre','telefono','email','direccion']);

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

        $new_value = $proveedor->only(['nombre','telefono','email','direccion']);
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
