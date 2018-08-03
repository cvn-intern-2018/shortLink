<?php

Route::get('/', 'HomeController@index');
Route::get('/demo', 'HomeController@getBrowser');
Route::post('short', 'HomeController@shortURL');
Route::get('pagenotfound','HomeController@pageNotFound');
Route::get('/{url}','HomeController@redirectUrl');

