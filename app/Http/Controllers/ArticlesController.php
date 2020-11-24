<?php

namespace App\Http\Controllers;

use App\Article;
use App\Articlecategory;
use App\Dataproviders\ArticleDataprovider;
use App\Oldslug;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function articleList($categorySlug, $subcategorySlug = null)
    {
        $mainCategory = Articlecategory::findBySlug($categorySlug, true);
        if ($subcategorySlug == null) {
            if ($mainCategory->subcategories->isEmpty()) {
                return view('public.articles.index', ['categorySlug' => $categorySlug]);
            } else {
                return view('public.articles.categories', ['category' => $mainCategory]);
            }
        } else {
            $category = $categorySlug == $subcategorySlug
                ? null
                : Articlecategory::findBySlug($subcategorySlug, false);
            if ($category != null) {
                if ($category->publishedarticles_count == 1) {
                    return $this->showArticle($category, $category->publishedarticles()->first());
                }
                return view('public.articles.index', ['categorySlug' => $subcategorySlug]);
            } else {
                $article = Article::findBySlug($subcategorySlug, true, false);
                return $this->showArticle($mainCategory, $article);
            }
        }
    }
    public function articleListAjax($categorySlug, $subcategorySlug = null)
    {
        $category = $subcategorySlug == null
            ? Articlecategory::findBySlug($categorySlug)
            : Articlecategory::findBySlug($subcategorySlug);
        $dataproviderResult = $this->getCategoryArticles($category);

        return view('public.partials.list-or-grid-inner', [
            'category' => $category,
            'view' => 'public.partials.article-summary-block',
            'elements' => $dataproviderResult->results,
            'showPagination' => 'true',
            'result' => $dataproviderResult,
            'paginationPageFieldName' => 'page'
        ]);

    }

    protected function getCategoryArticles($category)
    {
        $sortingOption = Article::validateSortingOption(request()->get('sortby', Article::SORTING_OPTION_LATEST));
        return ArticleDataprovider::getPublishedArticles(
            $category,
            request()->get('page', 1),
            $sortingOption,
            request()->get('search', '')
        );
    }

    public function show($categorySlug, $subcategorySlug = null, $slug = null)
    {
        $category = $subcategorySlug == null
            ? Articlecategory::findBySlug($categorySlug)
            : Articlecategory::findBySlug($subcategorySlug);

        $article = Article::findBySlug($slug, true, true);

        return $this->showArticle($category, $article);
    }

    protected function showArticle($category, $article)
    {

        if ($article->articlecategory_id != $category->id) {
            abort(404);
        }

        return view('public.articles.show', [
            'article' => $article,
            'category' => $category,
            'backUrl' => request()->server('HTTP_REFERER')
        ]);

    }
}
