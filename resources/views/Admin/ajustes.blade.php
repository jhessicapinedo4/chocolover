@extends('layouts.admin')

@section('content')
    <div class="flex items-center flex-wrap justify-between gap20 mb-27">
        <h3>Información de perfil</h3>
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



    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>
    <div class="wg-box">
        <div class="col-lg-12">
            <div class="page-content my-account__edit">
                <div class="my-account__edit-form">
                    <form name="account_edit_form" action="{{ route('profile_admin.update') }}" method="POST" @csrf
                        @method('patch') class="form-new-product form-style-1 needs-validation" novalidate="">

                        <fieldset class="name">
                            <div class="body-title">Nombre <span class="tf-color-1">*</span>
                            </div>
                            <input class="flex-grow" id="name" name="name" type="text" tabindex="0" :value="old('name', $user - > name) required autofocus autocomplete="name" >
                                                    <
                                                    x - input - error class="mt-2": messages ="$errors->get('name')"
                                            / >
                                            < /fieldset>


                                                < fieldset class="name">
                                                    < div class="body-title"> Gmail < span class="tf-color-1"> * < /span>
                                </div>
                                < input class="flex-grow" id="email" name="email" type="email":
                                    value ="old('email',
                                $user->email)" required autocomplete="username">
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




                            <div class="col-md-12">
                                <x-primary-button>{{ __('Save') }}</x-primary-button>

                                @if (session('status') === 'profile-updated')
                                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600">{{ __('Saved.') }}</p>
                                @endif
                        </fieldset>

                    </form>



                    <form method="post" action="{{ route('password.update') }}"
                        class="form-new-product form-style-1 needs-validation">
                        @csrf
                        @method('put')

                        <div class="row">
                            <div class="col-md-12">
                                <div class="my-3">
                                    <h5 class="text-uppercase mb-0">Cambiar contraseña</h5>
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


                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
