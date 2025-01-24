
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
<<<<<<< HEAD
use App\Http\Controllers\DashboardController;

=======
>>>>>>> 57ce0c0866e8e95c927a89b131ce91feb4c726b2
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\Activity_logController;
use App\Http\Controllers\LoginController; 
use App\Http\Controllers\RepuestoController;
use App\Http\Middleware\Authenticate;


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

Route::get('home', function () {
    return view('home', ['nombre' => 'Usuario invitado']);
});

Route::get('index', function () {
    return view('index', ['nombre' => 'Usuario invitado']);
});

Route::get('/portafolio', PortafolioController::class);
Route::view('/acerca', 'acerca');
Route::view('/contacto', 'contacto');
Route::post('/contacto', [ContactoController::class, 'store'])->name('contacto');

// Rutas de recursos
Route::view('/login', 'login')->name('login');
Route::view('/menu', 'menu')->name('menu');

Route::post('/validar-registro', [LoginController::class, 'registrar'])->name('validar-registro');
Route::post('/iniciar-sesion', [LoginController::class, 'login'])->name('iniciar-sesion');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/registro', [LoginController::class, 'registro'])->name('registro');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('/producto', ProductoController::class);
    Route::get('/activity_log', [Activity_logController::class, 'index']);
    Route::resource('/detalle_venta', Detalle_ventaController::class);
    Route::resource('/metodo_pago', Metodo_pagoController::class);
    Route::resource('/cliente', ClienteController::class);
    Route::resource('/producto', ProductoController::class);
    Route::resource('/proveedor', ProveedorController::class);
    Route::resource('/mantenimientomaquinaria', MantenimientoMaquinariaController::class);
    Route::resource('/parametro', ParametroController::class);
    Route::resource('/venta', VentaController::class);
    Route::resource('/categoria', CategoriaController::class);
    Route::resource('/repuesto', RepuestoController::class);
    Route::view('/index', 'index')->middleware('auth')->name('index');
});

Route::group(['middleware' => ['auth']], function () {});

Route::get('/activity_log', [Activity_logController::class, 'index'])->middleware(Authenticate::class . ':admin');
