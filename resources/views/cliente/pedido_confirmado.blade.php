@extends('layouts.header')

@section('content')
    <section class="bg-white py-8 md:py-4">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <div class="header-title bg-green-100 md:py-4 rounded-lg">
                <h1 class="text-4xl font-extrabold text-green-800">¡Pedido Confirmado!</h1>
            </div>
            <div class="mt-6 text-center">
                <p class="text-lg text-gray-700">{{ $mensaje ?? 'Tu pedido ha sido realizado exitosamente.' }}</p>
                <a href="{{ route('inicio') }}" class="mt-4 inline-block bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-all duration-300">
                    Volver al Inicio
                </a>
            </div>
        </div>
    </section>
@endsection
