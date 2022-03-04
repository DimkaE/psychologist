@extends('back.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mb-3">
                    <form
                        action="{{ $item ? route('back.reviews.update', ['review' => $item->id]) : route('back.reviews.store') }}"
                        method="post" enctype="multipart/form-data" class="js-form-send">
                        <div class="card-header">
                            @if($item)
                                <h4>Редактировать отзыв</h4>
                            @else
                                <h4>Добавить отзыв</h4>
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="error_wrap">
                                @include('back.common.errors')
                            </div>
                            @csrf
                            @if($item)
                                @method('PATCH')
                                <input type="hidden" name="id" value="{{ $item->id }}">
                            @endif
                            <table class="table table-striped table-bordered">
                                @include('back.common.form_fields')
                                <tr>
                                    <td>Аватар</td>
                                    <td>
                                        @if($item && $item->thumb1)
                                            <img src="{{ url($item->thumb1) }}" alt="">
                                            <a href="#" class="avatar-remove btn btn-danger">Удалить</a>
                                            <input type="hidden" name="image_delete">
                                        @endif
                                        <div>
                                            <input type="file" name="image">
                                        </div>
                                    </td>
                                </tr>

                            </table>
                        </div>
                        <div class="card-footer alert-success">
                            <div class="d-flex">
                                <button type="submit" class="btn btn-success me-2">Сохранить</button>
                            </div>
                        </div>
                    </form>
                </div>

                @if($item)
                    <div class="card">
                        <div class="card-header">Удаление</div>
                        <div class="card-body alert-danger">
                            <a href="#" class="btn btn-danger show-form">Удалить</a>
                            <form method="post" action="{{ route('back.reviews.destroy',  ['review' => $item->id]) }}"
                                  style="display: none;">
                                @csrf
                                @method('DELETE')
                                <p class="text-danger">Вы уверены?</p>
                                <button type="submit" class="btn btn-danger">Точно удалить!</button>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
