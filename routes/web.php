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

Route::get('/', function () {
    return redirect(url('stock'));
});

Route::get('stocks', 'StockController@index');
Route::get('stock', 'StockController@create');
Route::post('stock', 'StockController@store');
Route::patch('stock/{id}', 'StockController@updateStock');
