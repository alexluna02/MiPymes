<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Events\ModelUpdated;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::orderBy('id', 'DESC')->paginate(3);
        return view('cliente.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cliente.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'nombre' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'email' => 'required',
            'fecha_registro' => 'required'
        ]);

        // Crear el nuevo cliente
        Cliente::create($request->all());

        return redirect()->route('cliente.index')->with('success', 'Registro creado satisfactoriamente');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $clientes = Cliente::find($id);
        return  view('cliente.show', compact('clientes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cliente = cliente::find($id);
        return view('cliente.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'id' => 'required',
            'nombre' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'email' => 'required',
            'fecha_registro' => 'required'
        ]);

        $cliente = Cliente::find($id);

        if (!$cliente) {
            return redirect()->route('cliente.index')->with('error', 'Cliente no encontrado');
        }

        $old_value = $cliente->toArray();

        $cliente->id = $request->input('id');
        $cliente->nombre = $request->input('nombre');
        $cliente->direccion = $request->input('direccion');
        $cliente->telefono = $request->input('telefono');
        $cliente->email = $request->input('email');
        $cliente->fecha_registro = $request->input('fecha_registro');

        $cliente->save();

        $new_value = $cliente->toArray();

        event(new ModelUpdated($cliente, $old_value, $new_value));

        return redirect()->route('cliente.index')->with('success', 'Cliente actualizado satisfactoriamente');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Cliente::find($id)->delete();
        return redirect()->route('cliente.index')->with('success', 'Registro eliminado satisfactoriamente');
    }
}
