<?php

//use App\Image;



Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::get('/config', 'UserController@config')->name('config');
Route::post('/user/edit', 'UserController@update')->name('user.update');
Route::post('/user/photo', 'UserController@updatePhoto')->name('user.updatePhoto');