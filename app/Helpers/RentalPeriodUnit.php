<?php


namespace App\Helpers;


use Datalytix\KeyValue\canBeTurnedIntoKeyValueCollection;

class RentalPeriodUnit
{
    use canBeTurnedIntoKeyValueCollection;

    const MONTH_ID = 'M';
    const MONTH_LABEL = 'Havi';
    const YEAR_ID = 'Y';
    const YEAR_LABEL = 'Éves';
    const DAY_ID = 'D';
    const DAY_LABEL = 'Napi';
    const QUARTER_ID = 'Q';
    const QUARTER_LABEL = 'Negyedéves';
}
