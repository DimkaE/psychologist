<?php

namespace App\Http\Controllers\Front;

use App\Models\Article;
use App\Models\Page;
use Illuminate\Http\Request;

class BlogController extends FrontController
{
    public function index()
    {
        $page = Page::where('url', '=', '/work')->first();
        if ($page) {
            $title = $page->meta_title;
            $description = $page->meta_title;
        }
        return view('front.blog.blog', [
            'articles' => Article::query()
                ->orderBy('date', 'desc')
                ->take(config('app.articles_per_page'))
                ->get(),
            'title' => $title ?? '',
            'description' => $description ?? '',
        ]);
    }

    public function more(Request $request)
    {
        if ($request->get('page')) {
            $articles = Article::query()
                ->orderBy('date', 'desc')
                ->skip($request->get('page') * config('app.articles_per_page'))
                ->take(config('app.articles_per_page'))
                ->get();
            if (!$articles)
                return null;
            return view('front.blog.more', [
                'articles' => $articles,
            ]);
        }
        return null;
    }

    public function article($url)
    {
        $article = Article::where('url', $url)->first();
        abort_if(!$article, 404);
        return view('front.blog.article', [
            'article' => $article,
            'title' => $article->title  ?: config('app.name'),
            'description' => $article->description ?: config('app.name'),
        ]);
    }
}
