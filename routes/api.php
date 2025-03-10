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
Route::get('/userAll', [UserController::class, 'mostrarUser']);
Route::get('/userOnly/{id}', [UserController::class, 'mostrarUnSoloUser']);
Route::post('/userCreate', [UserController::class, 'crearUser']);
Route::put('/userModify/{id}', [UserController::class, 'modificarUser']);
Route::patch('/userModifyCamp/{id}', [UserController::class, 'modificarCampoUser']);
Route::delete('/userDelete/{id}', [UserController::class, 'eliminarUser']);

//RUTAS SOBRE LAS CATEGORIAS
Route::get('/categoryAll', [UserController::class, 'mostrarCategory']);
Route::get('/categoryOnly/{id}', [UserController::class, 'mostrarUnSoloCategory']);
Route::post('/categoryCreate', [UserController::class, 'crearCategory']);
Route::put('/categoryModify/{id}', [UserController::class, 'modificarCategory']);
Route::patch('/categoryModifyCamp/{id}', [UserController::class, 'modificarCampoCategory']);
Route::delete('/categoryDelete/{id}', [UserController::class, 'eliminarCategory']);

//RUTAS SOBRE LAS CATEGORIAS
Route::get('/productAll', [UserController::class, 'mostrarProduct']);
Route::get('/productOnly/{id}', [UserController::class, 'mostrarUnSoloProduct']);
Route::post('/productCreate', [UserController::class, 'crearProduct']);
Route::put('/productModify/{id}', [UserController::class, 'modificarProduct']);
Route::patch('/productModifyCamp/{id}', [UserController::class, 'modificarCampoProduct']);
Route::delete('/productDelete/{id}', [UserController::class, 'eliminarProduct']);
