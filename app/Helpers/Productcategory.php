<?php


namespace App\Helpers;


use App\Dataproviders\MFPDataprovider;
use App\Dataproviders\PrinterDataprovider;
use App\Factories\PrinterFilterFactory;
use Datalytix\KeyValue\canBeTurnedIntoKeyValueCollection;

class Productcategory
{
    use canBeTurnedIntoKeyValueCollection;

    const PRINTERS_ID = 'nyomtatok';
    const PRINTERS_LABEL = 'Nyomtatók';
    const MFP_ID = 'multifunkcios-nyomtatok';
    const MFP_LABEL = 'Multifunkciós nyomtatók';
    const RENTALS_ID = 'nyomtatoberles';
    const RENTALS_LABEL = 'Nyomtatóbérlés';
    const DISPLAYS_ID = 'megjelenito-megoldasok';
    const DISPLAYS_LABEL = 'Megjelenítő megoldások';

    public static function getConfiguration($id, $abortWith404OnNotFound = true)
    {
        if ($id == self::PRINTERS_ID) {
            return new ProductcategoryConfiguration(
                $id,
                PrinterDataprovider::class,
                PrinterFilterFactory::class,
                [],
                self::PRINTERS_LABEL
            );
        }
        if ($id == self::MFP_ID) {
            return new ProductcategoryConfiguration(
                $id,
                MFPDataprovider::class,
                PrinterFilterFactory::class,
                [],
                self::MFP_LABEL
            );
        }
        if ($abortWith404OnNotFound) {
            abort(404);
        }

        return null;
    }
}