<?php

namespace App\Http\Requests;

use App\Formdatabuilders\TechnicalSpecificationCategoryVueCRUDFormdatabuilder;
use App\TechnicalSpecificationCategory;
use Datalytix\VueCRUD\Requests\VueCRUDRequestBase;

class SaveTechnicalSpecificationCategoryVueCRUDRequest extends VueCRUDRequestBase
{
    const FORMDATABUILDER_CLASS = TechnicalSpecificationCategoryVueCRUDFormdatabuilder::class;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function save(TechnicalSpecificationCategory $subject = null)
    {
        // a very basic create/update method, you should probably replace it
        // with something customized
        if ($subject == null) {
            $subject = TechnicalSpecificationCategory::create($this->getDataset());
        } else {
            $subject->update($this->getDataset());
        }

        return $subject;
    }

    public function getDataset()
    {
        $result = $this->getBaseDatasetFromRequest(TechnicalSpecificationCategory::class);
        // this is very basic, and will probably not suffice except for very simple models
        return $result;
    }
}
