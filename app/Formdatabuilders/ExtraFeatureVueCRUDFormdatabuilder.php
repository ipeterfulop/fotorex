<?php


namespace App\Formdatabuilders;


use App\ExtraFeature;
use Datalytix\VueCRUD\Formdatabuilders\VueCRUDFormdatabuilder;

class ExtraFeatureVueCRUDFormdatabuilder extends VueCRUDFormdatabuilder
{
    /**
     * @return Illuminate\Support\Collection;
     * returns a collection of VueCRUDFormfield descendants that
     * define what the edit/create forms will contain
     */
    protected static function getFields()
    {
        return collect([]);
    }

    public function __construct(ExtraFeature $subject = null, $defaults = [])
    {
        $this->subject = $subject;
        $this->defaults = $defaults;
    }
}