<?php


Route::get('encode/{id}', 'home@encode');
Route::get('/chart', 'ChartController@index');

Route::get('/', 'HomeController@index');
Route::get('data', 'HomeController@returnData');


Route::post('short', 'HomeController@short');

Route::get('/demo', 'HomeController@getBrowser');
Route::post('/ajax', 'HomeController@ajaxHome');

