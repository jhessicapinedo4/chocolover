@push('css')
    @vite(['resources/css/app.css', 'resources/css/style.css', 'resources/js/app.js'])
@endpush

@extends('layouts.admin')

@section('content')
    <div class="flex items-center flex-wrap justify-between gap-20 mb-27">
        <h3>Información del Producto</h3>
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
                <a href="{{ route('productos.index') }}">
                    <div class="text-tiny">Productos</div>
                </a>
            </li>
            <li>
                <i class="icon-chevron-right"></i>
            </li>
            <li>
                <div class="text-tiny">{{ $producto->nombre }}</div>
            </li>
        </ul>
    </div>

    <div class="wg-box">
        <div class="bg-white p-8 ">
            <!-- Contenedor para mostrar el nombre, la descripción y la imagen -->
            <div class="flex flex-col lg:flex-row justify-start gap-12 mb-6">
                <div class="flex-1">
                    <h4 class="text-3xl font-semibold text-gray-800 mb-4">Nombre del Producto</h4>
                    <p class="text-2xl text-gray-600">{{ $producto->nombre }}</p>

                    <h4 class="text-3xl font-semibold text-gray-800 mt-6">Descripción</h4>
                    <p class="text-xl text-gray-600">{{ $producto->descripcion ?? 'No hay descripción disponible.' }}</p>
                    
                    <h4 class="text-3xl font-semibold text-gray-800 mt-6">Precio</h4>
                    <p class="text-2xl text-gray-600">{{ 'S/. ' . number_format($producto->precio, 2) }}</p>

                    <h4 class="text-3xl font-semibold text-gray-800 mt-6">Estado</h4>
                    <p class="text-2xl text-gray-600">{{ $producto->estado == 1 ? 'Activo' : 'Inactivo' }}</p>

                    <h4 class="text-3xl font-semibold text-gray-800 mt-6">Popular</h4>
                    <p class="text-2xl text-gray-600">{{ $producto->popular == 1 ? 'Sí' : 'No' }}</p>

                    <h4 class="text-3xl font-semibold text-gray-800 mt-6">Personalizable</h4>
                    <p class="text-2xl text-gray-600">{{ $producto->personalizable == 1 ? 'Sí' : 'No' }}</p>
                </div>

                <div class="flex-none w-[160px] h-[180px] ml-16">
                    @if($producto->imagen)
                        <!-- Ajustando el tamaño de la imagen -->
                        <img src="{{ asset('imagenes/productos/' . $producto->imagen) }}" alt="Imagen del producto"
                            class="object-cover rounded-lg shadow-lg w-120 h-250">
                    @else
                        <p class="text-xl text-gray-600">No se ha cargado ninguna imagen.</p>
                    @endif
                </div>


            </div>

            <div class="flex justify-start mt-10">
                <a href="{{ route('productos.index') }}" class="tf-button w208">Volver a Productos</a>
            </div>
        </div>
    </div>
@endsection
