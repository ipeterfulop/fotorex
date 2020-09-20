<?php


namespace App\Helpers;

use Datalytix\KeyValue\canBeTurnedIntoKeyValueCollection;

class DeviceFunctionality
{
    use canBeTurnedIntoKeyValueCollection;

    const NA_ID = 0;
    const NA_LABEL = 'Nem elérhető';
    const BW_ID = 1;
    const BW_LABEL = 'Fehér-fekete';
    const COLOR_ID = 2;
    const COLOR_LABEL = 'Színes';
}
