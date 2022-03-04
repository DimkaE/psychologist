@extends('back.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mb-3">
                    <form
                        action="{{ $item ? route('back.users.update', ['user' => $item->id]) : route('back.users.store') }}"
                        method="post" enctype="multipart/form-data" class="js-form-send">
                        <div class="card-header">
                            @if($item)
                                <h4>Редактировать пользователя</h4>
                            @else
                                <h4>Добавить пользователя</h4>
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

                                @if($item && $item->role == 2)
                                    <tr>
                                        <td>Аватар</td>
                                        <td>
                                            @if($item && $item->ava115)
                                                <img src="{{ url($item->ava115) }}" alt="">
                                                <a href="#" class="avatar-remove btn btn-danger">Удалить</a>
                                                <input type="hidden" name="image_delete">
                                            @endif
                                            <div>
                                                <input type="file" name="image">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Направления</td>
                                        <td>
                                            @foreach($item->directionsRel as $direction)
                                                {{ $direction->name }},<br>
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Образование</td>
                                        <td>
                                            @foreach($item->educationsRel as $education)
                                                {{ $education->education }} ({{ $education->primary ? 'осн' : 'доп' }}),
                                                <br>
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Дипломы</td>
                                        <td>
                                            @foreach($item->diplomas as $diploma)
                                                <a href="{{ $diploma->getUrl() }}" target="_blank">
                                                    <img src="{{ $diploma->getUrl('thumb193') }}" alt="">
                                                </a>
                                                <br>
                                            @endforeach
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <td>Пароль @if($item)<br><small>(оставьте пустым, чтобы не менять)</small>@endif
                                    </td>
                                    <td>
                                        <input @if(!$item) required @endif class="form-control form-control-sm"
                                               type="text" name="password" value="">
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
                @if($item && $item->role == 1)
                    <div class="card mb-3">
                        <div class="card-header"><h4>Информация о сессиях</h4></div>
                        <div class="card-body">
                            <p>Оплаченных, но не проведенных сессий: {{ $unused }}</p>
                            <div class="mb-4">
                            <h5>Сессии</h5>
                            @foreach($item->consultationRel as $consultation)
                                <p class="mb-1">
                                    {{ $consultation->datetime->format('d.m.y, H:i') }},
                                    психолог: {{ $consultation->psychologist->name }}
                                    {{ $consultation->psychologist->second_name }}
                                    {{ $consultation->psychologist->last_name }},
                                    @foreach(config('app.consultation_statuses') as $value)
                                        @if($value['id'] == $consultation->status)
                                            {{ $value['name'] }}
                                        @endif
                                    @endforeach
                                </p>
                            @endforeach
                            </div>
                            <div class="mb-4">
                                <h5>Платежи</h5>
                                @foreach($item->paymentsRel as $payment)
                                    <div class="d-flex align-items-center mb-1">
                                        <p class="mb-0 me-2">
                                            Сумма: {{ $payment->sum }},
                                            со скидкой: {{ $payment->final_sum }},
                                            платежка:
                                            @foreach(config('app.payment_systems') as $value)
                                                @if($value['id'] == $payment->system)
                                                    <b>{{ $value['name'] }}</b>,
                                                @endif
                                            @endforeach
                                            статус:
                                            @foreach(config('app.payment_statuses') as $value)
                                                @if($value['id'] == $payment->status)
                                                    {{ $value['name'] }}
                                                @endif
                                            @endforeach
                                        </p>
                                        @if($payment->system == 100 && !$payment->consultation_id)
                                            <form action="{{ route('back.payments.remove') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="payment_id" value="{{ $payment->id }}">
                                                <button class="btn btn-danger btn-sm">Отменить</button>
                                            </form>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                            <form action="{{ route('back.payments.add') }}" method="post">
                                @csrf
                                <table class="table table-striped table-bordered">
                                    <tr>
                                        <td colspan="3">
                                            Добавить бесплатные консультации. Пользователь сам сможет выбрать
                                            специалиста
                                            и
                                            назначить дату сеанса
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Количество консультаций
                                        </td>
                                        <td>
                                            <input class="form-control" type="number" value="1" name="quantity">
                                            <input type="hidden" name="user_id" value="{{ $item->id }}">
                                        </td>
                                        <td>
                                            <button class="btn btn-success" type="submit">Добавить</button>
                                        </td>
                                    </tr>
                                </table>

                            </form>
                        </div>
                    </div>
                @endif


                @if($item)
                    <div class="card">
                        <div class="card-header">Удаление</div>
                        <div class="card-body alert-danger">
                            <a href="#" class="btn btn-danger show-form">Удалить</a>
                            <form method="post" action="{{ route('back.users.destroy',  ['user' => $item->id]) }}"
                                  style="display: none;" class="js-form-send">
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
