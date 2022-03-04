@extends('front.layouts.secondary')

@section('content')
    <div class="flex-full">
        <div class="container">
            <p class="text-center fz45 fw800 lh12 mb20">Как начать сотрудничество с Helpi?</p>
            <p class="fz20 lh15 mb30 text-center">
                Пожалуйста, заполните анкету. Если ваш опыт и образование подходят,
                <br class="hide-768">
                мы пригласим вас на собеседование.
            </p>
            <div class="white-bg white-bg_thin ad-b02">
                <form-psychologist-register :directions="{{ json_encode($directions) }}"
                :user="{{ json_encode(auth()->user()) }}"></form-psychologist-register>
            </div>
        </div>
    </div>
@endsection
