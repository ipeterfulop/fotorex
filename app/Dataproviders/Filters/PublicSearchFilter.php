<?php


namespace App\Dataproviders\Filters;


class PublicSearchFilter
{
    public $searchText;
    public $itemsPerPage = null;
    public $skip = 0;

    public static function createFromRequest($request)
    {
        $result = new self();
        $result->searchText = $request->get('searchText', null);
        $result->itemsPerPage = $request->get('itemsPerPage', null);
        $result->skip = $request->get('skip', 0);

        return $result;
    }

    public function addPaginationToQuery($query)
    {
        return $query->skip($this->filter->skip)
            ->limit($this->filter->itemsPerPage);
    }
}
