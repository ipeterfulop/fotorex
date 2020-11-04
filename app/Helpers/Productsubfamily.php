<?php


namespace App\Helpers;


use Datalytix\KeyValue\canBeTurnedIntoKeyValueCollection;

class Productsubfamily
{
    const INTERACTIVE_DISPLAYS_ID = 1;
    const INTERACTIVE_DISPLAYS_LABEL = 'Interaktív kijelzők';
    const PROFESSIONAL_DISPLAYS_ID = 2;
    const PROFESSIONAL_DISPLAYS_LABEL = 'Professzionális kijelzők';
    const VIDEO_ARRAY_DISPLAYS_ID = 3;
    const VIDEO_ARRAY_DISPLAYS_LABEL = 'Videófal monitorok';

    use canBeTurnedIntoKeyValueCollection;

}