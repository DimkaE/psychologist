@extends('back.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="d-flex mb-2">
            <div class="flex-fill">
                <h2 class="h4 font-weight-bold">
                    Список консультаций
                </h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <table class="table table-striped table-bordered table-sm table-hover">
                    <tr class="t_header">
                        <th style="width: 60px;"><a href="id"
                                                    @if($request->sort_col == 'id' ) class="{{ $request->sort_dir }}" @endif>ID</a>
                        </th>
                        <th>
                            <a href="clients.email" @if($request->sort_col == 'clients.email' ) class="{{ $request->sort_dir }}" @endif>
                                Клиент
                            </a>
                        </th>
                        <th>
                            <a href="psychologists.email" @if($request->sort_col == 'psychologists.email' ) class="{{ $request->sort_dir }}" @endif>
                                Психолог
                            </a>
                        </th>
                        <th>
                            <a href="datetime" @if($request->sort_col == 'datetime' ) class="{{ $request->sort_dir }}" @endif>
                                Дата сеанса
                            </a>
                        </th>
                        <th>
                            <a href="payments.sum" @if($request->sort_col == 'payments.sum' ) class="{{ $request->sort_dir }}" @endif>
                                Сумма
                            </a>
                        </th>
                        @foreach($fields as $field)
                            @if(!isset($field['not_in_list']))
                                <th>
                                    <a href="{{ $field['key'] }}"
                                       @if($request->sort_col == $field['key'] ) class="{{ $request->sort_dir }}" @endif>{{ $field['name'] }}</a>
                                </th>
                            @endif
                        @endforeach
                        <th>
                            <a href="updated_at"
                               @if($request->sort_col == 'updated_at') class="{{ $request->sort_dir }}" @endif>Посл.изм.</a>
                        </th>
                        <th>
                            <a href="created_at"
                               @if($request->sort_col == 'created_at') class="{{ $request->sort_dir }}" @endif>Создано</a>
                        </th>
                    </tr>
                    <tr class="filters">
                        <th><input type="text" name="filter_like[id]" class="form-control"
                                   value="{{ $request->filter_like['id'] ?? '' }}"></th>
                        <th>
                            <input type="text" name="filter_like[clients.email]" class="form-control"
                                   value="{{ $request->filter_like['clients.email'] ?? '' }}">
                        </th>
                        <th>
                            <input type="text" name="filter_like[psychologists.email]" class="form-control"
                                   value="{{ $request->filter_like['psychologists.email'] ?? '' }}">
                        </th>
                        <th>
                            <div class="text-nowrap">
                                <input placeholder="от" type="date" name="filter_min[datetime]" class="form-control"
                                       value="{{ $request->filter_min['datetime'] ?? '' }}">
                            </div>
                            <div class="text-nowrap">
                                <input placeholder="до" type="date" name="filter_max[datetime]" class="form-control"
                                       value="{{ $request->filter_max['datetime'] ?? '' }}">
                            </div>
                        </th>
                        <th>
                            <div class="text-nowrap">
                                <input placeholder="от" type="number" name="filter_min[payments.sum]" class="form-control"
                                       value="{{ $request->filter_min['payments.sum'] ?? '' }}">
                            </div>
                            <div class="text-nowrap">
                                <input placeholder="до" type="number" name="filter_max[payments.sum]" class="form-control"
                                       value="{{ $request->filter_max['payments.sum'] ?? '' }}">
                            </div>
                        </th>
                        @include('back.common.table_filter')
                        {{--Изменено--}}
                        <th class="text-right">
                            <div class="text-nowrap">
                                <input placeholder="от" type="date" name="filter_min[updated_at]" class="form-control"
                                       value="{{ $request->filter_min['updated_at'] ?? '' }}">
                            </div>
                            <div class="text-nowrap">
                                <input placeholder="до" type="date" name="filter_max[updated_at]" class="form-control"
                                       value="{{ $request->filter_max['updated_at'] ?? '' }}">
                            </div>
                        </th>
                        {{--Создано--}}
                        <th class="text-right">
                            <div class="text-nowrap">
                                <input placeholder="от" type="date" name="filter_min[created_at]" class="form-control"
                                       value="{{ $request->filter_min['created_at'] ?? '' }}">
                            </div>
                            <div class="text-nowrap">
                                <input placeholder="до" type="date" name="filter_max[density]" class="form-control"
                                       value="{{ $request->filter_max['created_at'] ?? '' }}">
                            </div>
                        </th>
                    </tr>
                    @foreach($items as $item)
                        <tr>

                            <td>
                                <a href="{{ route('back.consultations.show', ['consultation' => $item->id]) }}"
                                   class="btn btn-sm btn-success" title="Редактировать">
                                    {{ $item->id }}
                                </a>
                            </td>
                            <td>{{ $item->client_email }}</td>
                            <td>{{ $item->psychologist_email }}</td>
                            <td>{{ $item->datetime->format('d.m.Y, H:i') }}</td>
                            <td>{{ $item->payment_sum }}</td>
                            @include('back.common.table_item')
                            <td>{{ $item->updated_at->format('d.m.Y H:i') }}</td>
                            <td>{{ $item->created_at->format('d.m.Y H:i') }}</td>
                        </tr>
                    @endforeach
                </table>
                <?php $get_data = [
                    'filter_like' => $request->filter_like,
                    'filter_min' => $request->filter_min,
                    'filter_max' => $request->filter_max,
                    'filter_same' => $request->filter_same,
                    'sort_col' => $request->sort_col,
                    'sort_dir' => $request->sort_dir,
                ] ?>
                {{ $items->appends($get_data)->links() }}
            </div>
        </div>
    </div>
@endsection
