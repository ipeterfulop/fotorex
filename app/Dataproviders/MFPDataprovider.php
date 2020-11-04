<?php


namespace App\Dataproviders;


use App\Attribute;
use App\Printer;
use Illuminate\Http\Request;

class MFPDataprovider extends ProductDataproviderBase
{

    protected function getQuery($sortingOption, Request $request)
    {
        $query = Printer::withAttributes()
            ->enabled()
            ->forSale()
            ->multifunctionals()
            ->sorted($sortingOption);

        foreach ($this->filterbuilderClass::getAllAvailableFilters() as $field) {
            $query = $this->filterbuilderClass::addFilterToQuery(
                $field,
                request()->input($field),
                $query
            );
        }

        return $query;
    }
}