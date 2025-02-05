<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\LoginController;
/*
use App\Http\Controllers\LoginController;

use App\Http\Controllers\ProductoController;

Route::group(['prefix' => 'auth'], function () {
    Route::post('validar-registro', [LoginController::class, 'registrar']);
    Route::post('iniciar-sesion', [LoginController::class, 'login']);
    Route::post('logout', [LoginController::class, 'logout']);
    Route::post('refresh', [LoginController::class, 'refresh']);
    Route::get('user-profile', [LoginController::class, 'userProfile']);
});

Route::middleware('auth')->group(function () {
    Route::get('user-profile', [LoginController::class, 'userProfile']);
    Route::view('/index', 'index')->name('index');
    Route::resource('/producto', ProductoController::class);
});
*/

Route::view('/loginapi', 'loginapi')->name('loginapi');
Route::view('/consultasapi', 'api')->name('api');
Route::post('login',LoginController::class);
    Route::get('/users',[UserController::class,'index']);

Route::get('/pro',function(){
    return 'La api funciona';});

Route::group(['middleware'=>'api'],function(){
    
   
});