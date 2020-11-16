<?php


namespace App\Factories;


use App\Display;

class DisplayFilterFactory extends FilterFactory
{

    public static function getAllAvailableFilters()
    {
        return [
            'search',
            'productsubfamily',
        ];
    }

    public static function getMinPrice()
    {
        $value = Display::min('actualprice');

        return $value ?? self::MIN_PRICE;
    }

    public static function getMaxPrice()
    {
        $value = Display::max('actualprice');

        return $value ?? self::MAX_PRICE;
    }
}