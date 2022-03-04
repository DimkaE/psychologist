@extends('front.layouts.secondary')
@section('content')

    <div class="container-small mb180">
        <div class="white-bg white-bg_thin">

            <p class="text-center fz45 fw800 lh12 mb20">Установить новый пароль</p>
            <!-- Validation Errors -->
            <div class="mw400 m-auto">
                <x-auth-validation-errors class="mb-3" :errors="$errors"/>

                <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <!-- Email Address -->
                    <div class="mb20">
                        <block-input :name="'email'" :type="'email'" :label="'Email'"
                                     :value="'{{ old('email', $request->email) }}'"></block-input>
                    </div>

                    <div class="mb20">
                        <block-input :name="'password'" :type="'password'" :label="'Пароль'"></block-input>
                    </div>

                    <div class="mb20">
                        <block-input :name="'password_confirmation'" :type="'password'"
                                     :label="'Пароль еще раз'"></block-input>
                    </div>

                    <div class="flex flex-center">
                        <button class="btn btn_transformed">
                            Сменить пароль
                        </button>
                    </div>
                </form>
            </div>
        </div>
@endsection
