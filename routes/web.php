<?php

Route::get('/', 'HomeController@index');
Route::get('/demo', 'HomeController@getBrowser');
Route::post('short', 'HomeController@shortURL');
Route::post('/chart/statistics', 'ChartController@getDataStatistics');
Route::get('pagenotfound', 'HomeController@pageNotFound');
Route::get('/{url_shorten}+', 'ChartController@index');
Route::get('/{url}', 'HomeController@redirectUrl');
Route::get('/demo','HomeController@test');