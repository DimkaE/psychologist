@foreach($fields as $field)
    <tr>
        <td>{{ $field['name'] }}</td>
        <td>
           @if($field['field'] == 'input')
                @if($field['field_type'] == 'date')
                    <input {{ $field['attributes'] ?? '' }} class="form-control" type="{{ $field['field_type'] }}" name="{{ $field['key'] }}" value="{{ isset($item) && $item->{$field['key']} ? $item->{$field['key']}->format('Y-m-d') : old($field['key']) }}">
                @elseif($field['field_type'] == 'file')
                    <p>{{ $item->{$field['key']} }}</p>
                    <input {{ $field['attributes'] ?? '' }} type="{{ $field['field_type'] }}" name="{{ $field['key'] }}">
                @elseif($field['field_type'] == 'checkbox')
                    <div class="form-check">
                        <input type="hidden" name="{{ $field['key'] }}" value="0">
                        <input {{ $field['attributes'] ?? '' }} type="{{ $field['field_type'] }}" class="form-check-input" name="{{ $field['key'] }}" value="1"  @if(isset($item) && $item->{$field['key']}) checked @endif>
                    </div>
                @else
                    <input {{ $field['attributes'] ?? '' }} class="form-control @if($field['filter'] == 'from_to') js-number @endif" type="{{ $field['field_type'] }}" name="{{ $field['key'] }}" value="{{ $item->{$field['key']} ?? old($field['key']) }}">

                @endif
            @endif
            @if($field['field'] == 'textarea')
                <textarea {{ $field['attributes'] ?? '' }} @if(isset($field['field_type']) && $field['field_type'] == 'ckeditor') id="ckeditor" @endif class="form-control" name="{{ $field['key'] }}">{{ $item->{$field['key']} ?? old($field['key']) }}</textarea>
            @endif
            @if($field['field'] == 'select')
                <select {{ $field['attributes'] ?? '' }} class="form-select" name="{{ $field['key'] }}">
                    <option value="">--не выбрано--</option>
                    @foreach($field['values'] as $value)
                        <option @if(isset($item->{$field['key']}) && $item->{$field['key']} == $value['id']) selected @endif value="{{ $value['id'] }}">{{ $value['name'] }}</option>
                    @endforeach
                </select>
            @endif
            @if($field['field'] == 'multicheck')
                @foreach($field['values'] as $k => $value)
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" name="{{ $field['key'] }}[]" type="checkbox" @if(isset($item->{$field['key']}) && in_array($k, json_decode($item->{$field['key']}))) checked @endif value="{{ $k }}">{{ $value }}
                        </label>
                    </div>
                @endforeach
            @endif
        </td>
    </tr>
@endforeach
