@extends('layouts.admin')

@section('content')
    <div class="flex items-center flex-wrap justify-between gap20 mb-27">
        <h3>Editar Cupón</h3>
        <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
            <li>
                <a href="{{ route('dashboard') }}">
                    <div class="text-tiny">Panel de Control</div>
                </a>
            </li>
            <li>
                <i class="icon-chevron-right"></i>
            </li>
            <li>
                <a href="{{ route('cupones.index') }}">
                    <div class="text-tiny">Cupones</div>
                </a>
            </li>
            <li>
                <i class="icon-chevron-right"></i>
            </li>
            <li>
                <div class="text-tiny">Editar Cupón</div>
            </li>
        </ul>
    </div>

    <div class="wg-box">
        <form class="form-new-coupon form-style-1" method="POST" action="{{ route('cupones.update', $cupon->id) }}">
            @csrf
            @method('PUT')

            <!-- Código del cupón -->
            <fieldset class="name">
                <div class="body-title">Código del Cupón <span class="tf-color-1">*</span></div>
                <input class="flex-grow" type="text" placeholder="Código del Cupón" name="codigo_cupon"
                    value="{{ old('codigo_cupon', $cupon->codigo_cupon) }}" required>
                @error('codigo_cupon')
                    <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                @enderror
            </fieldset>

            <!-- Descripción -->
            <fieldset class="category">
                <div class="body-title">Descripción</div>
                <input class="flex-grow" type="text" placeholder="Descripción del Cupón" name="descripcion"
                    value="{{ old('descripcion', $cupon->descripcion) }}" required>
                @error('descripcion')
                    <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                @enderror
            </fieldset>

            <!-- Valor del Descuento -->
            <fieldset class="name">
                <div class="body-title">Valor del Descuento <span class="tf-color-1">*</span></div>
                <input class="flex-grow" type="number" step="0.01" min="0" max="100"
                    placeholder="Monto del Descuento (en %)" name="descuento" value="{{ old('descuento', $cupon->descuento) }}" required>
                @error('descuento')
                    <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                @enderror
            </fieldset>

            <!-- Fecha de Inicio -->
            <fieldset class="name">
                <div class="body-title">Fecha de Inicio <span class="tf-color-1">*</span></div>
                <input class="flex-grow" type="date" name="fecha_inicio" value="{{ old('fecha_inicio', $cupon->fecha_inicio) }}" required>
                @error('fecha_inicio')
                    <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                @enderror
            </fieldset>

            <!-- Fecha de Expiración -->
            <fieldset class="name">
                <div class="body-title">Fecha de Expiración <span class="tf-color-1">*</span></div>
                <input class="flex-grow" type="date" name="fecha_expiracion" value="{{ old('fecha_expiracion', $cupon->fecha_expiracion) }}" required>
                @error('fecha_expiracion')
                    <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                @enderror
            </fieldset>

            <!-- Uso Máximo -->
            <fieldset class="name">
                <div class="body-title">Uso Máximo (Opcional)</div>
                <input class="flex-grow" type="number" name="uso_maximo" value="{{ old('uso_maximo', $cupon->uso_maximo) }}">
                @error('uso_maximo')
                    <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                @enderror
            </fieldset>

            <!-- Estado del Cupón (Activo o Inactivo) -->
            <fieldset class="category">
                <div class="body-title">Estado</div>
                <div class="flex items-center gap-2">
                    <label for="estado" style="font-size: 15px; margin-right:5px">
                        <input type="checkbox" name="estado" value="1" {{ old('estado', $cupon->estado) ? 'checked' : '' }}>
                        Activo
                    </label>
                </div>
            </fieldset>

            <div class="bot">
                <div></div>
                <button class="tf-button w208" type="submit">Actualizar Cupón</button>
            </div>
        </form>
    </div>
@endsection
