<?php

Route::get('/', 'HomeController@index');
Route::post('short', 'HomeController@shortURL');
Route::post('chart/sort', 'ChartController@sortTimeToStatistics');
Route::get('pagenotfound', 'HomeController@pageNotFound');
Route::get('/{url_shorten}+', 'ChartController@index');
Route::get('/{url}', 'HomeController@redirectUrl');
