<?php

namespace App\Dataproviders;

use App\Highlightedprinter;
use Illuminate\Support\Collection;
use Datalytix\VueCRUD\Dataproviders\VueCRUDDataproviderBase;
use Datalytix\VueCRUD\Dataproviders\IVueCRUDDataprovider;

class HighlightedprinterVueCRUDDataprovider extends VueCRUDDataproviderBase implements IVueCRUDDataprovider
{

    function getBaseQuery()
    {
        return Highlightedprinter::query();
    }

    function getQuery()
    {
        $query = $this->getBaseQuery();
        $query = $this->addQueryFilters($query, Highlightedprinter::class);

        return $query;
    }

    protected function getSortingField()
    {
        return request()->get('sorting_field', Highlightedprinter::getIdProperty());
    }

}