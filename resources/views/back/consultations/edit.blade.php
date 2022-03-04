@extends('back.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mb-3">
                        <div class="card-header">
                            <h4>Информация о консультации</h4>
                        </div>
                        <div class="card-body">
                            <div class="error_wrap">
                                @include('back.common.errors')
                            </div>
                            <table class="table table-striped table-bordered">
                                @include('back.common.form_fields')
                                <tr>
                                    <td>Клиент</td>
                                    <td>
                                        Имя: <a
                                            href="{{ route('back.users.edit', ['user' => $item->client_id]) }}">{{ $item->client->name }}</a><br>
                                        E-mail: {{ $item->client->email }}<br>
                                        Телефон: {{ $item->client->phone }}<br>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Психолог</td>
                                    <td>
                                        Имя: <a
                                            href="{{ route('back.users.edit', ['user' => $item->psychologist_id]) }}">{{ $item->psychologist->name }} {{ $item->psychologist->second_name }} {{ $item->psychologist->last_name }}</a><br>
                                        E-mail: {{ $item->psychologist->email }}<br>
                                        Телефон: {{ $item->psychologist->phone }}<br>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Дата, время</td>
                                    <td>{{ $item->datetime->format('d.m.Y, H:i') }}</td>
                                </tr>

                            </table>
                            @if($item->payment)
                                <h4>Платеж</h4>
                                <table class="table table-striped table-bordered">
                                    <tr>
                                        <td>Статус</td>
                                        <td>
                                            @foreach(config('app.payment_statuses') as $value)
                                                @if($value['id'] == $item->payment->status)
                                                    {{ $value['name'] }}
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Сумма</td>
                                        <td>{{ $item->payment->sum }}</td>
                                    </tr>
                                    <tr>
                                        <td>Сумма со скидками</td>
                                        <td>{{ $item->payment->final_sum }}</td>
                                    </tr>
                                    <tr>
                                        <td>Платежная система</td>
                                        <td>
                                            @foreach(config('app.payment_systems') as $value)
                                                @if($value['id'] == $item->payment->system)
                                                    {{ $value['name'] }}
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Идентификатор в платежке</td>
                                        <td>{{ $item->payment->ext_id }}</td>
                                    </tr>
                                    <tr>
                                        <td>Комментарий</td>
                                        <td>{{ $item->payment->comment }}</td>
                                    </tr>
                                </table>
                            @endif
                        </div>


                </div>

            </div>
        </div>
    </div>
@endsection
