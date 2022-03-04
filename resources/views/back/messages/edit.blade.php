@extends('back.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mb-3">
                    <form
                        action="{{ route('back.messages.store') }}"
                        method="post" enctype="multipart/form-data" class="js-form-send">
                        <div class="card-header">
                            <h4>Создать сообщение</h4>
                        </div>
                        <div class="card-body">
                            <div class="error_wrap">
                                @include('back.common.errors')
                            </div>
                            @csrf
                            <table class="table table-striped table-bordered">
                                @include('back.common.form_fields')
                                <tr>
                                    <td>Получатель. Начните набирать и <br><span class="text-danger">!!обязательно!!</span> выберите из выпадающего списка</td>
                                    <td class="dropdown show">
                                        <input class="form-control js-autocomplete" autocomplete="off" name="user_name" data-url="{{ route('back.user_autocomplete') }}" type="text" value="">
                                        <div class="js-autocomplete-dropdown dropdown-menu"></div>
                                        <input type="hidden" name="user_id" value="">
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="card-footer alert-success">
                            <div class="d-flex">
                                <button type="submit" class="btn btn-success me-2">Отправить</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
