@extends('front.layouts.secondary')
@section('content')

    <div class="container-small mb180">
        <div class="white-bg white-bg_thin">

            <p class="text-center fz45 fw800 lh12 mb20">Восстановление пароля</p>
            <p class="text-center fz20 lh12 mb20">Укажите e-mail, мы пришлем ссылку для восстановления пароля</p>


            <div class="mw400 m-auto">
                <!-- Session Status -->
                <x-auth-session-status :status="session('status')"/>

                <!-- Validation Errors -->
                <x-auth-validation-errors :errors="$errors"/>

                <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                    <div class="mb20">
                        <block-input :name="'email'" :type="'email'" :label="'Email'"
                                     :value="'{{ old('email') }}'"></block-input>
                    </div>

                    <div class="flex flex-center">
                        <button class="btn btn_transformed">
                            Отправить ссылку
                        </button>
                    </div>
                </form>
            </div>
        </div>
@endsection
