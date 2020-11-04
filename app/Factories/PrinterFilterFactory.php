<?php


namespace App\Factories;


use App\Attribute;
use App\AttributeValue;
use App\ExtraFeature;
use App\Manufacturer;
use App\Papersize;
use App\Printer;
use App\Searching\CheckboxgroupSearchField;
use App\Searching\RadiogroupSearchField;
use App\Searching\RangeSearchField;
use App\Searching\TextSearchField;
use App\UsergroupSize;
use Illuminate\Database\Eloquent\Builder;

class PrinterFilterFactory extends FilterFactory
{
    const MIN_PRICE = 10000;
    const MAX_PRICE = 2000000;

    public static function getAllAvailableFilters()
    {
        return [
            'search',
            'usergroup',
            'price',
            'papersize',
            'networked'
        ];
    }

    public static function getMinPrice()
    {
        $value = Printer::min('actualprice');

        return $value ?? self::MIN_PRICE;
    }

    public static function getMaxPrice()
    {
        $value = Printer::max('actualprice');

        return $value ?? self::MAX_PRICE;
    }
}
