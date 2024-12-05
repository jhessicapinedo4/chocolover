
@push('css')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@endpush
@extends('layouts.admin')

@section('content')
    <div class="flex items-center flex-wrap justify-between gap20 mb-27">
        <h3 >Información de perfil</h3>
        <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
            <li>
                <a href="#">
                    <div class="text-tiny">Dashboard</div>
                </a>
            </li>
            <li>
                <i class="icon-chevron-right"></i>
            </li>
            <li>
                <div class="text-tiny"></div>
            </li>
        </ul>
    </div>


    <div class="wg-box">
        <div class="col-lg-12">
            <div class="page-content my-account__edit">
                <div class="my-account__edit-form">

                    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                        @csrf
                    </form>


                    <form name="account_edit_form" action="{{ route('profile_admin.update') }}" method="POST"
                        class="form-new-product form-style-1 needs-validation" novalidate="">

                        @csrf
                        @method('patch')

                        <fieldset class="name">
                            <div class="body-title">Nombre <span class="tf-color-1">*</span></div>
                            <input class="flex-grow" id="name" name="name" type="text"
                                value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                            <!-- Error de validación -->
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />


                        </fieldset>



                        <fieldset class="name">
                            <div class="body-title"> Gmail <span class="tf-color-1"> * </span>
                            </div>

                            <input class="flex-grow" id="email" name="email" type="email"
                                :value="old('email', $user - > email)" required autocomplete="username">

                            <x-input-error class="mt-2" :messages="$errors->get('email')" />

                            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                                <div>
                                    <p class="text-sm mt-2 text-gray-800">
                                        {{ __('Your email address is unverified.') }}

                                        <button form="send-verification"
                                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            {{ __('Click here to re-send the verification email.') }}
                                        </button>
                                    </p>

                                    @if (session('status') === 'verification-link-sent')
                                        <p class="mt-2 font-medium text-sm text-green-600">
                                            {{ __('A new verification link has been sent to your email address.') }}
                                        </p>
                                    @endif
                                </div>
                            @endif

                        </fieldset>

                        <div class="col-md-12">
                            <div class="my-3">

                                <button type="submit" class="btn btn-primary tf-button w208">{{ __('Save') }}</button>
                                @if (session('status') === 'profile-updated')
                                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600">{{ __('Saved.') }}</p>
                                @endif
                            </div>
                        </div>


                    </form>



                    <form method="post" action="{{ route('password.update') }}"
                        class="form-new-product form-style-1 needs-validation">
                        @csrf
                        @method('put')

                        <div class="row">
                            <div class="col-md-12">
                                <div class="my-4 text-gray-500 ">
                                    <h3 class=" mb-0">Cambiar contraseña:</h3>
                                </div>
                            </div>
                            <div class="col-md-12">

                                <fieldset class="name">
                                    <div for="update_password_current_password" class="body-title pb-3">Contraseña actual
                                        <span class="tf-color-1">*</span>
                                    </div>
                                    <input class="flex-grow" id="update_password_current_password" name="current_password"
                                        type="password" autocomplete="current-password">
                                    <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                                </fieldset>

                            </div>
                            <div class="col-md-12">
                                <fieldset class="name">
                                    <div for="update_password_password" class="body-title pb-3">Nueva contraseña <span
                                            class="tf-color-1">*</span>
                                    </div>
                                    <input class="flex-grow" id="update_password_password" name="password" type="password"
                                        autocomplete="new-password">
                                    <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                                </fieldset>

                            </div>
                            <div class="col-md-12">
                                <fieldset class="name">
                                    <div for="update_password_password_confirmation" class="body-title pb-3">Confirmar
                                        contraseña <span class="tf-color-1">*</span>
                                    </div>
                                    <input class="flex-grow" id="update_password_password_confirmation"
                                        name="password_confirmation" type="password" autocomplete="new-password">
                            </div>
                            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                            </fieldset>
                        </div>
                        <div class="col-md-12">
                            <div class="my-3">
                                <button type="submit" class="btn btn-primary tf-button w208">Guardar cambios</button>
                                @if (session('status') === 'password-updated')
                                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600">{{ __('Saved.') }}</p>
                                @endif
                            </div>
                        </div>
                </div>
                </form>


                {{-- boton para elimianr --}}
                <!-- Botón de Eliminar cuenta -->
                <div class="flex justify-end">
                <button id="openModalBtn"
                    class=" text-2xl px-24 py-6 mt-6 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">Eliminar
                    cuenta</button>
                  </div>
                <!-- Modal de Confirmación para eliminar cuenta -->
                <div id="modal"
                    class="fixed inset-0 bg-gray-500 bg-opacity-75 z-50  justify-center items-center hidden">
                    <div class="bg-white p-8 rounded-lg shadow-lg w-[500px] max-w-full">
                        <h3 class="text-3xl font-semibold text-gray-800 mb-6">¿Estás seguro de que deseas eliminar tu
                            cuenta?</h3>
                        <p class="text-xl text-gray-600 mb-8">Esta acción no puede deshacerse. Ingresa tu contraseña para
                            confirmar.</p>

                        <form id="deleteForm" method="POST" action="{{ route('profile_admin.destroy') }}">
                            @csrf
                            @method('delete')

                            <!-- Contraseña para eliminar -->
                            <div class="flex flex-col mb-4">
                                <label for="password" class="text-xl font-semibold text-gray-800 mb-6">Contraseña actual
                                    <span class="text-red-500">*</span></label>
                                <input id="password" name="password" type="password" placeholder="Contraseña" required
                                    autocomplete="current-password"
                                    class="mt-4 p-6 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
                                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                            </div>

                            <div class="flex justify-between gap-4">
                                <button type="button" id="cancelBtn"
                                    class="px-6 py-3 bg-gray-300 text-black font-semibold rounded-lg hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500">Cancelar</button>
                                <button type="submit"
                                    class="px-6 py-3 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">Eliminar
                                    cuenta</button>
                            </div>
                        </form>
                    </div>
                </div>






            </div>

        </div>

    </div>
    </div>


    <script>
        // Obtener los elementos
        const openModalBtn = document.getElementById('openModalBtn');
        const modal = document.getElementById('modal');
        const cancelBtn = document.getElementById('cancelBtn');
        const deleteForm = document.getElementById('deleteForm');

        // Abrir el modal cuando se hace clic en el botón
        openModalBtn.addEventListener('click', () => {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        });

        // Cerrar el modal cuando se hace clic en el botón "Cancelar"
        cancelBtn.addEventListener('click', () => {
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        });

        // Cerrar el modal si el usuario hace clic fuera del modal (área de fondo)
        window.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.classList.remove('flex');
                modal.classList.add('hidden');
            }
        });
    </script>

@endsection
