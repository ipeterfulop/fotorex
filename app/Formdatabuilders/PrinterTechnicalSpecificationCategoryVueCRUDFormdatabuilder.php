<?php


namespace App\Formdatabuilders;


use App\PrinterTechnicalSpecificationCategory;
use Datalytix\VueCRUD\Formdatabuilders\VueCRUDFormdatabuilder;

class PrinterTechnicalSpecificationCategoryVueCRUDFormdatabuilder extends VueCRUDFormdatabuilder
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

    public function __construct(PrinterTechnicalSpecificationCategory $subject = null, $defaults = [])
    {
        $this->subject = $subject;
        $this->defaults = $defaults;
    }
}