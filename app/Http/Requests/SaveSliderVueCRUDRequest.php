<?php

namespace App\Http\Requests;

use App\Formdatabuilders\SliderVueCRUDFormdatabuilder;
use App\Slider;
use Datalytix\VueCRUD\Requests\VueCRUDRequestBase;

class SaveSliderVueCRUDRequest extends VueCRUDRequestBase
{
    const FORMDATABUILDER_CLASS = SliderVueCRUDFormdatabuilder::class;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function save(Slider $subject = null)
    {
        // a very basic create/update method, you should probably replace it
        // with something customized
        if ($subject == null) {
            $subject = Slider::create($this->getDataset());
        } else {
            $subject->update($this->getDataset());
        }

        return $subject;
    }

    public function getDataset()
    {
        $result = $this->getBaseDatasetFromRequest(Slider::class);
        // this is very basic, and will probably not suffice except for very simple models
        return $result;
    }
}
