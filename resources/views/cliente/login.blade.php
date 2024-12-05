@extends('layouts.header')

@section('content')
    <div class="form">
        <div class="form-toggle"></div>
        <div class="form-panel one">
            <div class="form-header">
                <h1>{{ __('Iniciar Sesión') }}</h1>
                <h2 class="n-cuenta">
                    ¿No tienes cuenta aún? 
                    <a href="{{ route('cliente.register') }}" class="unete">UNETE AHORA</a>
                </h2>
            </div>
            <div class="form-content">
                <form method="POST" action="{{ route('cliente.login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="formmulario-grupo">
                        <label for="email">{{ __('Correo electrónico') }}</label>
                        <input id="email" 
                               type="email" 
                               name="email" 
                               required="required" 
                               value="{{ old('email') }}" />
                    </div>

                    <!-- Password -->
                    <div class="formmulario-grupo">
                        <label for="password">{{ __('Contraseña') }}</label>
                        <input id="password" 
                               type="password" 
                               name="password" 
                               required="required" />
                    </div>

                    <!-- Remember Me -->
                    <div class="formmulario-grupo">
                        <label class="form-remember">
                            <input type="checkbox" name="remember" /> {{ __('Recordar') }}
                        </label>
                        <a class="form-recovery" href="{{ route('password.request') }}">{{ __('¿Olvidaste tu contraseña?') }}</a>
                    </div>

                    <!-- Submit Button -->
                    <div class="formmulario-grupo">
                        <button type="submit" class="form-submit">{{ __('Iniciar sesión') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
