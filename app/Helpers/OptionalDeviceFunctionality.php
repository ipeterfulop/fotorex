<?php


namespace App\Helpers;

use Datalytix\KeyValue\canBeTurnedIntoKeyValueCollection;

class OptionalDeviceFunctionality
{
    use canBeTurnedIntoKeyValueCollection;

    const NA_ID = 0;
    const NA_LABEL = 'Nem elérhető';
    const YES_ID = 1;
    const YES_LABEL = 'Igen';
    const NO_ID = 2;
    const NO_LABEL = 'Nem';
    const OPTIONAL_ID = 3;
    const OPTIONAL_LABEL = 'Opcionális';
}
