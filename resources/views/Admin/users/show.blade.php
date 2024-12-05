@push('css')
    @vite(['resources/css/app.css', 'resources/css/style.css', 'resources/js/app.js'])
@endpush

@extends('layouts.admin')

@section('content')
    <div class="flex items-center flex-wrap justify-between gap-20 mb-27">
        <h3>Información del Usuario</h3>
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
                <a href="{{ route('users.index') }}">
                    <div class="text-tiny">Usuarios</div>
                </a>
            </li>
            <li>
                <i class="icon-chevron-right"></i>
            </li>
            <li>
                <div class="text-tiny">{{ $usuario->name }}</div>
            </li>
        </ul>
    </div>

    <div class="wg-box">
        <div class="bg-white p-6 rounded-lg ">
            <!-- Contenedor para mostrar el nombre, correo y rol -->
            <div class="flex justify-start gap-8 mb-6">
                <div>
                    <h4 class="text-3xl font-semibold text-gray-800 mb-4">Nombre del Usuario</h4>
                    <p class="text-2xl text-gray-600">{{ $usuario->name }}</p>

                    <h4 class="text-3xl font-semibold text-gray-800 mt-6">Correo Electrónico</h4>
                    <p class="text-2xl text-gray-600">{{ $usuario->email }}</p>

                    <h4 class="text-3xl font-semibold text-gray-800 mt-6">Rol</h4>
                    <p class="text-2xl text-gray-600">{{ ucfirst($usuario->role) }}</p>
                </div>
            </div>

            <!-- Estado del Usuario -->
            <div class="flex justify-start gap-8 mt-6">
                <h4 class="text-3xl font-semibold text-gray-800 mb-4">Estado</h4>
                <p class="text-2xl text-gray-600">{{ $usuario->estado == 1 ? 'Activo' : 'Inactivo' }}</p>
            </div>

            <div class="flex justify-start mt-10">
                <a href="{{ route('users.index') }}" class="tf-button w208">Volver a Usuarios</a>
            </div>
        </div>
    </div>
@endsection
