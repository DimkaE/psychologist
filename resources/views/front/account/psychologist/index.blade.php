@extends('front.layouts.secondary')
@section('content')
    <div class="flex-full">
        <div class="container">
            <p class="text-center fz45 fw800 lh12 mb30">Кабинет психолога</p>
            @include('front.common.p_account_menu')
            <div class="white-bg al-b02 mb180">
                <div class="flex">
                    <div class="col4 hide-550 relative">
                        <div class="al-b02__slide">
                            <div class="mb20">
                                <p data-light-title="#al-b02-1" class="light-title fz19 fw600">Предстоящие сессии</p>
                            </div>
                            <div>
                                <p data-light-title="#al-b02-2" class="light-title fz19 fw600">Завершенные</p>
                            </div>
                        </div>
                    </div>
                    <div class="col8 col12-550 al-b02__right">
                        <p class="fz20 mb20">Часовой пояс - {{ config('app.timezone_txt') }} (текущее время <span
                                class="fw600 color-green">{{ (new \Carbon\Carbon())->format('d.m.Y, H:i')}}</span>)</p>
                        <form-psychologist-schedule account-enabled="{!! (bool)auth()->user()->enabled !!}">

                        </form-psychologist-schedule>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
