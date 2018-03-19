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

Route::get('/', function () {return view('welcome.welcome');});
Route::get('login/{alert}', 'Auth\LoginController@showLoginForm')->name('login');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/{registrado}', 'HomeController@index')->name('home');
Route::get('/home/{finalizado}/{documento}', 'HomeController@index')->name('home');
Route::group(['middleware' => 'auth'], function () {
    AdvancedRoute::controller('/documento','DocumentoController');
    AdvancedRoute::controller('/objetivos','ObjetivosController');
    AdvancedRoute::controller('/ambitos','AmbitosController');
    AdvancedRoute::controller('/politica','PoliticaController');
    AdvancedRoute::controller('/mantenimiento','MantenimientoController');
    AdvancedRoute::controller('/riesgo','RiesgosController');
});