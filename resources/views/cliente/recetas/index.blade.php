@extends('layouts.header')

@section('content')
    <section id="recetas">
        <div class="titulo_receta">
            <h3>Nuestras recetas</h3>
        </div>
        <!--container-->
        <div class="receta-container">
            @foreach ($recetas as $receta)
                <div class="receta-box">
                    <div class="receta-img">
                        <img alt="receta" src="{{ asset('imagenes/recetas/' . $receta->imagen) }}" alt="{{ $receta->nombre }}" />
                    </div>
                    <div class="receta-text">
                        <h2 class="blog-title">{{ $receta->nombre }}</h2>
                        <p>{{ Str::limit($receta->descripcion, 100) }}</p> <!-- Descripción corta -->
                        <a href="{{ route('recetas.cliente.show', $receta->id) }}">Ver más</a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Paginación -->
        <div class="pagination">
            {{ $recetas->links() }}
        </div>
    </section>
    
@endsection
