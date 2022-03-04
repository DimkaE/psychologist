@extends('back.layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mb-4">
                    <form
                        action="{{ $item ? route('back.pages.update', ['page' => $item->id]) : route('back.pages.store') }}"
                        method="post" data-method="{{ $item ? 'PATCH' : 'POST' }}" enctype="multipart/form-data"
                        class="js-form-send">
                        <div class="card-header">
                            @if($item)
                                <h4>Редактировать страницу</h4>
                            @else
                                <h4>Добавить страницу</h4>
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
                                <button type="submit" class="btn btn-success mr-3">Сохранить</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
