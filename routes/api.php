<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/getCP/{cp}', [App\Http\Controllers\ApiController::class, 'getCP'])->name('getCP');
Route::post('/logIn', [App\Http\Controllers\ApiController::class, 'login'])->name('login');
Route::post('/getCatalogos', [App\Http\Controllers\ApiController::class, 'getCatalogos'])->name('getCatalogos');
Route::post('/setProducto', [App\Http\Controllers\ApiController::class, 'setProducto'])->name('setProducto');
Route::post('/setInsumo', [App\Http\Controllers\ApiController::class, 'setInsumo'])->name('setInsumo');
Route::post('/setProvedor', [App\Http\Controllers\ApiController::class, 'setProvedor'])->name('setProvedor');
Route::post('/setTurnos', [App\Http\Controllers\ApiController::class, 'setTurnos'])->name('setTurnos');
//Actualizar Contraseña
Route::post('/changePasswordApi', [App\Http\Controllers\ApiController::class, 'changePasswordApi'])->name('changePasswordApi');
//Catalogos separados
Route::post('/getAreasApi', [App\Http\Controllers\ApiController::class, 'getAreasApi'])->name('getAreasApi');
Route::post('/getCategoriasApi', [App\Http\Controllers\ApiController::class, 'getCategoriasApi'])->name('getCategoriasApi');
Route::post('/getInsumosApi', [App\Http\Controllers\ApiController::class, 'getInsumosApi'])->name('getInsumosApi');
Route::post('/getProductosApi', [App\Http\Controllers\ApiController::class, 'getProductosApi'])->name('getProductosApi');
Route::post('/getProvedoresApi', [App\Http\Controllers\ApiController::class, 'getProvedoresApi'])->name('getProvedoresApi');
Route::post('/getUnidadesApi', [App\Http\Controllers\ApiController::class, 'getUnidadesApi'])->name('getUnidadesApi');
Route::post('/getAreaAlmacenApi', [App\Http\Controllers\ApiController::class, 'getAreaAlmacenApi'])->name('getAreaAlmacenApi');
Route::post('/setAreaAlmacenApi', [App\Http\Controllers\ApiController::class, 'setAreaAlmacenApi'])->name('setAreaAlmacenApi');
Route::post('/getEstatusProducto', [App\Http\Controllers\ApiController::class, 'getEstatusProducto'])->name('getEstatusProducto');
Route::post('/getEmpresaName', [App\Http\Controllers\ApiController::class, 'getEmpresaName'])->name('getEmpresaName');
Route::get('/getRolUsuarios', [App\Http\Controllers\ApiController::class, 'getRolUsuarios'])->name('getRolUsuarios');
Route::post('/getTurnoUsuario', [App\Http\Controllers\ApiController::class, 'getTurnoUsuario'])->name('getTurnoUsuario');
Route::post('/getEstatusUsuarios', [App\Http\Controllers\ApiController::class, 'getEstatusUsuarios'])->name('getEstatusUsuarios');
Route::post('/getUsuariosEmpresa', [App\Http\Controllers\ApiController::class, 'getUsuariosEmpresa'])->name('getUsuariosEmpresa');
Route::post('/registraUsuario', [App\Http\Controllers\ApiController::class, 'registraUsuario'])->name('registraUsuario');
Route::post('/updateUsuarios', [App\Http\Controllers\ApiController::class, 'updateUsuarios'])->name('updateUsuarios');
Route::post('/getUsuarioLogeado', [App\Http\Controllers\ApiController::class, 'getUsuarioLogueado'])->name('getUsuarioLogueado');

