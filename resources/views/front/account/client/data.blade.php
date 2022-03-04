@extends('front.layouts.secondary')
@section('content')
<div class="flex-full">
    <div class="container">
        <p class="text-center fz45 fw800 lh12 mb30">Кабинет пользователя</p>
        @include('front.common.p_account_menu')
        <div class="white-bg white-bg_thin ad-b02 mb180">
            <div class="flex">
                <div class="col4 hide-550 relative">
                    <div class="al-b02__slide">
                        <div class="mb20">
                            <p data-light-title="#ad-b02-2" class="light-title fz19 fw600">Персональные данные</p>
                        </div>
                        <div>
                            <p data-light-title="#ad-b02-8" class="light-title fz19 fw600">Удаление профиля</p>
                        </div>
                    </div>
                </div>
                <div class="col8 col12-550">
                    <form-user-data :user="{{ json_encode($user) }}"></form-user-data>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
