<?php


namespace App\Formdatabuilders;


use App\Locale;
use App\Slider;
use Datalytix\VueCRUD\Formdatabuilders\Formfieldtypes\NumberVueCRUDFormfield;
use Datalytix\VueCRUD\Formdatabuilders\Formfieldtypes\SelectVueCRUDFormfield;
use Datalytix\VueCRUD\Formdatabuilders\Formfieldtypes\TextVueCRUDFormfield;
use Datalytix\VueCRUD\Formdatabuilders\Formfieldtypes\YesNoSelectVueCRUDFormfield;
use Datalytix\VueCRUD\Formdatabuilders\Valuesets\YesNoValueset;
use Datalytix\VueCRUD\Formdatabuilders\VueCRUDFormdatabuilder;

class SliderVueCRUDFormdatabuilder extends VueCRUDFormdatabuilder
{
    /**
     * @return Illuminate\Support\Collection;
     * returns a collection of VueCRUDFormfield descendants that
     * define what the edit/create forms will contain
     */
    protected static function getFields()
    {
        $result = [];
        $result['name'] = (new TextVueCRUDFormfield())
            ->setLabel('Név')
            ->setContainerClass('col-12')
            ->setMandatory(true);
        $result['slide_display_duration'] = (new TextVueCRUDFormfield())
            ->setLabel('Egy elem megjelenítésének időtartama (mp)')
            ->setRules(['numeric'])
            ->setContainerClass('col-12')
            ->setDefault(5);
        $result['slide_pagination_duration'] = (new TextVueCRUDFormfield())
            ->setLabel('Áttűnés időtartama (mp)')
            ->setRules(['numeric'])
            ->setContainerClass('col-12')
            ->setDefault(2);


        return collect($result);
    }

    public function __construct(Slider $subject = null, $defaults = [])
    {
        $this->subject = $subject;
        $this->defaults = $defaults;
    }
}