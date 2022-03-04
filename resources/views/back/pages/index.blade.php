@extends('back.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="d-flex mb-2">
                    <div class="flex-fill">
                        <h2 class="h4 font-weight-bold">
                            Список страниц
                        </h2>
                    </div>
                </div>
                <table class="table table-striped table-bordered table-sm table-hover">
                    <tr class="t_header">
                        <th style="width: 60px;">ID</th>
                        @foreach($fields as $field)
                            @if(!isset($field['not_in_list']))
                                <th>
                                    {{ $field['name'] }}
                                </th>
                            @endif
                        @endforeach
                    </tr>
                    @foreach($items as $item)
                        <tr>
                            <td>
                                <a data-toggle="tooltip" data-placement="top" href="{{ route('back.pages.edit', ['page' => $item->id] ) }}" class="btn btn-sm mr-2 btn-success" title="Редактировать">
                                    {{ $item->id }}
                                </a>
                            </td>

                            @include('back.common.table_item')
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
