<?php


namespace App\Helpers;


use App\Dataproviders\AllPrintersDataprovider;
use App\Dataproviders\DisplayDataprovider;
use App\Dataproviders\MFPDataprovider;
use App\Dataproviders\PrinterDataprovider;
use App\Dataproviders\RentalDataprovider;
use App\Factories\DisplayFilterFactory;
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
    const ALLPRINTERS_ID = 'osszes-nyomtato';
    const ALLPRINTERS_LABEL = 'Nyomtatók';

    public static function getConfiguration($id, $abortWith404OnNotFound = true)
    {
        if ($id == self::PRINTERS_ID) {
            return new ProductcategoryConfiguration(
                $id,
                PrinterDataprovider::class,
                PrinterFilterFactory::class,
                [],
                self::PRINTERS_LABEL,
                'public.partials.printer-summary-block'
            );
        }
        if ($id == self::MFP_ID) {
            return new ProductcategoryConfiguration(
                $id,
                MFPDataprovider::class,
                PrinterFilterFactory::class,
                [],
                self::MFP_LABEL,
                'public.partials.printer-summary-block'
            );
        }
        if ($id == self::ALLPRINTERS_ID) {
            return new ProductcategoryConfiguration(
                $id,
                AllPrintersDataprovider::class,
                PrinterFilterFactory::class,
                [],
                self::ALLPRINTERS_LABEL,
                'public.partials.printer-summary-block'
            );
        }
        if ($id == self::DISPLAYS_ID) {
            return new ProductcategoryConfiguration(
                $id,
                DisplayDataprovider::class,
                DisplayFilterFactory::class,
                [],
                self::DISPLAYS_LABEL,
                'public.partials.display-summary-block'
            );
        }
        if ($id == self::RENTALS_ID) {
            return new ProductcategoryConfiguration(
                $id,
                RentalDataprovider::class,
                PrinterFilterFactory::class,
                [],
                self::RENTALS_LABEL,
                'public.partials.printer-summary-block'
            );
        }
        if ($abortWith404OnNotFound) {
            abort(404);
        }

        return null;
    }
}