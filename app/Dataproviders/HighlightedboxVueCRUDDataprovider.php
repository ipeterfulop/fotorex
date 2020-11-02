<?php

namespace App\Dataproviders;

use App\Highlightedbox;
use Illuminate\Support\Collection;
use Datalytix\VueCRUD\Dataproviders\VueCRUDDataproviderBase;
use Datalytix\VueCRUD\Dataproviders\IVueCRUDDataprovider;

class HighlightedboxVueCRUDDataprovider extends VueCRUDDataproviderBase implements IVueCRUDDataprovider
{

    function getBaseQuery()
    {
        return Highlightedbox::query();
    }

    function getQuery()
    {
        $query = $this->getBaseQuery();
        $query = $this->addQueryFilters($query, Highlightedbox::class);

        return $query;
    }

    protected function getSortingField()
    {
        return request()->get('sorting_field', Highlightedbox::getIdProperty());
    }

}