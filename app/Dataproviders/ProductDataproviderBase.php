<?php


namespace App\Dataproviders;


use App\Attribute;
use App\Helpers\Productcategory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class ProductDataproviderBase
{
    const ITEMS_PER_INDEX_PAGE = 12;

    protected $attributes;
    protected $productcategoryConfiguration;
    protected $filterbuilderClass;

    abstract protected function getQuery($sortingOption, Request $request);

    public function __construct($productcategoryId)
    {
        $this->attributes = Attribute::all()->keyBy('variable_name');
        $this->productcategoryConfiguration = Productcategory::getConfiguration($productcategoryId);
        $this->filterbuilderClass = $this->productcategoryConfiguration->filterbuilderClass;
    }


    public function getResults($page, $sortingOption)
    {
        $query = $this->getQuery($sortingOption, request());

        $result = new DataproviderResult();
        $result->totalCount = (clone $query)->get()->count();
        $result->results = self::addPaginationToQuery($query, $page)->get();
        $result->itemsPerPage = static::ITEMS_PER_INDEX_PAGE;
        $result->currentPage = $page;
        $result->indexRouteName = 'list_products_in_category';
        $result->sortingOption = $sortingOption;
        $result->routingOptions = ['productcategoryId' => $this->productcategoryConfiguration->id];
        $result->pages = (int)ceil($result->totalCount / $result->itemsPerPage);

        return $result;
    }

    protected static function addPaginationToQuery(Builder $query, $page = 1)
    {
        return $query->skip(($page - 1) * static::ITEMS_PER_INDEX_PAGE)
            ->take(static::ITEMS_PER_INDEX_PAGE);
    }

}