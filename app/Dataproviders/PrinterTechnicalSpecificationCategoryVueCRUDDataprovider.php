<?php

namespace App\Dataproviders;

use App\PrinterTechnicalSpecificationCategory;
use Illuminate\Support\Collection;
use Datalytix\VueCRUD\Dataproviders\VueCRUDDataproviderBase;
use Datalytix\VueCRUD\Dataproviders\IVueCRUDDataprovider;

class PrinterTechnicalSpecificationCategoryVueCRUDDataprovider extends VueCRUDDataproviderBase implements IVueCRUDDataprovider
{

    function getBaseQuery()
    {
        return PrinterTechnicalSpecificationCategory::query();
    }

    function getQuery()
    {
        $query = $this->getBaseQuery();
        $query = $this->addQueryFilters($query, PrinterTechnicalSpecificationCategory::class);

        return $query;
    }

    protected function getSortingField()
    {
        return request()->get('sorting_field', PrinterTechnicalSpecificationCategory::getIdProperty());
    }

}