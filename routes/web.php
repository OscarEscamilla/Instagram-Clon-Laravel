<?php

//use App\Image;



Auth::routes();
Route::get('/', 'HomeController@index')->name('home');

/* Route::get('/listado', function(){

    $titulo = "listado de peliculas";

    $peliculas = ['batman','spiderman','la sirenita', 'superman'];

    return view('listado')
        ->with('titulo', $titulo)
        ->with('peliculas', $peliculas);

}); */

Route::get('/peliculas', 'PeliculaController@index');
Route::get('/detalle', 'PeliculaController@detalle');

Route::resource('usuario', 'UsuarioController');