<?php


Route::get('/chart', 'ChartController@index');
Route::get('/', 'HomeController@index');
Route::get('data', 'HomeController@returnData');
Route::post('short', 'HomeController@short');
Route::get('/demo', 'HomeController@test');
Route::post('/home/ajax/url', 'HomeController@updateUrlInfo');
Route::post('short', 'HomeController@shortURL');

