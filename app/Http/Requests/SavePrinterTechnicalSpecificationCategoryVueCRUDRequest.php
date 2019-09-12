<?php

namespace App\Http\Requests;

use App\Formdatabuilders\PrinterTechnicalSpecificationCategoryVueCRUDFormdatabuilder;
use App\PrinterTechnicalSpecificationCategory;
use Datalytix\VueCRUD\Requests\VueCRUDRequestBase;

class SavePrinterTechnicalSpecificationCategoryVueCRUDRequest extends VueCRUDRequestBase
{
    const FORMDATABUILDER_CLASS = PrinterTechnicalSpecificationCategoryVueCRUDFormdatabuilder::class;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function save(PrinterTechnicalSpecificationCategory $subject = null)
    {
        // a very basic create/update method, you should probably replace it
        // with something customized
        if ($subject == null) {
            $subject = PrinterTechnicalSpecificationCategory::create($this->getDataset());
        } else {
            $subject->update($this->getDataset());
        }

        return $subject;
    }

    public function getDataset()
    {
        $result = $this->getBaseDatasetFromRequest(PrinterTechnicalSpecificationCategory::class);
        // this is very basic, and will probably not suffice except for very simple models
        return $result;
    }
}
