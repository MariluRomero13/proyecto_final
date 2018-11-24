<?php

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

//Rutas de login
Route::get("/", "UsuarioController@mostrarLogin")->name("login");
Route::post("/iniciarsesion", "UsuarioController@iniciarSesion");
Route::post("/logout",["middleware" => "verificador", "uses" => "UsuarioController@cerrarSesion"]);

//Rutas de inicio
Route::get("/inicio",["middleware" => "verificador", "uses" => "PanelController@index"])->name('panel');