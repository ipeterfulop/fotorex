<?php

namespace App\Http\Controllers;

use App\Article;
use App\Dataproviders\ArticleDataprovider;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function index($page = 1)
    {
        $dataproviderResult = ArticleDataprovider::getPublishedArticles($page, request()->get('search', ''));

        return view('public.articles.index', [
            'dataproviderResult' => $dataproviderResult
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
