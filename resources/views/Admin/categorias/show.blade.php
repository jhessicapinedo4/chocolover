@push('css')
    @vite(['resources/css/app.css', 'resources/css/style.css', 'resources/js/app.js'])
@endpush


@extends('layouts.admin')

@section('content')
    <div class="flex items-center flex-wrap justify-between gap-20 mb-27">
        <h3>Información de la categoría</h3>
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
                <a href="{{ route('categorias.index') }}">
                    <div class="text-tiny">Categorías</div>
                </a>
            </li>
            <li>
                <i class="icon-chevron-right"></i>
            </li>
            <li>
                <div class="text-tiny">{{ $categoria->nombre }}</div>
            </li>
        </ul>
    </div>

    <div class="wg-box">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <!-- Contenedor para mostrar el nombre, la descripción y la imagen -->
            <div class="flex justify-start gap-8 mb-6">
                <div>
                    <h4 class="text-3xl font-semibold text-gray-800 mb-4">Nombre de la categoría</h4>
                    <p class="text-2xl text-gray-600">{{ $categoria->nombre }}</p>

                    <h4 class="text-3xl font-semibold text-gray-800 mt-6">Descripción</h4>
                    <p class="text-2xl text-gray-600">{{ $categoria->descripcion ?? 'No hay descripción disponible.' }}</p>
                </div>

                <div>
                    
                    @if($categoria->imagen)
                        <!-- Ajustando el tamaño de la imagen -->
                        <img src="{{ asset('imagenes/categorias/' . $categoria->imagen) }}" alt="Imagen de la categoría" class="w-[160px] h-[180px] ml-16 object-cover rounded-lg shadow-lg ">
                    @else
                        <p class="text-xl text-gray-600">No se ha cargado ninguna imagen.</p>
                    @endif
                </div>
            </div>

            <div class="flex justify-start mt-10">
                <a href="{{ route('categorias.index') }}" class="tf-button w208">Volver a Categorías</a>
            </div>
        </div>
    </div>
@endsection
