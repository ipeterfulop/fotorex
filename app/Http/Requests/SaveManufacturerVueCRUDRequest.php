<?php

namespace App\Http\Requests;

use App\Formdatabuilders\ManufacturerVueCRUDFormdatabuilder;
use App\Manufacturer;
use Datalytix\VueCRUD\Requests\VueCRUDRequestBase;

class SaveManufacturerVueCRUDRequest extends VueCRUDRequestBase
{
    const FORMDATABUILDER_CLASS = ManufacturerVueCRUDFormdatabuilder::class;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function save(Manufacturer $subject = null)
    {
        $dataset = $this->getDataset();
        $dataset["position"] = Manufacturer::getFirstAvailablePosition();
        if ($subject == null) {
            $subject = Manufacturer::create($dataset);
        } else {
            $subject->update($dataset);
        }

        return $subject;
    }

    public function getDataset()
    {
        $result = $this->getBaseDatasetFromRequest(Manufacturer::class);
        // this is very basic, and will probably not suffice except for very simple models
        return $result;
    }
}
