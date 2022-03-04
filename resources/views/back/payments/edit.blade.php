@extends('back.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mb-3">
                    <form
                        action="{{ route('back.payments.update', ['payment' => $item->id]) }}"
                        method="post" data-method="PATCH" enctype="multipart/form-data"
                        class="js-form-send">
                        @method('PATCH')
                        <input type="hidden" name="id" value="{{ $item->id }}">
                        <div class="card-header">
                            <h4>Редактировать платеж</h4>
                        </div>
                        <div class="card-header">
                            Информация о платеже
                        </div>
                        <div class="card-body">
                            <div class="error_wrap">
                                @include('back.common.errors')
                            </div>
                            @csrf
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
