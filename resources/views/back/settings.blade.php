@extends('back.layouts.app')

@section('content')
    <div class="container-fluid">
        <h2 class="h4 font-weight-bold">
            Параметры
        </h2>

        <div class="card">
            <div class="card-body">
                <div class="error_wrap"></div>
                <form action="{{ route('back.settings.update') }}" method="post" enctype="multipart/form-data"
                      class="js-form-send">
                    <table class="table table-bordered table-striped">
                        <tbody>
                        @foreach($settings as $setting)
                            <tr>
                                @if(in_array($setting->key, $textarea))
                                    <td colspan="2">
                                        <p>{{ $setting->name }}</p>
                                        <textarea rows="10" class="form-control form-text"
                                                  @if(in_array($setting->key, $required)) required @endif
                                                  name="settings[{{ $setting->key }}]">{{ $setting->value }}</textarea>
                                    </td>
                                @else
                                    <td>{{ $setting->name }}</td>
                                    <td>
                                        <input class="form-control" @if(in_array($setting->key, $required)) required
                                               @endif type="{{ in_array($setting->key, $numbers) ? 'number' : 'text' }}"
                                               name="settings[{{ $setting->key }}]" value="{{ $setting->value }}">

                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <button class="btn btn-success">Сохранить</button>
                </form>
            </div>
        </div>

    </div>
@endsection
