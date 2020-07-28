<?php


namespace App\Helpers;


use Datalytix\KeyValue\canBeTurnedIntoKeyValueCollection;

class ColorTechnology
{
    use canBeTurnedIntoKeyValueCollection;

    const BW_ID = 0;
    const BW_LABEL = 'Fekete-fehér';
    const COLOR_ID = 1;
    const COLOR_LABEL = 'Színes';
}
