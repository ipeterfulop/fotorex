<?php

namespace App\Dataproviders;

use App\Slide;
use Illuminate\Support\Collection;
use Datalytix\VueCRUD\Dataproviders\VueCRUDDataproviderBase;
use Datalytix\VueCRUD\Dataproviders\IVueCRUDDataprovider;

class SlideVueCRUDDataprovider extends VueCRUDDataproviderBase implements IVueCRUDDataprovider
{

    function getBaseQuery()
    {
        return Slide::query();
    }

    function getQuery()
    {
        $query = $this->getBaseQuery();
        $query = $this->addQueryFilters($query, Slide::class);

        return $query;
    }

    protected function getSortingField()
    {
        return request()->get('sorting_field', Slide::getIdProperty());
    }

}