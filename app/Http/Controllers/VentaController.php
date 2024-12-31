<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Cliente;
use App\Models\Metodo_pago;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    public function index()
    {
        $ventas = Venta::with('cliente', 'metodoPago')->orderBy('id', 'DESC')->paginate(10);
        return view('venta.index', compact('ventas'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        $metodosPago = Metodo_pago::all();
        return view('venta.create', compact('clientes', 'metodosPago'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'total' => 'required|numeric',
            'metodo_pago_id' => 'required|exists:metodos_pago,id',
            'estado' => 'required|string',
            'fecha_entrega' => 'required|date',
            'direccion_entrega' => 'required|string',
            'comentarios' => 'nullable|string',
        ]);

        Venta::create($request->all());

        return redirect()->route('venta.index')->with('success', 'Venta registrada con éxito');
    }

    public function show($id)
    {
        $venta = Venta::with('cliente', 'metodoPago')->findOrFail($id);
        return view('venta.show', compact('venta'));
    }

    public function edit($id)
    {
        $venta = Venta::findOrFail($id);
        $clientes = Cliente::all();
        $metodosPago = Metodo_pago::all();
        return view('venta.edit', compact('venta', 'clientes', 'metodosPago'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'total' => 'required|numeric',
            'metodo_pago_id' => 'required|exists:metodos_pago,id',
            'estado' => 'required|string',
            'fecha_entrega' => 'required|date',
            'direccion_entrega' => 'required|string',
            'comentarios' => 'nullable|string',
        ]);

        $venta = Venta::findOrFail($id);
        $venta->update($request->all());

        return redirect()->route('venta.index')->with('success', 'Venta actualizada con éxito');
    }

    public function destroy($id)
    {
        Venta::findOrFail($id)->delete();
        return redirect()->route('venta.index')->with('success', 'Venta eliminada con éxito');
    }
}