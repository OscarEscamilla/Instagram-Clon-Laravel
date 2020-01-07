@extends('layouts.app')

@section('content')
    <div class="jumbotron m-3">
        <h1>{{ $titulo }}</h1>

        {{ $director or 'no hay ningun director'}}



        @for ($i = 0; $i < count($peliculas); $i++)
            @if ($peliculas[$i] === 'superman')
                <p>ya paso el puto superman</p>
            @else
                <p>{{$peliculas[$i]}}</p>
            @endif
        @endfor
    </div>

@endsection