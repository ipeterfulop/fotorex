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

    public static function getDetailBoxLabel($id)
    {
        if ($id == self::BW_ID) {
            return 'MONOKRÓM';
        }
        if ($id == self::COLOR_ID) {
            return 'SZÍNES';
        }
    }

    public static function getDetailBoxCSS($id)
    {
        if ($id == self::COLOR_ID) {
            return '; background-image:radial-gradient(#ffff00,#f06d06);';
        }

        return '';
    }


}
