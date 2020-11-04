<?php


namespace App\Formdatabuilders;


use App\Display;
use App\Helpers\Productsubfamily;
use Datalytix\VueCRUD\Formdatabuilders\Formfieldtypes\SelectVueCRUDFormfield;
use Datalytix\VueCRUD\Formdatabuilders\VueCRUDFormdatabuilder;

class DisplayVueCRUDFormdatabuilder extends PrinterVueCRUDFormdatabuilder
{
    protected static function getFields()
    {
        $data = parent::getFields();
        $result = [];
        $result['productsubfamily'] = (new SelectVueCRUDFormfield())
            ->setContainerClass('col-12')
            ->setLabel('Termékcsalád')
            ->setValuesetClass(Productsubfamily::class)
            ->setMandatory(true);

        return collect($result)->merge($data);
    }
    public function __construct(Display $subject = null, $defaults = [])
    {
        $this->subject = $subject;
        $this->defaults = $defaults;
    }
}