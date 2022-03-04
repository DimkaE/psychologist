<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;

class RequestServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        Request::macro('validatedExcept', function ($except = []) {
            return Arr::except($this->validated(), $except);
        });
    }
}
