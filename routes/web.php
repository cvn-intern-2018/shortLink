<?php


Route::get('/chart', 'ChartController@index');
Route::get('/', 'HomeController@index');
Route::get('/demo', 'HomeController@getBrowser');
Route::post('/home/ajax/url', 'HomeController@updateUrlInfo');
Route::post('short', 'HomeController@shortURL');

Route::get('pagenotfound','HomeController@pageNotFound');
