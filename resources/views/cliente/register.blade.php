@extends('layouts.header')

@section('content')
<div class="form" id="formulario">
    <a href="{{ route('cliente.login') }}" class="back-button">
        <i class="bi bi-arrow-left-circle"></i>
    </a>
    <div class="form-toggle"></div>
    <div class="form-panel one">
        <div class="form-header">
            <h1>Bienvenido</h1>
            <h2>Configuremos tu cuenta personal</h2>
        </div>
        <div class="form-content">
            <form method="POST" action="{{ route('cliente.register') }}">
                @csrf

                <!-- Nombre -->
                <div class="formmulario-grupo">
                    <label for="name">Nombre</label>
                    <input
                        id="name"
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        required="required"
                        placeholder="Escriba su nombre"
                    />
                </div>

                <!-- Apellidos -->
                <div class="formmulario-grupo">
                    <label for="lastname">Apellidos</label>
                    <input
                        id="lastname"
                        type="text"
                        name="lastname"
                        value="{{ old('lastname') }}"
                        required="required"
                        placeholder="Escriba sus apellidos"
                    />
                </div>

                <!-- Email -->
                <div class="formmulario-grupo">
                    <label for="email">Email</label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required="required"
                        placeholder="Escriba su email"
                    />
                </div>

                <!-- Contraseña -->
                <div class="formmulario-grupo">
                    <label for="password">Contraseña</label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        required="required"
                        placeholder="Escriba su contraseña"
                    />
                </div>

                <!-- Confirmar Contraseña -->
                <div class="formmulario-grupo">
                    <label for="password_confirmation">Confirmar Contraseña</label>
                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        required="required"
                        placeholder="Confirme su contraseña"
                    />
                </div>

                <!-- Botón de registro -->
                <div class="formmulario-grupo">
                    <button type="submit" class="form-button">Registrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
