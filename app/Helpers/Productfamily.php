<?php


namespace App\Helpers;


use App\Display;
use App\Http\Controllers\DisplaysController;
use App\Http\Controllers\PrintersController;
use App\Http\Controllers\RentalsController;
use App\Printer;
use Datalytix\KeyValue\canBeTurnedIntoKeyValueCollection;

class Productfamily
{
    const PRINTERS_ID = 1;
    const PRINTERS_CLASS = Printer::class;
    const PRINTERS_SLUG = 'printer';
    const PRINTERS_CONTROLLER = PrintersController::class;
    const DISPLAYS_ID = 2;
    const DISPLAYS_CLASS = Display::class;
    const DISPLAYS_SLUG = 'display';
    const DISPLAYS_CONTROLLER = DisplaysController::class;
    const MFP_ID = 3;
    const MFP_CLASS = Printer::class;
    const MFP_SLUG = 'mfp';
    const MFP_CONTROLLER = PrintersController::class;
    const RENTALS_ID = 4;
    const RENTALS_CLASS = Printer::class;
    const RENTALS_SLUG = 'rental';
    const RENTALS_CONTROLLER = RentalsController::class;

    use canBeTurnedIntoKeyValueCollection;

    public static function getProductfamilyClass($id)
    {
        return [
            self::PRINTERS_ID => self::PRINTERS_CLASS,
            self::DISPLAYS_ID => self::DISPLAYS_CLASS,
            self::MFP_ID => self::MFP_CLASS,
            self::RENTALS_ID => self::RENTALS_CLASS,
        ][$id];
    }

    public static function getProductfamilySlug($id)
    {
        return [
            self::PRINTERS_ID => self::PRINTERS_SLUG,
            self::DISPLAYS_ID => self::DISPLAYS_SLUG,
            self::MFP_ID => self::MFP_SLUG,
            self::RENTALS_ID => self::RENTALS_SLUG,
        ][$id];
    }

    public static function getProductfamilyLabel($id)
    {
        return [
            self::PRINTERS_ID => Productcategory::PRINTERS_LABEL,
            self::DISPLAYS_ID => Productcategory::DISPLAYS_LABEL,
            self::MFP_ID => Productcategory::MFP_LABEL,
            self::RENTALS_ID => Productcategory::RENTALS_LABEL,
        ][$id];
    }

    public static function getProductfamilyUrlSlug($id)
    {
        return [
            self::PRINTERS_ID => Productcategory::PRINTERS_ID,
            self::DISPLAYS_ID => Productcategory::DISPLAYS_ID,
            self::MFP_ID => Productcategory::MFP_ID,
            self::RENTALS_ID => Productcategory::RENTALS_ID,
        ][$id];
    }

    public static function getProductfamilyControllerClass($urlslug)
    {
        return [
            Productcategory::PRINTERS_ID => self::PRINTERS_CONTROLLER,
            Productcategory::DISPLAYS_ID => self::DISPLAYS_CONTROLLER,
            Productcategory::MFP_ID      => self::MFP_CONTROLLER,
            Productcategory::RENTALS_ID      => self::RENTALS_CONTROLLER,
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