<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Ejemplo: Datos de productos por categoría
        $categorias = Producto::select('categoria_id', DB::raw('count(*) as total'))
            ->groupBy('categoria_id')
            ->get();

        $nombresCategorias = $categorias->pluck('categoria_id')->map(function ($id) {
            return \App\Models\Categoria::find($id)->nombre ?? 'Sin categoría';
        });

        $valoresCategorias = $categorias->pluck('total');

        // Obtener el número de ventas por mes
        $ventasPorMes = Venta::select(DB::raw('EXTRACT(YEAR FROM fecha_venta) as year, EXTRACT(MONTH FROM fecha_venta) as month, COUNT(*) as total'))
    ->groupBy('year', 'month')
    ->orderBy('year', 'asc')
    ->orderBy('month', 'asc') // Asegura el orden correcto por año y mes
    ->get();

$meses = $ventasPorMes->map(function ($venta) {
    return $venta->year . '-' . str_pad($venta->month, 2, '0', STR_PAD_LEFT);
});

$valoresVentas = $ventasPorMes->pluck('total');


        return view('dashboard.index', [
            'categorias' => $nombresCategorias,
            'valores' => $valoresCategorias,
            'meses' => $meses,
            'valoresVentas' => $valoresVentas
        ]);
    }
}

