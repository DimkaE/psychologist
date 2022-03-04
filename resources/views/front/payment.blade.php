@extends('front.layouts.secondary')

@section('content')
    <div class="flex-full">
        <div class="mb180">
            <form-payment :consultation="{{ json_encode($consultation) }}"
                          :price="{{ json_encode($price) }}"
            ></form-payment>
        </div>
    </div>
@endsection
