@extends('back.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="d-flex mb-2">
            <div class="flex-fill">
                <h2 class="h4 font-weight-bold">
                    Список сообщений
                </h2>
            </div>
            <div class="me-3">
                <a href="{{ route('back.messages.create') }}" class="btn btn-success">Добавить</a>
            </div>
            <div>
                <form action="{{ route('back.messages.clear') }}" method="post">
                    @csrf
                    <button class="btn btn-danger">Удалить старые (6мес и ранее)</button>
                </form>
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
                            <a href="users.last_name"
                               @if($request->sort_col == 'users.last_name' ) class="{{ $request->sort_dir }}" @endif>Пользователь</a>
                        </th>
                        <th>
                            <a href="users.role"
                               @if($request->sort_col == 'users.role' ) class="{{ $request->sort_dir }}" @endif>Роль</a>
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
                            <a href="created_at"
                               @if($request->sort_col == 'created_at') class="{{ $request->sort_dir }}" @endif>Создано</a>
                        </th>
                        <th>
                            <a href="updated_at"
                               @if($request->sort_col == 'updated_at') class="{{ $request->sort_dir }}" @endif>Прочитано</a>
                        </th>

                    </tr>
                    <tr class="filters">
                        <th><input type="text" name="filter_like[id]" class="form-control"
                                   value="{{ $request->filter_like['id'] ?? '' }}"></th>
                        <th>
                            <input type="text" name="filter_like[users.last_name]" class="form-control"
                                   value="{{ $request->filter_like['users.last_name'] ?? '' }}">
                        </th>
                        <th>
                            <select name="filter_like[users.role]" class="form-select">
                                <option value=""></option>
                                @foreach(config('app.user_roles') as $value)
                                    <option
                                        @if(isset($request->filter_same['users.role']) && $request->filter_same['users.role'] == $value['id']) selected
                                        @endif value="{{ $value['id'] }}">{{ $value['name'] }}</option>
                                @endforeach
                            </select>
                        </th>
                        @include('back.common.table_filter')
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

                    </tr>
                    @foreach($items as $item)
                        <tr>
                            <td>
                                {{ $item->id }}
                            </td>
                            <td>
                                {{ $item->user_last_name }} {{ $item->user_name }}
                            </td>
                            <td>
                                @foreach(config('app.user_roles') as $value)
                                    @if($value['id'] == $item->user_role)
                                        {{ $value['name'] }}
                                    @endif
                                @endforeach
                            </td>
                            @include('back.common.table_item')
                            <td>{{ $item->created_at->format('d.m.Y H:i') }}</td>
                            <td>{{ $item->read ? $item->updated_at->format('d.m.Y H:i') : '' }}</td>
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
