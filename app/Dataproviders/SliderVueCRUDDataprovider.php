<?php

namespace App\Dataproviders;

use App\Slider;
use Illuminate\Support\Collection;
use Datalytix\VueCRUD\Dataproviders\VueCRUDDataproviderBase;
use Datalytix\VueCRUD\Dataproviders\IVueCRUDDataprovider;

class SliderVueCRUDDataprovider extends VueCRUDDataproviderBase implements IVueCRUDDataprovider
{

    function getBaseQuery()
    {
        return Slider::query();
    }

    function getQuery()
    {
        $query = $this->getBaseQuery();
        $query = $this->addQueryFilters($query, Slider::class);

        return $query;
    }

    protected function getSortingField()
    {
        return request()->get('sorting_field', Slider::getIdProperty());
    }

}