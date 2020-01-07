<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PeliculaController extends Controller
{
    public function index(){
        $titulo = 'Listado de las peliculas';
        return view('pelicula.index', [
            'titulo' => $titulo
        ]);
    }

    public function detalle(){
        
        return view('pelicula.detalle');
    }
}
