@extends('back.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mb-3">
                    <form
                        action="{{ $item ? route('back.questions.update', ['question' => $item->id]) : route('back.questions.store') }}"
                        method="post" enctype="multipart/form-data" class="js-form-send">
                        <div class="card-header">
                            @if($item)
                                <h4>Редактировать вопрос</h4>
                            @else
                                <h4>Добавить вопрос</h4>
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
                            <form method="post" action="{{ route('back.questions.destroy',  ['question' => $item->id]) }}"
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
