<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Metodo_pago;

class Metodo_pagoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $metodos=Metodo_pago::orderBy('id','DESC')->paginate(3);
        return view('metodo_pago.index',compact('metodos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('metodo_pago.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([ 'metodo'=>'required', 'descripcion']);
        Metodo_pago::create($request->all());
        return redirect()->route('metodo_pago.index')->with('success','Registro creado satisfactoriamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $metodos=Metodo_pago::find($id);
        return view('metodo_pago.show',compact('metodos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $metodo=Metodo_pago::find($id);
        return view('metodo_pago.edit',compact('metodo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([ 'metodo'=>'required', 'descripcion']);

        $metodo=Metodo_pago::findorfail($id);

        $metodo->metodo=request()->input('metodo');
        $metodo->descripcion=request()->input('descripcion');

        $metodo->save();

        return redirect()->route('metodo_pago.index')->with('success', 'Libro actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Metodo_pago::find($id)->delete();
        return redirect()->route('metodo_pago.index')->with('success','Registro eliminado satisfactoriamente');
    }
}
