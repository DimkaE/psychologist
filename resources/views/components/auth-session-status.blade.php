@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'color-green fz16 mb40']) }}>
        {{ $status }}
    </div>
@endif
