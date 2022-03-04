@foreach($fields as $field)
    @if(!isset($field['not_in_list']))
        <th>
            @if($field['filter'] == 'like')
                <input type="text" name="filter_like[{{ $field['key'] }}]" class="form-control"
                       value="{{ $request->filter_like[$field['key']] ?? '' }}">
            @endif
            @if($field['filter'] == 'from_to')
                <div class="text-nowrap">
                    <input placeholder="от" type="{{ $field['field_type'] }}" name="filter_min[{{ $field['key'] }}]" class="form-control"
                           value="{{ $request->filter_min[$field['key']] ?? '' }}">
                </div>
                <div class="text-nowrap">
                    <input placeholder="до" type="{{ $field['field_type'] }}" name="filter_max[{{ $field['key'] }}]" class="form-control"
                           value="{{ $request->filter_max[$field['key']] ?? '' }}">
                </div>
            @endif
            @if($field['filter'] == 'select')
                <select class="form-select" name="filter_same[{{ $field['key'] }}]">
                    <option value=""></option>
                    @foreach($field['values'] as $value)
                        <option @if(isset($request->filter_same[$field['key']]) && $request->filter_same[$field['key']] == $value['id']) selected @endif value="{{ $value['id'] }}">{{ $value['name'] }}</option>
                    @endforeach
                </select>
            @endif
            @if($field['filter'] == 'checkbox')
                <select class="form-select" name="filter_same[{{ $field['key'] }}]">
                    <option value=""></option>
                    <option @if(isset($request->filter_same[$field['key']]) && $request->filter_same[$field['key']] == 1) selected @endif value="1">Да</option>
                </select>
            @endif
            @if($field['filter'] == 'multicheck')
                <select class="form-control" name="filter_like[{{ $field['key']}}]">
                    <option value=""></option>
                    @foreach($field['values'] as $k => $value)
                        <option @if(isset($request->filter_same[$field['key']]) && $request->filter_same[$field['key']] == $k) selected @endif value="{{ '"' . $k . '"' }}">{{ $value }}</option>
                    @endforeach
                </select>
            @endif
        </th>
    @endif
@endforeach
