@extends('front.layouts.secondary')
@section('content')
    <div class="flex-full">
        <div class="container">
            <p class="text-center fz45 fw800 lh12 mb30">
                @if(auth()->user()->role == 2)
                    Кабинет психолога
                @else
                    Кабинет пользователя
                @endif
            </p>
            @include('front.common.p_account_menu')
            <div class="white-bg al-b02  mb180">
                <div class="flex">
                    <div class="col4 hide-550 relative">

                    </div>
                    <div class="col8 col12-550 al-b02__right">
                        @if($messages_unread->count())
                            <p class="fz26 fw600 mb20">Новые уведомления</p>

                            <div class="mb40">
                                @foreach($messages_unread as $message)
                                    <div class="al-b02__card mb20">
                                        <p class="color-gray3 fz16 mb10">{{ $message->date_formatted }}</p>
                                        <p class="fz19 fw600 mb10">{{ $message->title }}</p>
                                        <p class="fz17 lh15 mb15 al-b02__card-message">{!! $message->content !!}</p>
                                        <div class="mw100">
                                            <a href="#" class="btn2 btn2_small btn2_center"
                                               onclick="$(this).remove();return false;">
                                                <span>Ок</span>
                                            </a>
                                        </div>

                                    </div>
                                @endforeach
                            </div>
                        @endif
                        @php($a = 0)
                        @foreach($messages_read as $message)
                            @php($a++)
                            @if($a < config('app.mess_before_spoiler'))
                                <div class="al-b02__card mb20">
                                    <p class="color-gray3 fz16 mb10">{{ $message->date_formatted }}</p>
                                    <p class="fz19 fw600 mb10 color-gray3">{{ $message->title }}</p>
                                    <p class="fz17 lh15 mb15 color-gray3 al-b02__card-message">{!! $message->content !!}</p>
                                </div>
                            @endif
                        @endforeach
                        @if($messages_read->count() > config('app.mess_before_spoiler'))
                            <a class="link link-green fz16 fw600 flex1 flex-v-center" href="#"
                               onclick="$(this).next().slideDown();$(this).remove();return false;">
                                <span>Показать более ранние</span>
                                <svg width="1.2rem" height="1.2rem">
                                    <use xlink:href="#ico-arrow-down2"></use>
                                </svg>
                            </a>
                            @php($a = 0)
                            <div style="display: none;">
                                @foreach($messages_read as $message)
                                    @php($a++)
                                    @if($a >= config('app.mess_before_spoiler'))
                                        <div class="al-b02__card mb20">
                                            <p class="color-gray3 fz16 mb10">{{ $message->date_formatted }}</p>
                                            <p class="fz19 fw600 mb10 color-gray3">{{ $message->title }}</p>
                                            <p class="fz17 lh15 mb15 color-gray3">{{ $message->content }}</p>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
