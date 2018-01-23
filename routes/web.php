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

/** Dashboard */
Route::get('/', 'HomeController@index')->name('/');

/** Clientes */
Route::get('clients', 'ClientController@index')->name('clients');
Route::get('add', 'ClientController@getClients')->name('add');
//Route::post('create', ['as' => 'create', 'uses' => 'ClientController@postClients']); <- otra forma de nombrar las rutas
Route::post('create', 'ClientController@postClients')->name('create');
Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
