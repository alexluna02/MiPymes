<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Detalle_venta;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Metodo_pago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
{
    public function index()
    {
        $ventas = Venta::orderBy('id', 'DESC')->paginate(10);
        return view('venta.index', compact('ventas'));
    }

    public function create()
    {
        $ventas = Venta::all();
        $clientes = Cliente::all();
        $metodosPago = Metodo_pago::all();
        $productos = Producto::all();
        return view('venta.create', compact('clientes', 'metodosPago', 'productos', 'ventas'));
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'total' => 'required|numeric',
            'metodo_pago_id' => 'required|exists:metodo_pago,id',
            'estado' => 'required|string',
            'fecha_entrega' => 'required|date',
            'direccion_entrega' => 'required|string',
            'comentarios' => 'nullable|string',
            'detalles' => 'required|array',
            'detalles.*.producto_id' => 'required|exists:productos,id',
            'detalles.*.cantidad' => 'required|numeric|min:1',
            'detalles.*.precio_unitario' => 'required|numeric|min:0',
            'detalles.*.subtotal' => 'required|numeric|min:0',
        ]);

        // Iniciar una transacción de base de datos



        // Crear la venta
        $venta = Venta::create($request->only([
            'cliente_id',
            'total',
            'metodo_pago_id',
            'estado',
            'fecha_entrega',
            'direccion_entrega',
            'comentarios'
        ]));

        // Guardar los detalles de la venta
        foreach ($request->input('detalles') as $detalle) {
            Detalle_venta::create([
                'venta_id' => $venta->id,
                'producto_id' => $detalle['producto_id'],
                'cantidad' => $detalle['cantidad'],
                'precio_unitario' => $detalle['precio_unitario'],
                'subtotal' => $detalle['subtotal'],
                'descuento' => $detalle['descuento'],
                //'impuesto' => $detalle['subtotal'],
                //'descuento' => 50,
                'impuesto' => 0.15,
                'total_linea' => $detalle['subtotal']+($detalle['subtotal'] * 0.15),
            ]);
        }

        // Confirmar la transacción
        //Venta::create($request->all());

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
