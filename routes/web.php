<?php

Route::get('/', 'HomeController@index');
Route::post('short', 'HomeController@shortURL');
Route::get('pagenotfound', 'HomeController@pageNotFound');
Route::get('/{url_shorten}+', 'ChartController@index');
Route::get('/{url}', 'HomeController@redirectUrl');
