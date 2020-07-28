<?php


namespace App\Formdatabuilders;


use App\Helpers\ColorTechnology;
use App\Helpers\RentaloptionFunction;
use App\Helpers\RentalPeriodUnit;
use App\Rentaloption;
use Datalytix\VueCRUD\Formdatabuilders\Formfieldtypes\CheckboxgroupVueCRUDFormfield;
use Datalytix\VueCRUD\Formdatabuilders\Formfieldtypes\NumberVueCRUDFormfield;
use Datalytix\VueCRUD\Formdatabuilders\Formfieldtypes\SelectVueCRUDFormfield;
use Datalytix\VueCRUD\Formdatabuilders\Formfieldtypes\TextareaVueCRUDFormfield;
use Datalytix\VueCRUD\Formdatabuilders\Formfieldtypes\TextVueCRUDFormfield;
use Datalytix\VueCRUD\Formdatabuilders\Formfieldtypes\YesNoSelectVueCRUDFormfield;
use Datalytix\VueCRUD\Formdatabuilders\Valuesets\YesNoValueset;
use Datalytix\VueCRUD\Formdatabuilders\VueCRUDFormdatabuilder;

class RentaloptionVueCRUDFormdatabuilder extends VueCRUDFormdatabuilder
{
    /**
     * @return Illuminate\Support\Collection;
     * returns a collection of VueCRUDFormfield descendants that
     * define what the edit/create forms will contain
     */
    protected static function getFields()
    {
        $result = [];
        $result['full_operation_included'] = (new YesNoSelectVueCRUDFormfield())
            ->setLabel('Teljes üzemeltetés')
            ->setValuesetClass(YesNoValueset::class)
            ->setContainerClass('col-6')
            ->setDefault(1);
        $result['rental_period_unit'] = (new SelectVueCRUDFormfield())
            ->setValuesetClass(RentalPeriodUnit::class)
            ->setContainerClass('col-6')
            ->setMandatory(true)
            ->setLabel('Bérleti periódus')
            ->setDefault(RentalPeriodUnit::MONTH_ID);
        $result['min_number_of_persons'] = (new NumberVueCRUDFormfield())
            ->setLabel('Minimum felhasználószám')
            ->setContainerClass('col-6')
            ->setMandatory(true);
        $result['max_number_of_persons'] = (new NumberVueCRUDFormfield())
            ->setLabel('Maximum felhasználószám')
            ->setContainerClass('col-6')
            ->setMandatory(true);
        $result['number_of_pages_included'] = (new NumberVueCRUDFormfield())
            ->setLabel('Lapok száma')
            ->setContainerClass('col-6')
            ->setMandatory(true);
        $result['color_technology'] = (new SelectVueCRUDFormfield())
            ->setValuesetClass(ColorTechnology::class)
            ->setContainerClass('col-6')
            ->setLabel('Színes/FF')
            ->setMandatory(true)
            ->setDefault(-1);
        $result['rentaloptions'] = (new CheckboxgroupVueCRUDFormfield())
            ->setContainerClass('col-12')
            ->setDefault([])
            ->setValuesetClass(RentaloptionFunction::class)
            ->setLabel('');
        $result['is_enabled'] = (new YesNoSelectVueCRUDFormfield())
            ->setContainerClass('col-12')
            ->setMandatory(true)
            ->setLabel('Aktív')
            ->setDefault(1);
        $result['description'] = (new TextareaVueCRUDFormfield())
            ->setContainerClass('col-12')
            ->setLabel('Leírás');
        return collect($result);
    }

    public function __construct(Rentaloption $subject = null, $defaults = [])
    {
        $this->subject = $subject;
        $this->defaults = $defaults;
    }

    public function get_rentaloptions_value()
    {
        if ($this->subject === null) {
            return [];
        }

        $result = [];
        foreach (RentaloptionFunction::getFieldNames() as $id => $field) {
            $result[$id] = $this->subject->$field !== 0;
        }

        return $result;
    }
}
