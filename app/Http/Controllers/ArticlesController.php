<?php

namespace App\Http\Controllers;

use App\Article;
use App\Dataproviders\ArticleDataprovider;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function index($sortingOption, $page = 1)
    {
        $dataproviderResult = ArticleDataprovider::getPublishedArticles(
            $page,
            $sortingOption,
            request()->get('search', '')
        );
        $sortingOptions = [
            route('articles_index', ['sortingOption' => 'popular']) => ['label' => 'Legnépszerűbb elöl', 'sortingOption' => 'popular'],
            route('articles_index', ['sortingOption' => 'latest']) => ['label' => 'Legújabb elöl', 'sortingOption' => 'latest'],
        ];
        return view('layouts.paginated-data-view', [
            'dataproviderResult' => $dataproviderResult,
            'isotopeContainerId' => 'isotope-articles-container',
            'sortingOptions' => $sortingOptions,
            'currentSortingOption' => $sortingOption,
            'itemViewPath' => 'public.articles.summary-block',
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

    public function redirectToLatest()
    {
        return redirect(route('articles_index', ['sortingOption' => 'latest']));
    }
}
