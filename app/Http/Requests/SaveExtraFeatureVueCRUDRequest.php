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
        \DB::transaction(function() use (&$subject) {
            $dataset = $this->getDataset();
            if ($subject == null) {
                $dataset['position'] = ExtraFeature::getFirstAvailablePosition();
                $subject = ExtraFeature::create($dataset);
            } else {
                $dataset['position'] = ExtraFeature::find($subject['id'])->position;
                $subject->update($dataset);
            }
        });

        return $subject;
    }

    public function getDataset()
    {
        $result = $this->getBaseDatasetFromRequest(ExtraFeature::class);
        if (count($this->input('logo')) > 0) {
            $result['thumbnail_photo_id'] = $this->input('logo')[0]['id'];
        }
        else {
            $result['thumbnail_photo_id'] = null;
        }
        return $result;
    }
}
