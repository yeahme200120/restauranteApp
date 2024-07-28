<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Auth::routes();
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('usuarios');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('usuarios');
    Route::get('/empresas', [App\Http\Controllers\HomeController::class, 'empresas'])->name('empresas');
    Route::get('/setEmpresa', [App\Http\Controllers\HomeController::class, 'setEmpresa'])->name('setEmpresa');
    Route::post('/registrarEmpresa', [App\Http\Controllers\HomeController::class, 'registrarEmpresa'])->name('registrarEmpresa');
    Route::get('/editarEmpresa/{id}', [App\Http\Controllers\HomeController::class, 'editarEmpresa'])->name('editarEmpresa');
    Route::post('/actualizarEmpresa', [App\Http\Controllers\HomeController::class, 'actualizarEmpresa'])->name('actualizarEmpresa');
    Route::get('/eliminarEmpresa/{id}', [App\Http\Controllers\HomeController::class, 'eliminarEmpresa'])->name('eliminarEmpresa');
    Route::get('/registrarUsuario', [App\Http\Controllers\HomeController::class, 'registrarUsuario'])->name('registrarUsuario');
    Route::get('/createUser', [App\Http\Controllers\HomeController::class, 'createUser'])->name('createUser');
});


