<?php

namespace App\Http\Controllers;

use App\Models\Parametro;
use Illuminate\Http\Request;
use App\Events\ModelUpdated;

class ParametroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parametros = Parametro::orderBy('tipo', 'DESC')->paginate(10);
        return view('parametro.index', compact('parametros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('parametro.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'valor' => 'required|numeric',
            'tipo' => 'required|string',
            
        ]);
        $parametro = new Parametro([
            'nombre' => $request->input('nombre'),
            'valor' => $request->input('valor'),
            'descripcion' => $request->input('descripcion'),
            'tipo' => $request->input('tipo'),
            'estado' => false, 
        ]);
    
        $parametro->save();
        //Parametro::create($request->all());

        return redirect()->route('parametro.index')->with('success', 'Parámetro creado satisfactoriamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $parametro = Parametro::find($id);
        return view('parametro.show', compact('parametro'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $parametro = Parametro::find($id);
        return view('parametro.edit', compact('parametro'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
            'valor' => 'required|numeric',
            'tipo' => 'required|string',
            'estado'=>'required|boolean',
        ]);

        $parametro = Parametro::find($id);

        if (!$parametro) {
            return redirect()->route('parametro.index')->with('error', 'Parámetro no encontrado');
        }

        $old_value = $parametro->toArray();

        $parametro->update($request->all());

        $new_value = $parametro->toArray();

        event(new ModelUpdated($parametro, $old_value, $new_value));

        return redirect()->route('parametro.index')->with('success', 'Parámetro actualizado satisfactoriamente.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Parametro::find($id)->delete();
        return redirect()->route('parametro.index')->with('success', 'Parámetro eliminado satisfactoriamente.');
    }
    public function cambiarEstado(Request $request, $id)
{
    $parametro = Parametro::findOrFail($id);

    if ($request->tipo === 'impuesto') {
        // Desactivar todos los otros impuestos
        Parametro::where('tipo', 'impuesto')->update(['estado' => false]);
    }

    if ($request->tipo === 'descuento' || $request->tipo === 'impuesto') {
        // Cambiar el estado del parámetro actual
        $parametro->estado = $request->estado;
        $parametro->save();
    }

    return response()->json(['success' => true]);
}

}
