<?php

namespace App\Http\Requests;

use App\Formdatabuilders\ExtraFeatureVueCRUDFormdatabuilder;
use App\ExtraFeature;
use Datalytix\VueCRUD\Requests\VueCRUDRequestBase;

class SaveExtraFeatureVueCRUDRequest extends VueCRUDRequestBase
{
    const FORMDATABUILDER_CLASS = ExtraFeatureVueCRUDFormdatabuilder::class;

    public function authorize()
    {
        return true;
    }

    public function save(ExtraFeature $subject = null)
    {
        $dataset = $this->getDataset();
        $dataset["position"] = ExtraFeature::getFirstAvailablePosition();
        if ($subject == null) {
            $subject = ExtraFeature::create($dataset);
        } else {
            $subject->update($dataset);
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
