<?php


namespace App\Helpers;


use App\Display;
use App\Printer;
use Datalytix\KeyValue\canBeTurnedIntoKeyValueCollection;

class Productfamily
{
    const PRINTERS_ID = 1;
    const PRINTERS_LABEL = 'Nyomtatók';
    const PRINTERS_CLASS = Printer::class;
    const DISPLAYS_ID = 2;
    const DISPLAYS_LABEL = 'Kijelzők';
    const DISPLAYS_CLASS = Display::class;

    use canBeTurnedIntoKeyValueCollection;

    public static function getProductfamilyClass($id)
    {
        return [
            self::PRINTERS_ID => self::PRINTERS_CLASS,
            self::DISPLAYS_ID => self::DISPLAYS_CLASS,
        ][$id];
    }

    public static function getProductfamilyIdFromProductId($productId)
    {
        return Printer::getProductfamily($productId);
    }

    public static function getProductfamilyClassFromProductId($productId)
    {
        $productfamilyId = Printer::getProductfamily($productId);

        return Productfamily::getProductfamilyClass($productfamilyId);
    }
}