<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("/","IndexController@index")->name("inicio");;
Route::post("auth/login","IndexController@login")->name("login");
Route::post("home","IndexController@home")->name("home");
Route::get("cerrar","IndexController@cerrar")->name("cerrar");

Route::get("ver/usuarios","UsersController@view")->name("ver_usuarios");
Route::get("crear/usuarios","UsersController@crear")->name("crear_usuarios");
Route::post("get/usuarios","UsersController@get")->name("consultar_usuarios");
Route::post("creacion/usuarios","UsersController@create")->name("creacion_usuarios");

Route::get("ver/productos","ProductsController@view")->name("ver_productos");
Route::get("crear/productos","ProductsController@crear")->name("crear_productos");
Route::get("descontar/productos","ProductsController@descontar")->name("descontar_productos");
Route::post("creacion/productos","ProductsController@create")->name("creacion_productos");
Route::post("obtener/productos","ProductsController@obtener")->name("obtener_productos");
Route::post("get/productos","ProductsController@get")->name("consultar_productos");



