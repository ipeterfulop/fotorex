<?php

namespace App\Http\Controllers;

use App\Article;
use App\Articlecategory;
use App\Dataproviders\ArticleDataprovider;
use App\Oldslug;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function articleList($categorySlug)
    {
        if (!request()->isXmlHttpRequest()) {
            return view('public.articles.index');
        }
        $sortingOption = Article::validateSortingOption(request()->get('sortby', Article::SORTING_OPTION_LATEST));
        $dataproviderResult = ArticleDataprovider::getPublishedArticles(
            $categorySlug,
            request()->get('page', 1),
            $sortingOption,
            request()->get('search', '')
        );
        return view('public.partials.list-or-grid-inner', [
            'view' => 'public.partials.article-summary-block',
            'elements' => $dataproviderResult->results,
            'showPagination' => 'true',
            'result' => $dataproviderResult,
            'paginationPageFieldName' => 'page'
        ]);
    }

    public function show($categorySlug, $slug)
    {
        $category = Articlecategory::findBySlug($categorySlug);

        $article = Article::findBySlug($slug, true, true);

        if ($article->articlecategory_id != $category->id) {
            abort(404);
        }
        return view('public.articles.show', [
            'article' => $article,
            'backUrl' => request()->server('HTTP_REFERER')
        ]);
    }

    public function redirectToLatest($categorySlug)
    {
        return redirect(route('articles_index', ['categorySlug' => $categorySlug, 'sortingOption' => Article::SORTING_OPTION_LATEST]));
    }
}
