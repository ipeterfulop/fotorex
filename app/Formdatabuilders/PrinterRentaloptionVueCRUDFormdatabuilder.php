<?php


namespace App\Formdatabuilders;


use App\Helpers\PriceFormatter;
use App\PrinterRentaloption;
use App\Rentaloption;
use Datalytix\VueCRUD\Formdatabuilders\Formfieldtypes\NumberVueCRUDFormfield;
use Datalytix\VueCRUD\Formdatabuilders\Formfieldtypes\SelectVueCRUDFormfield;
use Datalytix\VueCRUD\Formdatabuilders\Formfieldtypes\TextareaVueCRUDFormfield;
use Datalytix\VueCRUD\Formdatabuilders\Formfieldtypes\TextVueCRUDFormfield;
use Datalytix\VueCRUD\Formdatabuilders\Formfieldtypes\VueComponentVueCRUDFormfield;
use Datalytix\VueCRUD\Formdatabuilders\Formfieldtypes\YesNoSelectVueCRUDFormfield;
use Datalytix\VueCRUD\Formdatabuilders\VueCRUDFormdatabuilder;

class PrinterRentaloptionVueCRUDFormdatabuilder extends VueCRUDFormdatabuilder
{
    /**
     * @return Illuminate\Support\Collection;
     * returns a collection of VueCRUDFormfield descendants that
     * define what the edit/create forms will contain
     */
    protected static function getFields()
    {
        $result = [];
        $result['printer_id'] = (new VueComponentVueCRUDFormfield())
            ->setLabel('Készülék')
            ->setType('printer-picker')
            ->setContainerClass('col-12')
            ->setMandatory(true)
            ->setProps(['operationsUrl' => route('printer_picker_endpoint')]);
        $result['rentaloption_id'] = (new SelectVueCRUDFormfield())
            ->setLabel('Konstrukció')
            ->setMandatory(true)
            ->setContainerClass('col-12')
            ->setValuesetClass(Rentaloption::class);
        $result['price'] = (new NumberVueCRUDFormfield())
            ->setContainerClass('col-6')
            ->setLabel('Ár');
        $result['extra_page_price'] = (new TextVueCRUDFormfield())
            ->setLabel('Ft / extra oldal')
            ->setContainerClass('col-6')
            ->setRules([
                'regex:/^\\d{1,}\,\\d{1,}$/'
            ])->setMessages(['regex' => 'A formátum nem megfelelő']);
        $result['extra_description'] = (new TextareaVueCRUDFormfield())
            ->setContainerClass('col-12')
            ->setLabel('Leírás');
        $result['is_enabled'] = (new YesNoSelectVueCRUDFormfield())->setMandatory(true)
            ->setLabel('Aktív')
            ->setDefault(1)
            ->setContainerClass('col-4');

        return collect($result);
    }

    public function __construct(PrinterRentaloption $subject = null, $defaults = [])
    {
        $this->subject = $subject;
        $this->defaults = $defaults;
    }

    public function get_extra_page_price_value()
    {
        return $this->subject === null
            ? '0,0'
            : PriceFormatter::formatToFloat($this->subject->extra_page_price, '');
    }
}
