@if(isset($item->activity))
    <h4>История изменений:</h4>
    <table class="table table-striped table-sm">
        @foreach ($item->activity as $activity)
            <tr>
                <td>{{ date('d.m.Y', strtotime($activity->created_at)) }}</td>
                <td>{{ $activity->description }}</td>
                <td>{{ $activity->user_txt }}</td>
                <td class="text-small">
                    @foreach($activity->properties as $k => $property)
                        {{ $k }}: {!! $property !!}<br>
                    @endforeach
                </td>
            </tr>
        @endforeach
    </table>
@endif
