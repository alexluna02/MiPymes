<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Categoria;
use App\Events\ModelUpdated;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

class ProductoController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::orderBy('id', 'DESC')->paginate(3);
        return view('producto.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $proveedores = Proveedor::all();
        $categorias = Categoria::all();
        return view('producto.create', compact('proveedores', 'categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'proveedor_id' => 'required|numeric',
            'categoria_id' => 'required|numeric',
            'precio' => 'required|numeric',
            'cantidad_stock' => 'required|integer',
            'marca' => 'required',
            'modelo' => 'required',
            'año_fabricacion' => 'required|integer',
        ]);

        // Crear el nuevo producto
        Producto::create($request->all());

        return redirect()->route('producto.index')->with('success', 'Producto creado satisfactoriamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $producto = Producto::find($id);
        // return view('producto.show', compact('producto'));
        $producto = Producto::with('proveedor',)->findOrFail($id);
        return view('producto.show', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $producto = Producto::find($id);
        return view('producto.edit', compact('producto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'proveedor_id' => 'required|numeric',
            'categoria_id' => 'required|numeric',
            'precio' => 'required|numeric',
            'cantidad_stock' => 'required|integer',
            'marca' => 'required',
            'modelo' => 'required',
            'año_fabricacion' => 'required|integer',
        ]);

        $producto = Producto::find($id);

        if (!$producto) {
            return redirect()->route('producto.index')->with('error', 'Producto no encontrado');
        }

        $old_value = $producto->toArray();

        $producto->nombre = $request->input('nombre');
        $producto->descripcion = $request->input('descripcion');
        $producto->proveedor_id = $request->input('proveedor_id');
        $producto->categoria_id = $request->input('categoria_id');
        $producto->precio = $request->input('precio');
        $producto->cantidad_stock = $request->input('cantidad_stock');
        $producto->marca = $request->input('marca');
        $producto->modelo = $request->input('modelo');
        $producto->año_fabricacion = $request->input('año_fabricacion');

        $producto->save();

        $new_value = $producto->toArray();

        event(new ModelUpdated($producto, $old_value, $new_value));

        return redirect()->route('producto.index')->with('success', 'Producto actualizado satisfactoriamente');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Producto::find($id)->delete();
        return redirect()->route('producto.index')->with('success', 'Producto eliminado satisfactoriamente');
    }
}
