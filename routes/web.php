
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
use App\Http\Controllers\ParametroController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\DashboardController;

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\Activity_logController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RepuestoController;


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

Route::get('index', function() {
    return view('index', ['nombre' => 'Usuario invitado']);
});

Route::get('/portafolio', PortafolioController::class);
Route::view('/acerca', 'acerca');
Route::view('/contacto', 'contacto');
Route::post('/contacto', [ContactoController::class, 'store'])->name('contacto');

// Rutas de recursos
Route::resource('/detalle_venta', Detalle_ventaController::class);
Route::resource('/metodo_pago', Metodo_pagoController::class);
Route::resource('/cliente', ClienteController::class);
Route::resource('/producto', ProductoController::class); 
Route::resource('/proveedor', ProveedorController::class); 
Route::resource('/mantenimientomaquinaria', MantenimientoMaquinariaController::class); 
Route::resource('/parametro', ParametroController::class); 
Route::resource('/venta', VentaController::class); 

Route::resource('/categoria', CategoriaController::class); 

Route::resource('/activity_log', Activity_logController::class);

Route::resource('/repuesto', RepuestoController::class);

/*Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/admin', [ventaController::class, 'index']);
});*/

Route::view('/login','login')->name('login');
Route::view('/registro','registro')->name('registro');
Route::view('/index', 'index')->middleware('auth')->name('index');

Route::post('/validar-registro',[LoginController::class,'registrar'])->name('validar-registro');
Route::post('/iniciar-sesion',[LoginController::class,'login'])->name('iniciar-sesion');
Route::get('/logout',[LoginController::class,'logout'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('/producto', ProductoController::class); 
});
