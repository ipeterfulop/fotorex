<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function index($page = 1)
    {
        $articles = Article::getArticlesForPublicIndex($page);

        return view('public.articles.index', [
            'articles' => $articles
        ]);
    }

    public function show($slug)
    {
        $article = Article::findBySlug($slug);

        return view('public.articles.show', [
            'article' => $article,
            'backUrl' => request()->server('HTTP_REFERER')
        ]);
    }
}
