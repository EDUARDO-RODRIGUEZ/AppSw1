<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('pedido', 'Api\MovilController@listarPedidos');
Route::post('estado', 'Api\MovilController@cambiarEstado');
Route::post('detalle', 'Api\MovilController@detallePedido');
Route::post('registrarP', 'Api\MovilController@registrarProducto');
//SERVICIOS PARA PROYECTO SOFTWARE
Route::post('login', 'Api\MovilController@login');
Route::post('listar_productos', 'Api\MovilController@listarProductos');
Route::post('registrar_pedido', 'Api\MovilController@registrar_pedido');
Route::post('listar_pedidos', 'Api\MovilController@listar_pedidos');
Route::post('listar_comentarios_producto', 'Api\MovilController@listar_comentarios_producto');
Route::post('listar_productos_sin_calificar', 'Api\MovilController@listar_productos_sin_calificar');
Route::post('agregar_comentario_producto', 'Api\MovilController@agregar_comentario_producto');




