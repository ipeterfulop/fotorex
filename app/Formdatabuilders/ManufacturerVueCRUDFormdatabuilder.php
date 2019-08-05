<?php


namespace App\Formdatabuilders;


use App\Manufacturer;
use Datalytix\VueCRUD\Formdatabuilders\Formfieldtypes\NumberVueCRUDFormfield;
use Datalytix\VueCRUD\Formdatabuilders\Formfieldtypes\TextVueCRUDFormfield;
use Datalytix\VueCRUD\Formdatabuilders\Formfieldtypes\YesNoSelectVueCRUDFormfield;
use Datalytix\VueCRUD\Formdatabuilders\Valuesets\YesNoValueset;
use Datalytix\VueCRUD\Formdatabuilders\VueCRUDFormdatabuilder;

class ManufacturerVueCRUDFormdatabuilder extends VueCRUDFormdatabuilder
{
    protected static function getFields()
    {
        $result = [];
        $result['name'] = (new TextVueCRUDFormfield())->setMandatory(true)
            ->setLabel('Név')
            ->setContainerClass('col-12');
        $result['is_enabled'] = (new YesNoSelectVueCRUDFormfield())->setMandatory(true)
            ->setLabel('Aktív')
            ->setDefault(0)
            ->setValuesetClass(YesNoValueset::class)
            ->setContainerClass('col-6');
        $result['url'] = (new TextVueCRUDFormfield())->setMandatory(false)
            ->setLabel('URL')
            ->setContainerClass('col-12');
        return collect($result);
    }

    public function __construct(Manufacturer $subject = null, $defaults = [])
    {
        $this->subject = $subject;
        $this->defaults = $defaults;
    }
}