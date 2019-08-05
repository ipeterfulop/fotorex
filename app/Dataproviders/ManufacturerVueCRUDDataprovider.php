<?php

namespace App\Dataproviders;

use App\Manufacturer;
use Illuminate\Support\Collection;
use Datalytix\VueCRUD\Dataproviders\VueCRUDDataproviderBase;
use Datalytix\VueCRUD\Dataproviders\IVueCRUDDataprovider;

class ManufacturerVueCRUDDataprovider extends VueCRUDDataproviderBase implements IVueCRUDDataprovider
{

    function getBaseQuery()
    {
        return Manufacturer::query();
    }

    function getQuery()
    {
        $query = $this->getBaseQuery();
        $query = $this->addQueryFilters($query, Manufacturer::class);

        return $query;
    }

    protected function getSortingField()
    {
        return request()->get('sorting_field', Manufacturer::getIdProperty());
    }

}