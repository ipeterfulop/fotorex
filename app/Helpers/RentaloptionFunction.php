<?php


namespace App\Helpers;


use Datalytix\KeyValue\canBeTurnedIntoKeyValueCollection;

class RentaloptionFunction
{
    use canBeTurnedIntoKeyValueCollection;

    const PRINTING_ID = 1;
    const PRINTING_LABEL = 'Nyomtatás';
    const PRINTING_FIELD = 'printing_included';
    const COPYING_ID = 2;
    const COPYING_LABEL = 'Másolás';
    const COPYING_FIELD = 'copying_included';
    const SCANNING_ID = 3;
    const SCANNING_LABEL = 'Lapolvasás';
    const SCANNING_FIELD = 'scanning_included';

    public static function getFieldNames()
    {
        return [
            self::PRINTING_ID => self::PRINTING_FIELD,
            self::COPYING_ID => self::COPYING_FIELD,
            self::SCANNING_ID => self::SCANNING_FIELD,
        ];
    }
}
