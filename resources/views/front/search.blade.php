@extends('front.layouts.secondary')

@section('content')
    <div class="flex-full">
        <div class="mb180">
            <form-search :directions="{{ json_encode($directions) }}"
                         :total="{{ $total }}"
                         :avatars="{{ json_encode($avatars) }}"
                         :user="{{ json_encode(auth()->user()) }}"
            ></form-search>
        </div>
    </div>
@endsection
