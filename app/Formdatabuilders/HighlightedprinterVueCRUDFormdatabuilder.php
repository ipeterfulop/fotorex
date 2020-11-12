<?php


namespace App\Formdatabuilders;


use App\Highlightedprinter;
use App\Printer;
use Datalytix\VueCRUD\Formdatabuilders\Formfieldtypes\SearchableSelectVueCRUDFormfield;
use Datalytix\VueCRUD\Formdatabuilders\VueCRUDFormdatabuilder;

class HighlightedprinterVueCRUDFormdatabuilder extends VueCRUDFormdatabuilder
{
    /**
     * @return Illuminate\Support\Collection;
     * returns a collection of VueCRUDFormfield descendants that
     * define what the edit/create forms will contain
     */
    protected static function getFields()
    {
        $result = [];
        $result['printer_id'] = (new SearchableSelectVueCRUDFormfield())
            ->setMandatory(true)
            ->setLabel('Termék')
            ->setValuesetClass(Printer::class)
            ->setValuesetSortedGetter('getForSearchableSelect');

        return collect($result);
    }

    public function __construct(Highlightedprinter $subject = null, $defaults = [])
    {
        $this->subject = $subject;
        $this->defaults = $defaults;
    }
}