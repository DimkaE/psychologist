@extends('back.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="d-flex mb-2">
            <div class="flex-fill">
                <h2 class="h4 font-weight-bold">
                    Список статью
                </h2>
            </div>
            <div>
                <a href="{{ route('back.articles.create') }}" class="btn btn-success">Добавить</a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <table class="table table-striped table-bordered table-sm table-hover">
                    <tr class="t_header">
                        <th style="width: 60px;"><a href="id"
                                                    @if($request->sort_col == 'id' ) class="{{ $request->sort_dir }}" @endif>ID</a>
                        </th>

                        @foreach($fields as $field)
                            @if(!isset($field['not_in_list']))
                                <th>
                                    <a href="{{ $field['key'] }}"
                                       @if($request->sort_col == $field['key'] ) class="{{ $request->sort_dir }}" @endif>{{ $field['name'] }}</a>
                                </th>
                            @endif
                        @endforeach
                    </tr>
                    <tr class="filters">
                        <th><input type="text" name="filter_like[id]" class="form-control"
                                   value="{{ $request->filter_like['id'] ?? '' }}"></th>

                        @include('back.common.table_filter')
                    </tr>
                    @foreach($items as $item)
                        <tr>
                            <td>
                                <a href="{{ route('back.articles.edit', ['article' => $item->id]) }}"
                                   class="btn btn-sm btn-success" title="Редактировать">
                                    {{ $item->id }}
                                </a>
                            </td>


                            @include('back.common.table_item')
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
