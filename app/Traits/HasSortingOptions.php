<?php


namespace App\Traits;


trait HasSortingOptions
{

    public static function validateSortingOption($option, $abortWith404IfNotFound = true)
    {
        if (array_key_exists($option, static::getSortingOptionsArray())) {
            return $option;
        }
        if ($abortWith404IfNotFound) {
            abort(404);
        }

        return false;
    }

}
