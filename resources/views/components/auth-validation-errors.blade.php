@props(['errors'])

@if ($errors->any())
    <div {!! $attributes->merge(['class' => 'alert alert-danger mb40']) !!} role="alert">
        <div class="text-danger fw700 fz16 mb20">Произошла ошибка</div>

        <ul class="text-danger fz16">
            @foreach ($errors->all() as $error)
                <li class="mb10">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
