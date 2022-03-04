@extends('front.layouts.secondary')
@section('content')

    <div class="container-small mb180">
        <div class="white-bg white-bg_thin">
            <div class="mw400 m-auto">
                <p class="text-center fz45 fw800 lh12 mb20">Регистрация</p>
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors"/>

                <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->

                    <div class="mb20">
                        <block-input :name="'name'" :label="'Имя'" :value="'{{ old('name') }}'"></block-input>
                    </div>

                    <div class="mb20">
                        <block-input :name="'phone'" :label="'Телефон'" :value="'{{ old('phone') }}'"></block-input>
                    </div>

                    <div class="mb20">
                        <block-input :name="'email'" :type="'email'" :label="'Email'"
                                     :value="'{{ old('email') }}'"></block-input>
                    </div>

                    <div class="mb20">
                        <block-input :name="'password'" :type="'password'" :label="'Пароль'"></block-input>
                    </div>

                    <div class="mb20">
                        <block-input :name="'password_confirmation'" :type="'password'"
                                     :label="'Пароль еще раз'"></block-input>
                    </div>
                    <div class="mb20">
                        <a class="link link-green" href="{{ route('login') }}">
                            Уже зарегистрированы?
                        </a>
                    </div>
                    <div class="flex flex-center">
                        <button class="btn btn_transformed">
                            Регистрация
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
