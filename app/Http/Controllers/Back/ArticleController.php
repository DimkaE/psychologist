<?php

namespace App\Http\Controllers\Back;

use App\Http\Requests\Back\ArticleRequest;
use App\Models\Article;
use App\Services\Back\ArticleService;
use Illuminate\Http\Request;

class ArticleController extends BackController
{
    private ArticleService $articleService;

    public function __construct()
    {
        $this->articleService = new ArticleService;
    }

    public function index(Request $request)
    {
        $items = Article::where($this->articleService->filter($request))
            ->orderBy(
                $request->get('sort_col') ?: 'id',
                $request->get('sort_dir') ?: 'desc'
            )->paginate(50);
        return view('back.articles.index', [
            'items' => $items,
            'request' => $request,
            'fields' => config('items.article_fields'),
        ]);
    }

    public function create()
    {
        return view('back.articles.edit', [
            'item' => null,
            'fields' => config('items.article_fields'),
        ]);
    }

    public function store(ArticleRequest $request)
    {
        $article = new Article;
        $article->fill($request->validated());
        $article->save();
        $this->articleService->updateImages($request, $article, 'image');
        return response()->redirect(route('back.articles.edit', ['article' => $article->id]));
    }

    public function edit(Article $article)
    {
        return view('back.articles.edit', [
            'item' => $article,
            'fields' => config('items.article_fields'),
        ]);
    }

    public function update(ArticleRequest $request, Article $article)
    {
        $article->fill($request->validated());
        $article->save();
        $this->articleService->updateImages($request, $article, 'image');
        return response()->success();
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return redirect(route('back.articles.index'));
    }
}
