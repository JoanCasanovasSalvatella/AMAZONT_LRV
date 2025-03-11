<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;

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

//RUTAS SOBRE LOS USUSARIOS
Route::get('/user/All', [UserController::class, 'mostrarUser']);
Route::get('/user/Only/{id}', [UserController::class, 'mostrarUnSoloUser']);
Route::post('/user/Create', [UserController::class, 'crearUser']);
Route::post('/user/Login', [UserController::class, 'loginUser']);
Route::put('/user/Modify/{id}', [UserController::class, 'modificarUser']);
Route::patch('/user/ModifyCamp/{id}', [UserController::class, 'modificarCampoUser']);
Route::delete('/user/Delete/{id}', [UserController::class, 'eliminarUser']);

//RUTAS SOBRE LAS CATEGORIAS
Route::get('/category/All', [CategoriaController::class, 'mostrarCategory']);
Route::get('/category/Only/{id}', [CategoriaController::class, 'mostrarUnSoloCategory']);
Route::post('/category/Create', [CategoriaController::class, 'crearCategory']);
Route::put('/category/Modify/{id}', [CategoriaController::class, 'modificarCategory']);
Route::patch('/category/ModifyCamp/{id}', [CategoriaController::class, 'modificarCampoCategory']);
Route::delete('/category/Delete/{id}', [CategoriaController::class, 'eliminarCategory']);

//RUTAS SOBRE LAS CATEGORIAS
Route::get('/product/All', [ProductoController::class, 'mostrarProduct']);
Route::get('/product/Only/{id}', [ProductoController::class, 'mostrarUnSoloProduct']);
Route::post('/product/Create', [ProductoController::class, 'crearProduct']);
Route::put('/product/Modify/{id}', [ProductoController::class, 'modificarProduct']);
Route::patch('/product/ModifyCamp/{id}', [ProductoController::class, 'modificarCampoProduct']);
Route::delete('/product/Delete/{id}', [ProductoController::class, 'eliminarProduct']);
