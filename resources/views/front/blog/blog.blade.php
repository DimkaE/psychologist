@extends('front.layouts.secondary')

@section('content')
    <div class="flex-full blog mb60">
        <div class="container-small">
            <h1 class="text-center fz42 fw800 mb40">Наш блог</h1>
            <div class="blog__container">
                @foreach($articles as $article)
                    <div class="blog__card mb30">
                        <p class="color-gray3 fz16 mb10">{{ $article->date->format('d.m.Y') }}</p>
                        <a href="{{ route('article', ['url' => $article->url]) }}"
                           class="fz27 fw600 lh13 mb20 link link-dark block">{{ $article->name }}</a>
                        <img class="blog__img block mb20" src="{{ $article->thumb_small }}" alt="">
                        <p class="fz18 lh16">{{ $article->intro }}</p>
                    </div>
                @endforeach
            </div>

            <div class="flex1 flex-center">
                <a class="link link-green fz16 fw600 flex1 flex-v-center js-blog-load-more" href="#">
                    <span>Показать более ранние</span>
                    <svg width="1.2rem" height="1.2rem">
                        <use xlink:href="#ico-arrow-down2"></use>
                    </svg>
                </a>
            </div>
        </div>
    </div>

@endsection
