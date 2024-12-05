@extends('layouts.admin')

@section('content')
    <div class="flex items-center flex-wrap justify-between gap20 mb-27">
        <h3>Editar Topping</h3>
        <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
            <li>
                <a href="{{ route('dashboard') }}">
                    <div class="text-tiny">Dashboard</div>
                </a>
            </li>
            <li>
                <i class="icon-chevron-right"></i>
            </li>
            <li>
                <a href="{{ route('toppings.index') }}">
                    <div class="text-tiny">Toppings</div>
                </a>
            </li>
            <li>
                <i class="icon-chevron-right"></i>
            </li>
            <li>
                <div class="text-tiny">Editar Topping</div>
            </li>
        </ul>
    </div>

    <!-- Mensajes de error -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Mensajes de éxito -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="wg-box">
        <form class="form-new-product form-style-1" method="POST" action="{{ route('toppings.update', $topping->id) }}">
            @csrf
            @method('PUT')
            <fieldset class="name">
                <div class="body-title">Nombre del Topping <span class="tf-color-1">*</span></div>
                <input class="flex-grow" type="text" placeholder="Escriba el nombre del topping" name="nombre" tabindex="0"
                    value="{{ old('nombre', $topping->nombre) }}" aria-required="true" required>
            </fieldset>
            
            <fieldset class="name">
                <div class="body-title">Descripción del Topping</div>
                <input class="flex-grow" type="text" placeholder="Escriba la descripción del topping" name="descripcion" tabindex="0"
                    value="{{ old('descripcion', $topping->descripcion) }}">
            </fieldset>

            <!-- Imagen opcional (si tienes imágenes asociadas a toppings en el futuro) -->
            <div class="col-md-4 offset-md-3"> 
                <img id="selectedImage" src="{{ asset('imagenes/topping.jpg') }}" alt="Imagen seleccionada" style="max-width: 300px; max-height: 200px;">
            </div>

            <div class="bot">
                <div></div>
                <button class="tf-button w208" type="submit">Guardar Cambios</button>
            </div>
        </form>
    </div>
@endsection
