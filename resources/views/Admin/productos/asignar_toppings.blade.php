@extends('layouts.admin')

@section('content')

<div class="flex items-center flex-wrap justify-between gap20 mb-27">
    <h3>Asignar Topping a Producto</h3>
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
            <a href="{{ route('productos.index') }}">
                <div class="text-tiny">Productos</div>
            </a>
        </li>
        <li>
            <i class="icon-chevron-right"></i>
        </li>
        <li>
            <div class="text-tiny">Asignar Topping</div>
        </li>
    </ul>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="wg-box">
    <form class="form-new-product form-style-1" method="POST" action="{{ route('productos.asignar_toppings') }}">
        @csrf
        <fieldset class="category">
            <div class="body-title">Producto</div>
            <div class="select flex-grow">
                <select class="" name="producto_id" required>
                    <option value="">Seleccione un producto</option>
                    @foreach ($productos as $producto)
                        <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                    @endforeach
                </select>
            </div>
        </fieldset>
        <fieldset class="category">
            <div class="body-title">Topping</div>
            <div class="select flex-grow">
                <select class="" name="topping_id" required>
                    <option value="">Seleccione un topping</option>
                    @foreach ($toppings as $topping)
                        <option value="{{ $topping->id }}">{{ $topping->nombre }}</option>
                    @endforeach
                </select>
            </div>
        </fieldset>
        <div class="bot">
            <div></div>
            <button class="tf-button w208" type="submit">Asignar</button>
        </div>
    </form>
</div>

@endsection
