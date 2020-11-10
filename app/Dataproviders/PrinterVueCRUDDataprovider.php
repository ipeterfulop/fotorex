<?php

namespace App\Dataproviders;

use App\Printer;
use Illuminate\Support\Collection;
use Datalytix\VueCRUD\Dataproviders\VueCRUDDataproviderBase;
use Datalytix\VueCRUD\Dataproviders\IVueCRUDDataprovider;

class PrinterVueCRUDDataprovider extends VueCRUDDataproviderBase implements IVueCRUDDataprovider
{

    function getBaseQuery()
    {
        return Printer::printer();
    }

    function getQuery()
    {
        $query = $this->getBaseQuery();
        $query = $this->addQueryFilters($query, Printer::class);

        return $query;
    }

    protected function getSortingField()
    {
        return request()->get('sorting_field', Printer::getIdProperty());
    }

}