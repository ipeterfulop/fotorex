<?php

namespace App\Dataproviders;

use App\Rentaloption;
use Illuminate\Support\Collection;
use Datalytix\VueCRUD\Dataproviders\VueCRUDDataproviderBase;
use Datalytix\VueCRUD\Dataproviders\IVueCRUDDataprovider;

class RentaloptionVueCRUDDataprovider extends VueCRUDDataproviderBase implements IVueCRUDDataprovider
{

    function getBaseQuery()
    {
        return Rentaloption::query();
    }

    function getQuery()
    {
        $query = $this->getBaseQuery();
        $query = $this->addQueryFilters($query, Rentaloption::class);

        return $query;
    }

    protected function getSortingField()
    {
        return request()->get('sorting_field', Rentaloption::getIdProperty());
    }

}