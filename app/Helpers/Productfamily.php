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
    const PRINTERS_SLUG = 'printer';
    const DISPLAYS_ID = 2;
    const DISPLAYS_LABEL = 'Kijelzők';
    const DISPLAYS_CLASS = Display::class;
    const DISPLAYS_SLUG = 'display';

    use canBeTurnedIntoKeyValueCollection;

    public static function getProductfamilyClass($id)
    {
        return [
            self::PRINTERS_ID => self::PRINTERS_CLASS,
            self::DISPLAYS_ID => self::DISPLAYS_CLASS,
        ][$id];
    }

    public static function getProductfamilySlug($id)
    {
        return [
            self::PRINTERS_ID => self::PRINTERS_SLUG,
            self::DISPLAYS_ID => self::DISPLAYS_SLUG,
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