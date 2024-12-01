
<?php

use App\Http\Controllers\ClienteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortafolioController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\Detalle_ventaController;
use App\Http\Controllers\Metodo_pagoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\MantenimientoMaquinariaController;

/*
|--------------------------------------------------------------------------  
| Web Routes  
|--------------------------------------------------------------------------  
|  
| Here is where you can register web routes for your application. These  
| routes are loaded by the RouteServiceProvider within a group which  
| contains the "web" middleware group. Now create something great!  
|  
*/
Route::get('/', function () {
    return view('welcome');
});

Route::get('home', function() {
    return view('home', ['nombre' => 'Usuario invitado']);
});

Route::get('/portafolio', PortafolioController::class);
Route::view('/acerca', 'acerca');
Route::view('/contacto', 'contacto');
Route::post('/contacto', [ContactoController::class, 'store'])->name('contacto');

// Rutas de recursos
Route::resource('/detalle_venta', Detalle_ventaController::class);
Route::resource('/metodo_pago', Metodo_pagoController::class);
Route::resource('/cliente', ClienteController::class);
Route::resource('/producto', ProductoController::class); // Ruta para ProductoController
Route::resource('/proveedor', ProveedorController::class); // Ruta para ProveedorController
Route::resource('/mantenimientomaquinaria', MantenimientoMaquinariaController::class); // Ruta para MantenimientoMaquinariaController
