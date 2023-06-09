<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\ProductoController;

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

Route::get('/', function () {
    return view('home');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/user', [UserController::class, 'index'])->name('user.index');

    Route::get('/productos', [ProductosController::class, 'index'])->name('productos.index');
    Route::get('/categoria', [CategoriaController::class, 'index'])->name('categoria.index');
    
    
    

    Route::post('/productos/guardar',[ProductosController::class,'guardar'])->name('productos.guardar');
});
