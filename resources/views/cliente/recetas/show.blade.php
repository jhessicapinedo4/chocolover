@extends('layouts.header')

@section('content')

    <section class="receta">
        <div class="header-title">
            <h1>{{ $receta->nombre }}</h1>
        </div>

        <h2>Ingredientes</h2>
        <div class="ingredientes">
            <ul>
                <!-- Mostrar los ingredientes como lista -->
                @foreach($ingredientes as $ingrediente)
                    <li>{{ $ingrediente }}</li>
                @endforeach
            </ul>
            <img alt="receta" src="{{ asset('imagenes/recetas/' . $receta->imagen) }}" alt="{{ $receta->nombre }}" />
        </div>

        <h2>Preparación</h2>
        <ol>
            <!-- Mostrar cada paso de la preparación si es un array -->
            @foreach($receta->preparacion as $paso)
                <li>{{ $paso }}</li>
            @endforeach
        </ol>
        
        <h3 class="mensaje">{{ $receta->mensaje_final }} </h3>
    </section>

@endsection
