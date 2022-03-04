@foreach($articles as $article)
    <div class="blog__card mb30">
        <p class="color-gray3 fz16 mb10">{{ $article->date->format('d.m.Y') }}</p>
        <a href="{{ route('article', ['url' => $article->url]) }}"
           class="fz27 fw600 lh13 mb20 link link-dark block">{{ $article->name }}</a>
        <img class="blog__img block mb20" src="{{ $article->thumb_small }}" alt="">
        <p class="fz18 lh16">{{ $article->intro }}</p>
    </div>
@endforeach
