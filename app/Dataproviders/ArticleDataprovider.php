<?php

namespace App\Dataproviders;


use App\Article;
use Illuminate\Database\Eloquent\Builder;

class ArticleDataprovider
{
    const ITEMS_PER_INDEX_PAGE = 12;

    public static function getPublishedArticles($page, $sortingOption, $filterText = '')
    {
        $query = self::getPublishedArticlesQuery($sortingOption, $filterText);
        $result = new DataproviderResult();
        $result->totalCount = $query->count();
        $result->results = self::addPaginationToQuery($query, $page)->get();
        $result->itemsPerPage = self::ITEMS_PER_INDEX_PAGE;
        $result->currentPage = $page;
        $result->indexRouteName = 'articles_index';
        $result->sortingOption = $sortingOption;

        return $result;
    }

    protected static function getPublishedArticlesQuery($sortingOption, $filterText)
    {
        return Article::where('published_at', '!=', null)
            ->where('published_at', '<=', now()->format('Y-m-d H:i:s'))
            ->where('is_published', '=', 1)
            ->when($filterText != '', function($query) use ($filterText) {
                return $query->where(function($query) use ($filterText) {
                    return $query->where('title', 'like', '%'.$filterText.'%')
                        ->orWhere('content', 'like', '%'.$filterText.'%')
                        ->orWhere('summary', 'like', '%'.$filterText.'%');
                });
            })
            ->when($sortingOption == 'friss', function($query) {
                return $query->orderBy('published_at', 'desc');
            })
            ->when($sortingOption == 'nepszeru', function($query) {
                return $query->orderBy('published_at', 'asc');
            });
    }

    protected static function addPaginationToQuery(Builder $query, $page = 1)
    {
        return $query->skip(($page - 1) * self::ITEMS_PER_INDEX_PAGE)
            ->take(self::ITEMS_PER_INDEX_PAGE);
    }

}