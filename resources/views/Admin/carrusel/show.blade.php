@push('css')
    @vite(['resources/css/app.css', 'resources/css/style.css', 'resources/js/app.js'])
@endpush

@extends('layouts.admin')

@section('content')
    <div class="flex items-center flex-wrap justify-between gap-20 mb-27">
        <h3>Información del Carrusel</h3>
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
                <a href="{{ route('carrusel.index') }}">
                    <div class="text-tiny">Carrusel</div>
                </a>
            </li>
            <li>
                <i class="icon-chevron-right"></i>
            </li>
            <li>
                <div class="text-tiny">{{ $carrusel->descripcion }}</div>
            </li>
        </ul>
    </div>

    <div class="wg-box">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <!-- Contenedor para mostrar la descripción y la imagen -->
            <div class="flex justify-start gap-8 mb-6">
                <div>
                    <h4 class="text-3xl font-semibold text-gray-800 mb-4">Descripción</h4>
                    <p class="text-2xl text-gray-600">{{ $carrusel->descripcion }}</p>

                    <h4 class="text-3xl font-semibold text-gray-800 mt-6">Orden</h4>
                    <p class="text-2xl text-gray-600">{{ $carrusel->orden }}</p>
                </div>

                <div>
                    @if($carrusel->imagen)
                        <!-- Ajustando el tamaño de la imagen -->
                        <img src="{{ asset('imagenes/carrusel/' . $carrusel->imagen) }}" alt="Imagen del Slider" class="w-[160px] h-[180px] ml-16 object-cover rounded-lg shadow-lg">
                    @else
                        <p class="text-xl text-gray-600">No se ha cargado ninguna imagen.</p>
                    @endif
                </div>
            </div>

            <div class="flex justify-start mt-10">
                <a href="{{ route('carrusel.index') }}" class="tf-button w208">Volver</a>
            </div>
        </div>
    </div>
@endsection
