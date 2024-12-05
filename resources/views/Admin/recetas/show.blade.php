@push('css')
    @vite(['resources/css/app.css', 'resources/css/style.css', 'resources/js/app.js'])
@endpush

@extends('layouts.admin')

@section('content')
    <div class="flex items-center flex-wrap justify-between gap-20 mb-27">
        <h3>Información de la Receta</h3>
        <ul class="breadcrumbs flex items-center flex-wrap justify-start gap-10">
            <li>
                <a href="{{ route('dashboard') }}">
                    <div class="text-tiny">Dashboard</div>
                </a>
            </li>
            <li>
                <i class="icon-chevron-right"></i>
            </li>
            <li>
                <a href="{{ route('recetas.index') }}">
                    <div class="text-tiny">Recetas</div>
                </a>
            </li>
            <li>
                <i class="icon-chevron-right"></i>
            </li>
            <li>
                <div class="text-tiny">{{ $receta->nombre }}</div>
            </li>
        </ul>
    </div>

    <div class="wg-box">
        <div class="bg-white p-8">
            <!-- Contenedor para mostrar el nombre, la descripción y la imagen -->
            <div class="flex gap-10 mb-10">
                <div class="w-1/3">
                    <img src="{{ Storage::url($receta->imagen) }}" alt="{{ $receta->nombre }}" class="w-full h-auto rounded">
                </div>
                <div class="w-2/3">
                    <h4 class="text-2xl font-bold">{{ $receta->nombre }}</h4>
                    <p class="text-gray-600 mt-4">{{ $receta->descripcion }}</p>
                    <h5 class="mt-6 text-xl font-semibold">Ingredientes</h5>
                    <p class="text-gray-600">{{ $receta->ingredientes }}</p>
                    <h5 class="mt-6 text-xl font-semibold">Preparación</h5>
                    <p class="text-gray-600">{{ $receta->preparacion }}</p>
                    <h5 class="mt-6 text-xl font-semibold">Mensaje Final</h5>
                    <p class="text-gray-600">{{ $receta->mensaje_final }}</p>
                </div>
            </div>

            <!-- Opciones para editar o eliminar la receta -->
            <div class="flex justify-between mt-8">
                <a href="{{ route('recetas.edit', $receta->id) }}" class="btn btn-primary">Editar</a>
                <form action="{{ route('recetas.destroy', $receta->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta receta?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
@endsection
