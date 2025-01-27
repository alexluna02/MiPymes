<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Proveedor;
use App\Models\Producto;
use App\Models\Cliente;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Año seleccionado (por defecto, el actual)
        $anio = $request->query('anio', date('Y'));

        // Datos de productos por categoría
        $categorias = \App\Models\Categoria::all()->pluck('nombre');
        $valoresCategorias = \App\Models\Categoria::withCount('productos')->get()->pluck('productos_count');
        // Datos de productos por proveedor
        $prod_prov = Proveedor::all()->pluck('nombre');
        $valoresprod_prov = Proveedor::withCount('productos')->get()->pluck('productos_count');

        // Ventas por mes del año seleccionado
        $ventasPorMes = Venta::select(DB::raw('EXTRACT(MONTH FROM fecha_venta) as month, COUNT(*) as total'))
            ->whereYear('fecha_venta', $anio)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $meses = collect(range(1, 12))->map(function ($mes) {
            return DateTime::createFromFormat('!m', $mes)->format('F');
        });

        $valoresVentas = $meses->map(function ($mes, $indice) use ($ventasPorMes) {
            $venta = $ventasPorMes->firstWhere('month', $indice + 1);
            return $venta ? $venta->total : 0;
        });
        //total dde las tablas
        $totalProductos = Producto::count();
        $totalVentas = Venta::count();
        $totalClientes = Cliente::count();
        $totalProveedores = Proveedor::count();
        return view('dashboard.index', [
            'categorias' => $categorias,
            'valores' => $valoresCategorias,
            'meses' => $meses,
            'valoresVentas' => $valoresVentas,
            'anio' => $anio,
            'prod_prov' => $prod_prov,
            'valoresprod_prov' => $valoresprod_prov,
            'totalProductos' => $totalProductos,
            'totalVentas' => $totalVentas,
            'totalClientes' => $totalClientes,
            'totalProveedores' => $totalProveedores,

        ]);
    }
}
