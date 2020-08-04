<?php

namespace App\Http\Requests;

use App\Formdatabuilders\PrinterRentaloptionVueCRUDFormdatabuilder;
use App\PrinterRentaloption;
use Datalytix\VueCRUD\Requests\VueCRUDRequestBase;

class SavePrinterRentaloptionVueCRUDRequest extends VueCRUDRequestBase
{
    const FORMDATABUILDER_CLASS = PrinterRentaloptionVueCRUDFormdatabuilder::class;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function save(PrinterRentaloption $subject = null)
    {
        // a very basic create/update method, you should probably replace it
        // with something customized
        if ($subject == null) {
            $subject = PrinterRentaloption::create($this->getDataset());
        } else {
            $subject->update($this->getDataset());
        }

        return $subject;
    }

    public function getDataset()
    {
        $result = $this->getBaseDatasetFromRequest(PrinterRentaloption::class);
        $result['extra_page_price'] = str_ireplace(',', '.', $result['extra_page_price']);
        // this is very basic, and will probably not suffice except for very simple models
        return $result;
    }
}
