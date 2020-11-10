<?php


namespace App\Dataproviders;


use App\Display;
use Illuminate\Http\Request;

class DisplayDataprovider extends ProductDataproviderBase
{

    protected function getQuery($sortingOption, Request $request)
    {
        $query = Display::withAttributes()
            ->enabled()
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