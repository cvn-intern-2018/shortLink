<?php


Route::get('/chart', 'ChartController@index');

Route::get('/', 'HomeController@index');
Route::post('short', 'HomeController@shortURL');

Route::get('/demo', 'HomeController@getBrowser');
Route::post('/ajax', 'HomeController@ajaxHome');

