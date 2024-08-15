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