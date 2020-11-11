<?php

namespace App\Dataproviders;


use App\Article;
use App\Articlecategory;
use Illuminate\Database\Eloquent\Builder;

class ArticleDataprovider
{
    const ITEMS_PER_INDEX_PAGE = 12;

    public static function getPublishedArticles(Articlecategory $category, $page, $sortingOption, $filterText = '')
    {
        $query = self::getPublishedArticlesQuery($category, $sortingOption, $filterText);
        $result = new DataproviderResult();
        $result->totalCount = $query->count();
        $result->results = self::addPaginationToQuery($query, $page)->get();
        $result->itemsPerPage = self::ITEMS_PER_INDEX_PAGE;
        $result->currentPage = $page;
        $result->indexRouteName = 'list_articles';
        $result->sortingOption = $sortingOption;
        $result->routingOptions = ['categorySlug' => $category->custom_slug_base];
        $result->pages = (int)ceil($result->totalCount / $result->itemsPerPage);

        return $result;
    }

    protected static function getPublishedArticlesQuery($category, $sortingOption, $filterText)
    {
        return Article::where('published_at', '!=', null)
            ->where('published_at', '<=', now()->format('Y-m-d H:i:s'))
            ->where('articlecategory_id', '=', $category->id)
            ->where('is_published', '=', 1)
            ->when($filterText != '', function($query) use ($filterText) {
                return $query->where(function($query) use ($filterText) {
                    return $query->where('title', 'like', '%'.$filterText.'%')
                        ->orWhere('content', 'like', '%'.$filterText.'%')
                        ->orWhere('summary', 'like', '%'.$filterText.'%');
                });
            })
            ->when($sortingOption == Article::SORTING_OPTION_LATEST, function($query) {
                return $query->orderBy('published_at', 'desc');
            })
            ->when($sortingOption == Article::SORTING_OPTION_POPULAR, function($query) {
                return $query->orderBy('position', 'asc');
            });
    }

    protected static function addPaginationToQuery(Builder $query, $page = 1)
    {
        return $query->skip(($page - 1) * self::ITEMS_PER_INDEX_PAGE)
            ->take(self::ITEMS_PER_INDEX_PAGE);
    }

}
