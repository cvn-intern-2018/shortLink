<?php


Route::get('/chart', 'ChartController@index');
Route::get('/', 'HomeController@index');
Route::get('data', 'HomeController@returnData');

Route::get('/demo', 'HomeController@getBrowser');
Route::post('short', 'HomeController@shortURL');
Route::get('pagenotfound','HomeController@pageNotFound');


Route::get('pagenotfound','HomeController@pageNotFound');

Route::get('/{url}','HomeController@redirectUrl');

