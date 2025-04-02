<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\OpinionController;
use App\Http\Controllers\ValoracionController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\CompraController;

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
Route::post('/user/VerifyEmail', [UserController::class, 'verificarEmail']);
Route::post('/user/Create', [UserController::class, 'crearUser']);
Route::post('/user/Login', [UserController::class, 'loginUser']);
Route::post('/user/SendCode', [UserController::class, 'enviarCode']);
Route::post('/user/VerifyCode', [UserController::class, 'verificarCode']);
Route::post('/user/VerifyPassword', [UserController::class, 'verificarPassword']);
Route::post('/user/ChangePassword', [UserController::class, 'cambiarPassword']);
Route::put('/user/Modify/{id}', [UserController::class, 'modificarUser']);
Route::patch('/user/ModifyCamp/{id}', [UserController::class, 'modificarCampoUser']);
Route::delete('/user/Delete/{id}', [UserController::class, 'eliminarUser']);

//RUTAS SOBRE LAS OPINIONES
Route::post('/opinion/Create', [OpinionController::class, 'crearOpinion']);
Route::patch('/opinion/Update/{id}', [OpinionController::class, 'actualizarOpinion']);
Route::delete('/opinion/Delete/{id}', [OpinionController::class, 'eliminarOpinion']);
Route::get('/opinion/ForProduct/{id}', [OpinionController::class, 'OpinionPorProducto']);
Route::get('/opinion/ForUser/{id}', [OpinionController::class, 'OpinionPorUsuario']);

//RUTAS SOBRE LAS VALORACIONES
Route::post('/review/Create', [ValoracionController::class, 'crearValoracion']);
Route::patch('/review/Update/{id}', [ValoracionController::class, 'actualizarValoracion']);
Route::delete('/review/Delete/{id}', [ValoracionController::class, 'eliminarValoracion']);
Route::get('/review/ForProduct/{id}', [ValoracionController::class, 'ValoracionesPorProducto']);
Route::get('/review/ForUser/{id}', [ValoracionController::class, 'ValoracionesPorUsuario']);
Route::get('/review/Average/{id}', [ValoracionController::class, 'promedioPuntuacionProducto']);

//RUTAS SOBRE LAS CATEGORIAS
Route::get('/category/All', [CategoriaController::class, 'mostrarCategory']);
Route::get('/category/Only/{id}', [CategoriaController::class, 'mostrarUnSoloCategory']);
Route::post('/category/Create', [CategoriaController::class, 'crearCategory']);
Route::put('/category/Modify/{id}', [CategoriaController::class, 'modificarCategory']);
Route::patch('/category/ModifyCamp/{id}', [CategoriaController::class, 'modificarCampoCategory']);
Route::delete('/category/Delete/{id}', [CategoriaController::class, 'eliminarCategory']);

//RUTAS SOBRE LOS PRODUCTOS
Route::get('/product/All', [ProductoController::class, 'mostrarProduct']);
Route::get('/product/Only/{id}', [ProductoController::class, 'mostrarUnSoloProduct']);
Route::post('/product/Create', [ProductoController::class, 'crearProduct']);
Route::put('/product/Modify/{id}', [ProductoController::class, 'modificarProduct']);
Route::patch('/product/ModifyCamp/{id}', [ProductoController::class, 'modificarCampoProduct']);
Route::delete('/product/Delete/{id}', [ProductoController::class, 'eliminarProduct']);
Route::get('/product/ProdForCat', [ProductoController::class, 'productPorCategoria']);
Route::get('/product/ProdSale', [ProductoController::class, 'productPorOferta']);
Route::get('/product/ProdNotSale', [ProductoController::class, 'productSinOferta']);
Route::get('/product/ProdForOnlyCat/{id}', [ProductoController::class, 'productPorUnaCategoria']);
Route::get('/product/My/{id}', [ProductoController::class, 'miProduct']);

//RUTAS SOBRE EL CARRITO
Route::get('/cart/My/{id}', [CarritoController::class, 'mostrarCart']);
Route::post('/cart/Add', [CarritoController::class, 'agregarCart']);
Route::delete('/cart/Delete/{id}', [CarritoController::class, 'eliminarCart']);
Route::get('/cart/Total/{id}', [CarritoController::class, 'totalCart']);
Route::post('/cart/Confirm/{id}', [CarritoController::class, 'confirmarCompra']);

//RUTAS SOBRE LAS COMPRAS
Route::get('/shop/Buy/{id}', [CompraController::class, 'mostrarCompra']);
Route::get('/shop/Sell/{id}', [CompraController::class, 'mostrarVentas']);
Route::get('/shop/TotalBuy/{id}', [CompraController::class, 'totalCompra']);
Route::get('/shop/TotalSell/{id}', [CompraController::class, 'totalVenta']);
