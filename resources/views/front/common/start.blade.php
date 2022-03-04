<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $description ?? config('app.name', 'Laravel') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('front/css/app.css') }}">

    <!-- Scripts -->
@routes
</head>
<body class="hp">
<div class="preloader"
     style="position: fixed;z-index: 1000;left: 0;right: 0;top: 0;bottom: 0;background: url('{{ url('front/img/ajax-loader.svg') }}') no-repeat center / 5rem auto, rgba(255, 255, 255, 1);"></div>
<div id="app" class="flex-full flex1 flex-column">
