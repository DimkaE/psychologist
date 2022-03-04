<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class ResponseServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        Response::macro('success', function ($data = null) {
            $return = ['success' => 'Успешно выполнено'];
            if ($data)
                $return['data'] = $data;
            return response()->json($return);
        });

        Response::macro('error', function ($text) {
            return response()->json(['error' => $text]);
        });

        Response::macro('redirect', function ($url) {
            return response()->json(['redirect' => $url]);
        });

        Response::macro('not_found', function () {
            return response()->json(['error' => 'Не найдено'], 404);
        });

        Response::macro('forbidden', function () {
            return response()->json(['error' => 'Запрещено'], 403);
        });
    }
}
