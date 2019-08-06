<?php

namespace App\Dataproviders;

use App\ExtraFeature;
use Illuminate\Support\Collection;
use Datalytix\VueCRUD\Dataproviders\VueCRUDDataproviderBase;
use Datalytix\VueCRUD\Dataproviders\IVueCRUDDataprovider;

class ExtraFeatureVueCRUDDataprovider extends VueCRUDDataproviderBase implements IVueCRUDDataprovider
{

    function getBaseQuery()
    {
        return ExtraFeature::query();
    }

    function getQuery()
    {
        $query = $this->getBaseQuery();
        $query = $this->addQueryFilters($query, ExtraFeature::class);

        return $query;
    }

    protected function getSortingField()
    {
        return request()->get('sorting_field', ExtraFeature::getIdProperty());
    }

}