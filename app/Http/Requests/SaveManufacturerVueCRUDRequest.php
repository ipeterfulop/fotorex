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
        // a very basic create/update method, you should probably replace it
        // with something customized
        if ($subject == null) {
            $subject = Manufacturer::create($this->getDataset());
        } else {
            $subject->update($this->getDataset());
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
