<x-guest-layout>
    <section class="bg-gray-50">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900">
                <img class="w-50 h-10 mr-4" src="/imagenes/logo.png" alt="logo">

            </a>
            <div class="w-full bg-white rounded-lg shadow-md md:mt-0 sm:max-w-md xl:p-0">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                        Sign in to your account
                    </h1>
                    <form method="POST" class="space-y-4 md:space-y-6" action="{{ route('login') }}">
                        @csrf
                        <div>
                            <label for="email" :value="__('Email')"
                                class="block mb-2 text-sm font-medium text-gray-900">Your email</label>
                            <input type="email" name="email" id="email" :value="old('email')" required
                                autofocus autocomplete="username"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                placeholder="Ingrese su correo" required="">
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        {{-- contraseña --}}
                        <div>
                            <label for="password" :value="__('Password')"
                                class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                            <input type="password" name="password" id="password" placeholder="Escriba su contraseña"
                                required autocomplete="current-password"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                required="">
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>


                        <div class="flex items-center justify-between">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="remember_me" aria-describedby="remember" type="checkbox"
                                        class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-blue-600"
                                        name="remember">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="remember_me" class="text-gray-500">{{ __('Remember me') }}</label>
                                </div>
                            </div>

                            <div>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}"
                                        class="text-sm font-medium text-blue-600 hover:underline">{{ __('Forgot your password?') }}
                                    </a>
                                @endif
                            </div>

                        </div>
                        <button type="submit"
                            class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            {{ __('Log in') }}
                        </button>


                        <a  href="{{ route('register') }}" class="text-sm font-light text-gray-500">
                            admin
                        </a>


                    </form>
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>
