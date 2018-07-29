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

Route::get('/', 'HomeController@index');
Route::get('chart', 'ChartController@index');

Route::post('short','HomeController@short');


// Route::get('encode/{id}','HomeController@encode');





Route::get('/demo','ControllerUrl@function1');
