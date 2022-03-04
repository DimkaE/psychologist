@extends('front.layouts.secondary')
@section('content')
<div class="flex-full">
    <div class="container">
        <p class="text-center fz45 fw800 lh12 mb30">Кабинет психолога</p>
        @include('front.common.p_account_menu')
        <div class="white-bg white-bg_thin ad-b02  mb180">
            <div class="flex">
                <div class="col4 hide-550 relative">
                    <div class="al-b02__slide">
                        <div class="mb20">
                            <p data-light-title="#ad-b02-1" class="light-title fz19 fw600">Фото профиля</p>
                        </div>
                        <div class="mb20">
                            <p data-light-title="#ad-b02-2" class="light-title fz19 fw600">Персональные данные</p>
                        </div>
                        <div class="mb20">
                            <p data-light-title="#ad-b02-3" class="light-title fz19 fw600">О себе</p>
                        </div>
                        <div class="mb20">
                            <p data-light-title="#ad-b02-4" class="light-title fz19 fw600">Образование</p>
                        </div>
                        <div class="mb20">
                            <p data-light-title="#ad-b02-5" class="light-title fz19 fw600">Компетенции</p>
                        </div>
                        <div class="mb20">
                            <p data-light-title="#ad-b02-6" class="light-title fz19 fw600">Средства для связи</p>
                        </div>
                        <div class="mb20">
                            <p data-light-title="#ad-b02-7" class="light-title fz19 fw600">График приема</p>
                        </div>
                        <div>
                            <p data-light-title="#ad-b02-8" class="light-title fz19 fw600">Удаление профиля</p>
                        </div>
                    </div>
                </div>
                <div class="col8 col12-550">
                    <form-psychologist-data :user="{{ json_encode($user) }}"
                                            :directions="{{ json_encode($directions) }}">

                    </form-psychologist-data>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
