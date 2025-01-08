<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Cliente;
use App\Models\Metodo_pago;
use App\Models\Producto;
use App\Models\Venta;
use App\Models\Detalle_venta;

class Detalle_ventaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $detalles = Detalle_venta::orderBy('id', 'DESC')->paginate(3);
        return view('detalle_venta.index', compact('detalles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productos = Producto::all(); // Asegúrate de que este modelo está definido
        $ventas = Venta::all();
        $productos = Producto::all();
        return view('detalle_venta.create', compact('productos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'venta_id' => 'required',
            'producto_id' => 'required',
            'cantidad' => 'required|numeric',
            'precio_unitario' => 'required|numeric',
            'descuento' => 'required|numeric',
            'impuesto' => 'required|numeric'
        ]);

        $cantidad = $request->input('cantidad');
        $precio_unitario = $request->input('precio_unitario');
        $subtotal = $cantidad * $precio_unitario;

        $descuento = $request->input('descuento');
        $descuentototal = ($descuento * $subtotal) / 100;

        $impuesto = $request->input('impuesto');
        $impuestototal = ($impuesto * $subtotal) / 100;

        $total_linea = ($subtotal - $descuentototal) + $impuestototal;

        Detalle_venta::create([
            'venta_id' => $request->input('venta_id'),
            'producto_id' => $request->input('producto_id'),
            'cantidad' => $cantidad,
            'precio_unitario' => $precio_unitario,
            'subtotal' => $subtotal,
            'descuento' => $descuento,
            'impuesto' => $impuesto,
            'total_linea' => $total_linea
        ]);

        return redirect()->route('detalle_venta.index')->with('success', 'Registro creado satisfactoriamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $detalles = Detalle_venta::find($id);
        return view('detalle_venta.show', compact('detalles'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $detalle = Detalle_venta::find($id);
        return view('detalle_venta.edit', compact('detalle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'venta_id' => 'required',
            'producto_id' => 'required',
            'cantidad' => 'required|numeric',
            'precio_unitario' => 'required|numeric',
            'descuento' => 'required|numeric',
            'impuesto' => 'required|numeric'
        ]);

        $detalle=Detalle_venta::findorfail($id);

        $cantidad = $request->input('cantidad');
        $precio_unitario = $request->input('precio_unitario');
        $subtotal = $cantidad * $precio_unitario;

        $descuento = $request->input('descuento');
        $descuentototal = ($descuento * $subtotal) / 100;

        $impuesto = $request->input('impuesto');
        $impuestototal = ($impuesto * $subtotal) / 100;

        $total_linea = ($subtotal - $descuentototal) + $impuestototal;


        $detalle->venta_id=request()->input('venta_id');
        $detalle->producto_id=request()->input('producto_id');
        $detalle->cantidad=$cantidad;
        $detalle->precio_unitario=$precio_unitario;;
        $detalle->subtotal=$subtotal;
        $detalle->descuento=$descuento;
        $detalle->impuesto=$impuesto;
        $detalle->total_linea=$total_linea;

        $detalle->save();

        return redirect()->route('detalle_venta.index')->with('success', 'Libro actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Detalle_venta::find($id)->delete();
        return redirect()->route('detalle_venta.index')->with('success', 'Registro eliminado satisfactoriamente');
    }
}
