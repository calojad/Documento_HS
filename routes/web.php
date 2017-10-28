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
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/{register}', 'HomeController@index')->name('home');
Route::group(['middleware' => 'auth'], function () {
    AdvancedRoute::controller('/documento','DocumentoController');
    AdvancedRoute::controller('/objetivos','ObjetivosController');
    AdvancedRoute::controller('/ambitos','AmbitosController');
    AdvancedRoute::controller('/politica','PoliticaController');
});
