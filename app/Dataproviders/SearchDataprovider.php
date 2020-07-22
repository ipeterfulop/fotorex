<?php


namespace App\Dataproviders;


use App\Article;
use App\Dataproviders\Filters\PublicSearchFilter;
use App\Searchresult;
use App\SearchresultList;
use App\SearchresultType;

class SearchDataprovider
{
    protected $filter;

    public function __construct(PublicSearchFilter $filter)
    {
        $this->filter = $filter;
    }

    public static function createFromRequest($request)
    {
        return new self(PublicSearchFilter::createFromRequest($request));
    }

    public function getResults()
    {
        return $this->getArticleHits();
    }

    protected function getArticleHits()
    {
        $articles = Article::searchText($this->filter->searchText)
            ->published()
            ->orderBy('published_at', 'desc')
            ->when($this->filter->itemsPerPage != null, function($query) {
                return $this->filter->addPaginationToQuery($query);
            })
            ->get();

        $result = [];
        foreach ($articles as $article) {
            $searchresult = new Searchresult();
            $searchresult->typeId = SearchresultType::TYPE_ARTICLE_ID;
            $searchresult->title = $article->title;
            $searchresult->description = $article->summary;
            $searchresult->slug = $article->url;
            $result[] = $searchresult;
        }

        return collect($result);
    }
}
