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
            route('articles_index', ['sortingOption' => 'nepszeru']) => ['label' => 'Legnépszerűbb elöl', 'sortingOption' => 'nepszeru'],
            route('articles_index', ['sortingOption' => 'friss']) => ['label' => 'Legújabb elöl', 'sortingOption' => 'friss'],
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
