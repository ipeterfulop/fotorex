<?php

namespace App\Dataproviders;

use App\Articlecategory;
use Illuminate\Support\Collection;
use Datalytix\VueCRUD\Dataproviders\VueCRUDDataproviderBase;
use Datalytix\VueCRUD\Dataproviders\IVueCRUDDataprovider;

class ArticlecategoryVueCRUDDataprovider extends VueCRUDDataproviderBase implements IVueCRUDDataprovider
{

    function getBaseQuery()
    {
        return Articlecategory::query();
    }

    function getQuery()
    {
        $query = $this->getBaseQuery();
        $query = $this->addQueryFilters($query, Articlecategory::class);

        return $query;
    }

    protected function getSortingField()
    {
        return request()->get('sorting_field', Articlecategory::getIdProperty());
    }

}