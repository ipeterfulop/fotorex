<?php


namespace App\Helpers;


use Datalytix\KeyValue\canBeTurnedIntoKeyValueCollection;

class LinkTarget
{
    use canBeTurnedIntoKeyValueCollection;

    const SELF_ID = 1;
    const BLANK_ID = 2;
    const SELF_LABEL = 'Ugyanazon ablakban';
    const BLANK_LABEL = 'Új ablakban';
}