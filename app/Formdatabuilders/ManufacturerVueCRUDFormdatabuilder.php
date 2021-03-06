<?php


namespace App\Formdatabuilders;


use App\Manufacturer;
use App\Photo;
use Datalytix\VueCRUD\Formdatabuilders\Formfieldtypes\FileCollectorVueCRUDFormfield;
use Datalytix\VueCRUD\Formdatabuilders\Formfieldtypes\TextVueCRUDFormfield;
use Datalytix\VueCRUD\Formdatabuilders\Formfieldtypes\YesNoSelectVueCRUDFormfield;
use Datalytix\VueCRUD\Formdatabuilders\VueCRUDFormdatabuilder;

class ManufacturerVueCRUDFormdatabuilder extends VueCRUDFormdatabuilder
{
    protected static function getFields()
    {
        $result = [];
        $result['name'] = (new TextVueCRUDFormfield())->setMandatory(true)
            ->setLabel('Név')
            ->setContainerClass('col-8');
        $result['is_enabled'] = (new YesNoSelectVueCRUDFormfield())->setMandatory(true)
            ->setLabel('Aktív')
            ->setDefault(0)
            ->setContainerClass('col-4');
        $result['url'] = (new TextVueCRUDFormfield())->setMandatory(false)
            ->setLabel('URL')
            ->setContainerClass('col-12');
        $result['logo'] = (new FileCollectorVueCRUDFormfield())
            ->setLabel('Gyártó logo')
            ->setContainerClass('col-12')
            ->setObjectMode()
            ->addAcceptCondition(FileCollectorVueCRUDFormfield::ACCEPTS_PRESET_IMAGE)
            ->addRoutes('manufacturer')
            ->setLimit(1);
        return collect($result);
    }

    public function get_logo_value()
    {
        if ($this->subject===null || $this->subject->logo_photo_id===null) {
            return [];
        }
        else {
            return [Photo::find($this->subject->logo_photo_id)];
        }
    }

    public function __construct(Manufacturer $subject = null, $defaults = [])
    {
        $this->subject = $subject;
        $this->defaults = $defaults;
    }
}