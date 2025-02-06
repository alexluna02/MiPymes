<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Detalle_venta;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Metodo_pago;
use App\Models\Parametro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Events\ModelUpdated;
use App\Events\ModelCreated;

class VentaController extends Controller
{
    public function index()
    {
        $metodoPago = Metodo_pago::all();
        $ventas = Venta::orderBy('id', 'DESC')->paginate(10);
        return view('venta.index', compact('ventas','metodoPago'));
    }

    public function create()
    {
        $ventas = Venta::all();
        $clientes = Cliente::all();
        $metodosPago = Metodo_pago::all();
        $productos = Producto::all();
        $iva = Parametro::where('estado', true)->where('nombre', 'IVA')->first();

        return view('venta.create', compact('iva','clientes', 'metodosPago', 'productos', 'ventas'));
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'cod_factura' => 'required|string',
            'cliente_id' => 'required|exists:clientes,id',
            'total' => 'required|numeric',
            'metodo_pago_id' => 'required|exists:metodo_pago,id',
            'comentarios' => 'nullable|string',
            'detalles' => 'required|array',
            'detalles.*.producto_id' => 'required|exists:productos,id',
            'detalles.*.cantidad' => 'required|numeric|min:1',
            'detalles.*.precio_unitario' => 'required|numeric|min:0',
            'detalles.*.subtotal' => 'required|numeric|min:0',
        ]);
    
        try {
            // Iniciar una transacción de base de datos
            DB::beginTransaction();
    
            // Crear la venta
            $venta = Venta::create($request->only([
                'cod_factura',
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
                    'impuesto' => 0.15,
                    'total_linea' => $detalle['subtotal'] + ($detalle['subtotal'] * 0.15),
                ]);
            }
            
    
            // Confirmar la transacción
            DB::commit();

            $new_value = $venta->toArray();

            event(new ModelCreated($venta,  $new_value));
            return redirect()->route('venta.index')->with('success', 'Venta registrada con éxito');
    
        } catch (\Illuminate\Database\QueryException $e) {
            // Revertir la transacción en caso de error
            DB::rollBack();
    
            // Verificar si el error proviene de un trigger
            if ($e->getCode() === 'P0001') { // Código de error para excepciones RAISE en PostgreSQL
                return redirect()->back()->withErrors(['No hay suficiente cantidad en el stock']);
            }
    
            // Otros errores de la base de datos
            return redirect()->back()->withErrors(['error' => 'Error al registrar la venta: ' . $e->getMessage()]);
        } catch (\Exception $e) {
            // Manejo de otros errores
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Error inesperado: ' . $e->getMessage()]);
        }
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

        $productos = Producto::all();
        return view('venta.edit', compact('venta', 'clientes', 'metodosPago','productos'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'cod_factura' => 'required|string',
            'cliente_id' => 'required|exists:clientes,id',
            'total' => 'required|numeric',
            'metodo_pago_id' => 'required|exists:metodo_pago,id',
            'comentarios' => 'nullable|string',
            'detalles' => 'required|array',
            'detalles.*.producto_id' => 'required|exists:productos,id',
            'detalles.*.cantidad' => 'required|numeric|min:1',
            'detalles.*.precio_unitario' => 'required|numeric|min:0',
            'detalles.*.subtotal' => 'required|numeric|min:0',
        ]);


        try {

        $venta = Venta::findOrFail($id);
            $old_value = $venta->toArray();

        DB::transaction(function () use ($request, $id) {
            $venta = Venta::findOrFail($id);
            $venta->update($request->only([
                'cod_factura',
                'cliente_id',
                'total',
                'metodo_pago_id',
                'comentarios',
            ]));

            // Actualizar detalles
            foreach ($request->input('detalles') as $detalle) {
                $detalleVenta = Detalle_venta::find($detalle['id']);
                $subtotal = $detalle['cantidad'] * $detalle['precio_unitario'];
                $total_linea = $subtotal + ($subtotal * $detalle['iva'] / 100); // Si tienes IVA
                if ($detalleVenta) {
                    $detalleVenta->update([
                        'producto_id' => $detalle['producto_id'],
                        'cantidad' => $detalle['cantidad'],
                        'precio_unitario' => $detalle['precio_unitario'],
                        'subtotal' => $detalle['subtotal'],
                        'descuento' => $detalle['descuento'],
                        'impuesto' => $detalle['iva'],

                    ]);
                }
            }
        });
        
        
        $new_value = $venta->toArray();

        event(new ModelUpdated($venta, $old_value, $new_value));

        return redirect()->route('venta.index')->with('success', 'Venta actualizada con éxito');

    } catch (\Illuminate\Database\QueryException $e) {
        // Revertir la transacción en caso de error
        DB::rollBack();

        // Verificar si el error proviene de un trigger
        if ($e->getCode() === 'P0001') { // Código de error para excepciones RAISE en PostgreSQL
            return redirect()->back()->withErrors(['No hay suficiente cantidad en el stock']);
        }

        // Otros errores de la base de datos
        return redirect()->back()->withErrors(['error' => 'Error al registrar la venta: ' . $e->getMessage()]);
    } catch (\Exception $e) {
        // Manejo de otros errores
        DB::rollBack();
        return redirect()->back()->withErrors(['error' => 'Error inesperado: ' . $e->getMessage()]);
    }
        
    }

    public function destroy($id)
    {
        Venta::findOrFail($id)->delete();
        return redirect()->route('venta.index')->with('success', 'Venta eliminada con éxito');
    }
}
