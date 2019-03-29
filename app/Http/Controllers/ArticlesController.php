<?php

namespace App\Http\Controllers;

use App\Article;
use App\Articlecategory;
use App\Dataproviders\ArticleDataprovider;
use App\Oldarticleslug;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function index($categorySlug, $sortingOption, $page = 1)
    {
        $sortingOption = Article::validateSortingOption($sortingOption);
        $dataproviderResult = ArticleDataprovider::getPublishedArticles(
            $categorySlug,
            $page,
            $sortingOption,
            request()->get('search', '')
        );
        $sortingOptions = [
            route('articles_index', ['categorySlug' => $categorySlug, 'sortingOption' => Article::SORTING_OPTION_POPULAR]) => ['label' => 'Legnépszerűbb elöl', 'sortingOption' => Article::SORTING_OPTION_POPULAR],
            route('articles_index', ['categorySlug' => $categorySlug, 'sortingOption' => Article::SORTING_OPTION_LATEST]) => ['label' => 'Legújabb elöl', 'sortingOption' => Article::SORTING_OPTION_LATEST],
        ];
        return view('layouts.paginated-data-view', [
            'dataproviderResult' => $dataproviderResult,
            'isotopeContainerId' => 'isotope-articles-container',
            'sortingOptions' => $sortingOptions,
            'currentSortingOption' => $sortingOption,
            'itemViewPath' => 'public.articles.summary-block',
        ]);
    }

    public function show($categorySlug, $slug)
    {
        $category = Articlecategory::findBySlug($categorySlug);

        $article = Article::findBySlug($slug, false, false);
        if ($article == null) {
            $article = optional(Oldarticleslug::with('article')->where('slug', '=', $slug)->first())->article;
            if ($article != null) {
                return redirect(route('article_details', ['categorySlug' => $categorySlug, 'slug' => $article->slug]));
            }
        }
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
