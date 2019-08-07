<?php

namespace App\Http\Requests;

use App\Formdatabuilders\ManufacturerVueCRUDFormdatabuilder;
use App\Manufacturer;
use Datalytix\VueCRUD\Requests\VueCRUDRequestBase;

class SaveManufacturerVueCRUDRequest extends VueCRUDRequestBase
{
    const FORMDATABUILDER_CLASS = ManufacturerVueCRUDFormdatabuilder::class;

    public function authorize()
    {
        return true;
    }

    public function save(Manufacturer $subject = null)
    {
        \DB::transaction(function() use (&$subject) {
            $dataset = $this->getDataset();
            if ($subject == null) {
                $dataset["position"] = Manufacturer::getFirstAvailablePosition();
                $subject = Manufacturer::create($dataset);
            } else {
                $dataset['position'] = Manufacturer::find($subject['id'])->position;
                $subject->update($dataset);
            }
        });

        return $subject;
    }

    public function getDataset()
    {
        $result = $this->getBaseDatasetFromRequest(Manufacturer::class);
        if (count($this->input('logo')) > 0) {
            $result['logo_photo_id'] = $this->input('logo')[0]['id'];
        }
        else {
            $result['logo_photo_id'] = null;
        }
        return $result;
    }

}
