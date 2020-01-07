@extends('layouts.app')

@section('content')
    <h1>{{ $titulo }}</h1>
    <a href="{{ action('PeliculaController@detalle') }}">ir a detalle</a>
@endsection