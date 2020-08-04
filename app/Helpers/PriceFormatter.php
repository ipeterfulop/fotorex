<?php


namespace App\Helpers;


class PriceFormatter
{
    protected static function addCurrency($string, $currency)
    {
        return (string)$currency == '' ? $string : $string.' '.$currency;
    }

    public static function formatToInteger($value, $currency = 'Ft')
    {
        return self::addCurrency(number_format($value, 0, ',', ' '), $currency);
    }

    public static function formatToFloat($value, $currency = 'Ft')
    {
        return self::addCurrency(number_format($value, 2, ',', ' '), $currency);
    }
}
