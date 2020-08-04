<?php

namespace App\Dataproviders;

use App\PrinterRentaloption;
use Illuminate\Support\Collection;
use Datalytix\VueCRUD\Dataproviders\VueCRUDDataproviderBase;
use Datalytix\VueCRUD\Dataproviders\IVueCRUDDataprovider;

class PrinterRentaloptionVueCRUDDataprovider extends VueCRUDDataproviderBase implements IVueCRUDDataprovider
{

    function getBaseQuery()
    {
        return PrinterRentaloption::query();
    }

    function getQuery()
    {
        $query = $this->getBaseQuery();
        $query = $this->addQueryFilters($query, PrinterRentaloption::class);

        return $query;
    }

    protected function getSortingField()
    {
        return request()->get('sorting_field', PrinterRentaloption::getIdProperty());
    }

}