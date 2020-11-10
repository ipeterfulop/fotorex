<?php


namespace App\Dataproviders;


use App\Printer;
use Illuminate\Http\Request;

class AllPrintersDataprovider extends ProductDataproviderBase
{

    protected function getQuery($sortingOption, Request $request)
    {
        $query = Printer::withAttributes()
            ->enabled()
            ->printer()
            ->forSale()
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