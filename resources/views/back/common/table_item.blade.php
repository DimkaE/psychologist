@foreach($fields as $field)
    @if(!isset($field['not_in_list']))
        <td>
            @if($field['field'] == 'select')
                @foreach($field['values'] as $value)
                    @if($value['id'] == $item->{$field['key']})
                        {{ $value['name'] }}
                    @endif
                @endforeach
            @endif
            @if($field['field'] == 'multicheck')
                @foreach(json_decode($item->{$field['key']}) as $key)
                    {{ $field['values'][$key] }},
                @endforeach
            @endif
            @if($field['field'] == 'input')
                @if($field['field_type'] == 'date')
                    {{ $item->{$field['key'] . '_formatted'} }}
                @elseif($field['field_type'] == 'checkbox')
                    {{ $item->{$field['key']} ? 'Да' : 'Нет' }}
                @else
                    @if (stripos($item->{$field['key']}, 'https://') === 0)
                        <a href="{{ $item->{$field['key']} }}" target="_blank">{{ $item->{$field['key']} }}</a>
                    @else
                        {{ $item->{$field['key']} }}
                    @endif
                @endif
            @endif
            @if($field['field'] == 'textarea')
                {!! $item->{$field['key'] . '_formatted'} !!}
            @endif
        </td>
    @endif
@endforeach
