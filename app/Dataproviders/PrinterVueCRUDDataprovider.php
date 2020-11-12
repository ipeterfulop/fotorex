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
        return Printer::withAttributes()->printer();
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

    public function getCounts()
    {
        $result = [
            'filtered' => $this->getQuery()->get()->count(),
            'total' => $this->getBaseQuery()->get()->count(),
            'start' => ($this->getPage() - 1) * $this->getItemsPerPage() + 1,
        ];
        $result['start'] = $result['filtered'] > 0 ? $result['start'] : 0;
        if ($result['filtered'] == 0) {
            $result['end'] = 0;
        } else {
            $result['end'] = $result['filtered'] > ($this->getPage() - 1) * $this->getItemsPerPage()
                ? $this->getPage() * $this->getItemsPerPage()
                : $result['filtered'];
            if ($result['end'] > $result['filtered']) {
                $result['end'] = $result['filtered'];
            }
        }

        $result['pagesMax'] = ceil($result['filtered'] / $this->getItemsPerPage());

        return (object) $result;
    }

}