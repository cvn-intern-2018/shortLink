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
//
<<<<<<< HEAD
Route::get('/', 'HomeController@index');
Route::get('/chart', 'ChartController@index');
=======
Route::get('/', 'home@index');
Route::post('short','home@short');
>>>>>>> 982bb096b500376e494a7a4a74c0f127de479852

Route::get('encode/{id}','home@encode');
Route::get('chart', 'chart@index');




Route::get('/demo','ControllerUrl@function1');
