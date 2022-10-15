<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes Auth
|--------------------------------------------------------------------------
|
*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/login', function () { return view('welcome'); })->name('login');
Route::post('/userinfo', [AuthController::class, 'userinfo']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*
|--------------------------------------------------------------------------
| API view info  [Required login for Auth:sanctum]
|--------------------------------------------------------------------------
*/
Route::post('/list_pedidos', [StoreController::class, 'list_pedidos']);
Route::post('/detail_pedido', [StoreController::class, 'detail_pedido']);
Route::post('/list_proveedores', [StoreController::class, 'list_proveedores']);
Route::post('/list_stock', [StoreController::class, 'list_productos']);
Route::post('/list_proveedores_producto', [StoreController::class, 'list_proveedores_producto']);

//Route::post('/get_tipo_cuenta', [TransactionController::class, 'get_tipo_cuenta'])->middleware('auth:sanctum');

