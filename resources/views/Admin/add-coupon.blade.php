@extends('layouts.admin')

@section('content')
    <div class="flex items-center flex-wrap justify-between gap20 mb-27">
        <h3>Create Coupon</h3>
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
                <a href="{{ route('cupones.index') }}">
                    <div class="text-tiny">Coupons</div>
                </a>
            </li>
            <li>
                <i class="icon-chevron-right"></i>
            </li>
            <li>
                <div class="text-tiny">New Coupon</div>
            </li>
        </ul>
    </div>

    <div class="wg-box">
        <form class="form-new-coupon form-style-1" method="POST" action="{{ route('cupones.store') }}">
            @csrf

            <!-- Coupon Code -->
            <fieldset class="name">
                <div class="body-title">Coupon Code <span class="tf-color-1">*</span></div>
                <input class="flex-grow" type="text" placeholder="Coupon Code" name="codigo_cupon" value="{{ old('codigo_cupon') }}" required>
                @error('codigo_cupon')
                    <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                @enderror
            </fieldset>

            <!-- Description -->
            <fieldset class="category">
                <div class="body-title">Description</div>
                <input class="flex-grow" type="text" placeholder="Coupon Description" name="descripcion" value="{{ old('descripcion') }}" required>
                @error('descripcion')
                    <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                @enderror
            </fieldset>

            <!-- Discount Value -->
            <fieldset class="name">
                <div class="body-title">Discount Value <span class="tf-color-1">*</span></div>
                <input class="flex-grow" type="number" step="0.01" placeholder="Discount Amount" name="descuento" value="{{ old('descuento') }}" required>
                @error('descuento')
                    <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                @enderror
            </fieldset>

            <!-- Expiration Date -->
            <fieldset class="name">
                <div class="body-title">Expiration Date <span class="tf-color-1">*</span></div>
                <input class="flex-grow" type="date" name="fecha_expiracion" value="{{ old('fecha_expiracion') }}" required>
                @error('fecha_expiracion')
                    <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                @enderror
            </fieldset>

            <!-- Maximum Usage -->
            <fieldset class="name">
                <div class="body-title">Maximum Usage (Optional)</div>
                <input class="flex-grow" type="number" name="uso_maximo" value="{{ old('uso_maximo') }}">
                @error('uso_maximo')
                    <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                @enderror
            </fieldset>

            <!-- Coupon Status (Active or Inactive) -->
            <fieldset class="category">
                <div class="body-title">Status</div>
                <div class="flex items-center gap-2">
                    <label for="estado">
                        <input type="checkbox" name="estado" value="1" checked>
                        Active
                    </label>
                </div>
            </fieldset>

            <div class="bot">
                <div></div>
                <button class="tf-button w208" type="submit">Save Coupon</button>
            </div>
        </form>
    </div>
@endsection
