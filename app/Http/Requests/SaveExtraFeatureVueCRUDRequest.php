<?php

namespace App\Http\Requests;

use App\Formdatabuilders\ExtraFeatureVueCRUDFormdatabuilder;
use App\ExtraFeature;
use Datalytix\VueCRUD\Requests\VueCRUDRequestBase;

class SaveExtraFeatureVueCRUDRequest extends VueCRUDRequestBase
{
    const FORMDATABUILDER_CLASS = ExtraFeatureVueCRUDFormdatabuilder::class;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function save(ExtraFeature $subject = null)
    {
        // a very basic create/update method, you should probably replace it
        // with something customized
        if ($subject == null) {
            $subject = ExtraFeature::create($this->getDataset());
        } else {
            $subject->update($this->getDataset());
        }

        return $subject;
    }

    public function getDataset()
    {
        $result = $this->getBaseDatasetFromRequest(ExtraFeature::class);
        // this is very basic, and will probably not suffice except for very simple models
        return $result;
    }
}
