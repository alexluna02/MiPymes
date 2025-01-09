<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

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
        return view('producto.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validarProducto($request);
        Producto::create($request->all());

        return redirect()->route('producto.index')->with('success', 'Producto creado satisfactoriamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $producto = Producto::findOrFail($id);
        return view('producto.show', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $producto = Producto::findOrFail($id);
        return view('producto.edit', compact('producto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $producto = Producto::findOrFail($id);
        $this->validarProducto($request);
        $producto->update($request->all());

        return redirect()->route('producto.index')->with('success', 'Producto actualizado satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return redirect()->route('producto.index')->with('success', 'Producto eliminado satisfactoriamente');
    }

    /**
     * Filtrar productos por categoría.
     */
    public function filtrarPorCategoria($categoria)
    {
        $productos = Producto::where('tipo_producto', $categoria)->orderBy('nombre', 'ASC')->get();

        if ($productos->isEmpty()) {
            return response()->json(['message' => 'No hay productos en esta categoría.'], 404);
        }

        return response()->json($productos);
    }

    /**
     * Validar los datos del producto.
     */
    private function validarProducto(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric|min:0',
            'cantidad_stock' => 'required|integer|min:0',
            'tipo_producto' => 'required|string',
            'categoria' => 'required|string',
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'año_fabricacion' => 'required|integer|min:1900|max:' . date('Y'),
        ]);
    }
}
