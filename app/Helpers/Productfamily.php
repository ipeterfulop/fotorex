<?php


namespace App\Helpers;


use App\Display;
use App\Http\Controllers\DisplaysController;
use App\Http\Controllers\PrintersController;
use App\Printer;
use Datalytix\KeyValue\canBeTurnedIntoKeyValueCollection;

class Productfamily
{
    const PRINTERS_ID = 1;
    const PRINTERS_LABEL = 'Nyomtatók';
    const PRINTERS_CLASS = Printer::class;
    const PRINTERS_SLUG = 'printer';
    const PRINTERS_CONTROLLER = PrintersController::class;
    const DISPLAYS_ID = 2;
    const DISPLAYS_LABEL = 'Interaktív monitorok';
    const DISPLAYS_CLASS = Display::class;
    const DISPLAYS_SLUG = 'display';
    const DISPLAYS_CONTROLLER = DisplaysController::class;
    const MFP_ID = 3;
    const MFP_LABEL = 'Multifunkciós nyomtatók';
    const MFP_CLASS = Printer::class;
    const MFP_SLUG = 'mfc';
    const MFP_CONTROLLER = PrintersController::class;

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

    public static function getProductfamilyLabel($id)
    {
        return [
            self::PRINTERS_ID => self::PRINTERS_LABEL,
            self::DISPLAYS_ID => self::DISPLAYS_LABEL,
        ][$id];
    }

    public static function getProductfamilyUrlSlug($id)
    {
        return [
            self::PRINTERS_ID => Productcategory::PRINTERS_ID,
            self::DISPLAYS_ID => Productcategory::DISPLAYS_ID,
            self::MFP_ID => Productcategory::MFP_ID,
        ][$id];
    }

    public static function getProductfamilyControllerClass($urlslug)
    {
        return [
            Productcategory::PRINTERS_ID => self::PRINTERS_CONTROLLER,
            Productcategory::DISPLAYS_ID => self::DISPLAYS_CONTROLLER,
            Productcategory::MFP_ID      => self::MFP_CONTROLLER,
        ][$urlslug];
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