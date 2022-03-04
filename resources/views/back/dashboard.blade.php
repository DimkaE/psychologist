@extends('back.layouts.app')

@section('content')
    <div class="container-fluid">
        <h2 class="h4 font-weight-bold">
            Заявки на модерацию
        </h2>
        @foreach($users as $user)
            <div class="card mb-3">
                <div class="card-body">
                    <p class="mb-1">ФИО: {{ $user->name }} {{ $user->second_name }} {{ $user->last_name }}</p>
                    <p class="mb-1">Email: {{ $user->email }}</p>
                    <p class="mb-1">Дата рождения: {{ $user->birthdate_formatted }}</p>
                    <p class="mb-1">Опыт (лет): {{ $user->experience }}</p>
                    <p class="mb-1">Клиентов: {{ $user->clients }}</p>
                    <p class="mb-1">О себе: {{ $user->about }}</p>
                </div>
                <div class="card-footer">
                    <a class="btn btn-success" href="{{ route('back.users.edit', $user->id) }}">Перейти</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
