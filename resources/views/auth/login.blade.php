@extends('front.layouts.secondary')
@section('content')

    <div class="container-small mb180">
        <div class="white-bg white-bg_thin">
            <div class="mw400 m-auto">
                <p class="text-center fz45 fw800 lh12 mb20">Вход</p>

                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb20" :errors="$errors"/>

                <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                    <div class="mb20">
                        <block-input :name="'email'" :type="'email'" :label="'Email'"
                                     :value="'{{ old('email') }}'"></block-input>
                    </div>

                    <div class="mb20">
                        <block-input :name="'password'" :type="'password'" :label="'Пароль'"></block-input>
                    </div>

                    <div class="mb20">
                        <div class="flex">
                            <div class="col0 flex-full">
                                <a class="link link-green" href="{{ route('register') }}">
                                    Регистрация
                                </a>
                            </div>
                            <div class="col0">
                                <a class="link link-green" href="{{ route('password.request') }}">
                                    Забыли пароль?
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-center">
                        <button class="btn btn_transformed">
                            Вход
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
