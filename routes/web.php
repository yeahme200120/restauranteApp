<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();
Route::group(['middleware' => 'auth'], function () { 
    
    //Usuarios
    Route::get('/registrarUsuario', [App\Http\Controllers\HomeController::class, 'registrarUsuario'])->name('registrarUsuario');
    Route::post('/createUser', [App\Http\Controllers\HomeController::class, 'createUser'])->name('createUser');
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('usuarios');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('usuarios');

    //Empresas
    Route::get('/empresas', [App\Http\Controllers\HomeController::class, 'empresas'])->name('empresas');
    Route::get('/setEmpresa', [App\Http\Controllers\HomeController::class, 'setEmpresa'])->name('setEmpresa');
    Route::post('/registrarEmpresa', [App\Http\Controllers\HomeController::class, 'registrarEmpresa'])->name('registrarEmpresa');
    Route::get('/editarEmpresa/{id}', [App\Http\Controllers\HomeController::class, 'editarEmpresa'])->name('editarEmpresa');
    Route::post('/actualizarEmpresa', [App\Http\Controllers\HomeController::class, 'actualizarEmpresa'])->name('actualizarEmpresa');
    Route::get('/eliminarEmpresa/{id}', [App\Http\Controllers\HomeController::class, 'eliminarEmpresa'])->name('eliminarEmpresa');
    
    //Provedores
    Route::get('/provedores', [App\Http\Controllers\HomeController::class, 'provedores'])->name('provedores');
    Route::get('/registrarProvedor', [App\Http\Controllers\HomeController::class, 'registrarProvedor'])->name('registrarProvedor');
    Route::post('/createProvedor', [App\Http\Controllers\HomeController::class, 'createProvedor'])->name('createProvedor');
    Route::get('/editarProvedor/{id}', [App\Http\Controllers\HomeController::class, 'editarProvedor'])->name('editarProvedor');
    Route::post('/updateProvedor', [App\Http\Controllers\HomeController::class, 'actualizarProvedor'])->name('actualizarProvedor');
    Route::get('/eliminarProvedor/{id}', [App\Http\Controllers\HomeController::class, 'eliminarProvedor'])->name('eliminarProvedor');

    //Productos
    Route::get('/productos', [App\Http\Controllers\HomeController::class, 'productos'])->name('productos');
    Route::get('/registrarProducto', [App\Http\Controllers\HomeController::class, 'registrarProducto'])->name('registrarProducto');
    Route::post('/createProducto', [App\Http\Controllers\HomeController::class, 'createProducto'])->name('createProducto');
    Route::get('/editarProducto/{id}', [App\Http\Controllers\HomeController::class, 'editarProducto'])->name('editarProducto');
    Route::post('/updateProducto', [App\Http\Controllers\HomeController::class, 'actualizarProducto'])->name('actualizarProducto');
    Route::get('/eliminarProducto/{id}', [App\Http\Controllers\HomeController::class, 'eliminarProducto'])->name('eliminarProducto');

     //Insumos
     Route::get('/insumos', [App\Http\Controllers\HomeController::class, 'insumos'])->name('insumos');
     Route::get('/registrarInsumos', [App\Http\Controllers\HomeController::class, 'registrarInsumos'])->name('registrarInsumos');
     Route::post('/createInsumos', [App\Http\Controllers\HomeController::class, 'createInsumos'])->name('createInsumos');
     Route::get('/editarInsumos/{id}', [App\Http\Controllers\HomeController::class, 'editarInsumos'])->name('editarInsumos');
     Route::post('/updateInsumos', [App\Http\Controllers\HomeController::class, 'actualizarInsumos'])->name('actualizarInsumos');
     Route::get('/eliminarInsumos/{id}', [App\Http\Controllers\HomeController::class, 'eliminarInsumo'])->name('eliminarInsumo');

});


