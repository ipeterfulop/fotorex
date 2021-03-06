<?php


namespace App\Dataproviders;


use App\Attribute;
use App\Helpers\DeviceFunctionality;
use App\Manufacturer;
use App\Printer;
use App\PrinterAttribute;
use App\PrinterPapersize;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class PrinterDataprovider extends ProductDataproviderBase
{

    protected function getQuery($sortingOption, Request $request)
    {
        $query = Printer::withAttributes()
            ->enabled()
            ->printer()
            ->forSale()
            ->sorted($sortingOption);
        $query = self::addBaseScopesToQuery($query);
        foreach ($this->filterbuilderClass::getAllAvailableFilters() as $field) {
            $query = $this->filterbuilderClass::addFilterToQuery(
                $field,
                request()->input($field),
                $query
            );
        }

        return $query;
    }

    public static function addBaseScopesToQuery($query)
    {
        return $query->onlyPrinters();
    }
}
