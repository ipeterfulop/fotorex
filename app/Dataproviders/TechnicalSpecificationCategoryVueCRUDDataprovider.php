<?php

namespace App\Dataproviders;

use App\TechnicalSpecificationCategory;
use Illuminate\Support\Collection;
use Datalytix\VueCRUD\Dataproviders\VueCRUDDataproviderBase;
use Datalytix\VueCRUD\Dataproviders\IVueCRUDDataprovider;

class TechnicalSpecificationCategoryVueCRUDDataprovider extends VueCRUDDataproviderBase implements IVueCRUDDataprovider
{

    function getBaseQuery()
    {
        return TechnicalSpecificationCategory::query();
    }

    function getQuery()
    {
        $query = $this->getBaseQuery();
        $query = $this->addQueryFilters($query, TechnicalSpecificationCategory::class);

        return $query;
    }

    protected function getSortingField()
    {
        return request()->get('sorting_field', TechnicalSpecificationCategory::getIdProperty());
    }

}