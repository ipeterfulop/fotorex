<?php


namespace App\Helpers;


use Datalytix\KeyValue\canBeTurnedIntoKeyValueCollection;

class RentalPeriodUnit
{
    use canBeTurnedIntoKeyValueCollection;

    const MONTH_ID = 'M';
    const MONTH_LABEL = 'Havi';
    const MONTH_LABEL_SHORT = '/hó';
    const YEAR_ID = 'Y';
    const YEAR_LABEL = 'Éves';
    const YEAR_LABEL_SHORT = '/év';
    const DAY_ID = 'D';
    const DAY_LABEL = 'Napi';
    const QUARTER_ID = 'Q';
    const QUARTER_LABEL = 'Negyedéves';
    const QUARTER_LABEL_SHORT = '/negyedév';

    public static function getSuffixes()
    {
        return [
            self::MONTH_ID => self::MONTH_LABEL_SHORT,
            self::YEAR_ID => self::YEAR_LABEL_SHORT,
            self::QUARTER_ID => self::QUARTER_LABEL_SHORT,
        ];
    }

    public static function formatPriceWithSuffix($price, $id)
    {
        return PriceFormatter::formatToInteger($price).self::getSuffixes()[$id];
    }
}
