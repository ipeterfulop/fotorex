<?php


namespace App\Formdatabuilders;


use App\ExtraFeature;
use App\Photo;
use Datalytix\VueCRUD\Formdatabuilders\Formfieldtypes\FileCollectorVueCRUDFormfield;
use Datalytix\VueCRUD\Formdatabuilders\Formfieldtypes\TextareaVueCRUDFormfield;
use Datalytix\VueCRUD\Formdatabuilders\Formfieldtypes\TextVueCRUDFormfield;
use Datalytix\VueCRUD\Formdatabuilders\Formfieldtypes\YesNoSelectVueCRUDFormfield;
use Datalytix\VueCRUD\Formdatabuilders\VueCRUDFormdatabuilder;

class ExtraFeatureVueCRUDFormdatabuilder extends VueCRUDFormdatabuilder
{
    protected static function getFields()
    {
        $result = [];
        $result['name'] = (new TextVueCRUDFormfield())->setMandatory(true)
            ->setLabel('Név')
            ->setContainerClass('col-12');
        $result['description'] = (new TextareaVueCRUDFormfield())->setMandatory(true)
            ->setLabel('Leírás')
            ->setContainerClass('col-12');
        $result['is_enabled'] = (new YesNoSelectVueCRUDFormfield())->setMandatory(true)
            ->setLabel('Aktív')
            ->setDefault(0)
            ->setContainerClass('col-4');
        $result['logo'] = (new FileCollectorVueCRUDFormfield())
            ->setLabel('Speciális funkció logo')
            ->setContainerClass('col-12')
            ->setObjectMode()
            ->addAcceptCondition(FileCollectorVueCRUDFormfield::ACCEPTS_PRESET_IMAGE)
            ->addRoutes('extrafeature')
            ->setLimit(1);
        return collect($result);
    }

    public function get_logo_value()
    {
        if ($this->subject===null || $this->subject->thumbnail_photo_id===null) {
            return [];
        }
        else {
            return [Photo::find($this->subject->thumbnail_photo_id)];
        }
    }

    public function __construct(ExtraFeature $subject = null, $defaults = [])
    {
        $this->subject = $subject;
        $this->defaults = $defaults;
    }
}