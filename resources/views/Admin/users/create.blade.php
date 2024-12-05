@extends('layouts.admin')

@section('content')
    <div class="flex items-center flex-wrap justify-between gap20 mb-27">
        <h3>Crear Usuario</h3>
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
                <a href="{{ route('users.index') }}">
                    <div class="text-tiny">Usuarios</div>
                </a>
            </li>
            <li>
                <i class="icon-chevron-right"></i>
            </li>
            <li>
                <div class="text-tiny">Nuevo Usuario</div>
            </li>
        </ul>
    </div>

    <div class="wg-box">
        <form class="form-new-user form-style-1" method="POST" action="{{ route('users.store') }}">
            @csrf

            <!-- Nombre del Usuario -->
            <fieldset class="name">
                <div class="body-title">Nombre del Usuario <span class="tf-color-1">*</span></div>
                <input class="flex-grow" type="text" placeholder="Nombre del Usuario" name="name"
                    value="{{ old('name') }}" required>
                @error('name')
                    <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                @enderror
            </fieldset>

            <!-- Correo Electrónico -->
            <fieldset class="email">
                <div class="body-title">Correo Electrónico <span class="tf-color-1">*</span></div>
                <input class="flex-grow" type="email" placeholder="Correo Electrónico" name="email"
                    value="{{ old('email') }}" required>
                @error('email')
                    <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                @enderror
            </fieldset>

            <!-- Contraseña -->
            <fieldset class="password">
                <div class="body-title">Contraseña <span class="tf-color-1">*</span></div>
                <input class="flex-grow" type="password" placeholder="Contraseña" name="password" required>
                @error('password')
                    <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                @enderror
            </fieldset>

            <!-- Confirmar Contraseña -->
            <fieldset class="password">
                <div class="body-title">Confirmar Contraseña <span class="tf-color-1">*</span></div>
                <input class="flex-grow" type="password" placeholder="Confirmar Contraseña" name="password_confirmation" required>
            </fieldset>

            <!-- Rol del Usuario -->
            <fieldset class="role">
                <div class="body-title">Rol <span class="tf-color-1">*</span></div>
                <select class="flex-grow" name="role" required>
                    <option value="cliente" {{ old('role') == 'cliente' ? 'selected' : '' }}>Cliente</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrador</option>
                  
                </select>
                @error('role')
                    <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                @enderror
            </fieldset>

            <div class="bot">
                <div></div>
                <button class="tf-button w208" type="submit">Guardar Usuario</button>
            </div>
        </form>
    </div>
@endsection
