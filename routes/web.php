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
Route::get('create', 'HomeController@create')->name('create');
Route::post('create', 'HomeController@store')->name('insert_ticket');
Route::get('ticket/{id}/edit', 'HomeController@edit')->name('edit_ticket');
Route::put('update/{id}', 'HomeController@update')->name('update');
Route::delete('ticket/{id}', 'HomeController@destroy')->name('delete_ticket');
Route::get('get_all', 'HomeController@allTickets')->name('get_all');
Route::get('excel', 'HomeController@excel')->name('excel');
Route::get('entes/{id}', 'HomeController@allEntes')->name('entes');

/** Clientes */
//Route::get('clients', 'ClientController@index')->name('clients');
//Route::get('add', 'ClientController@getClients')->name('add');
//Route::post('create', ['as' => 'create', 'uses' => 'ClientController@postClients']); <- otra forma de nombrar las rutas
//Route::post('create', 'ClientController@postClients')->name('create');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
