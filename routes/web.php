<?php

//use App\Image;



Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::get('/config', 'UserController@config')->name('config');
Route::post('/user/edit', 'UserController@update')->name('user.update_data');
Route::post('/user/photo', 'UserController@updatePhotoProfile')->name('user.update_photo');
Route::get('/user/avatar/{filename}', 'UserController@getImageProfile')->name('user.get_avatar');