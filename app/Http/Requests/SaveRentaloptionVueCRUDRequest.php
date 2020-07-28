<?php

namespace App\Http\Requests;

use App\Formdatabuilders\RentaloptionVueCRUDFormdatabuilder;
use App\Helpers\RentaloptionFunction;
use App\Rentaloption;
use Datalytix\VueCRUD\Requests\VueCRUDRequestBase;

class SaveRentaloptionVueCRUDRequest extends VueCRUDRequestBase
{
    const FORMDATABUILDER_CLASS = RentaloptionVueCRUDFormdatabuilder::class;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function save(Rentaloption $subject = null)
    {
        // a very basic create/update method, you should probably replace it
        // with something customized
        if ($subject == null) {
            $subject = Rentaloption::create($this->getDataset());
        } else {
            $subject->update($this->getDataset());
        }

        return $subject;
    }

    public function getDataset()
    {
        $result = [
            'full_operation_included' => $this->input('full_operation_included'),
            'min_number_of_persons' => $this->input('min_number_of_persons'),
            'max_number_of_persons' => $this->input('max_number_of_persons'),
            'number_of_pages_included' => $this->input('number_of_pages_included'),
            'rental_period_unit' => $this->input('rental_period_unit'),
            'color_technology' => $this->input('color_technology'),
            'description' => $this->input('description'),
            'is_enabled' => $this->input('is_enabled'),
        ];
        foreach (RentaloptionFunction::getFieldNames() as $id => $field) {
            $result[$field] = request()->get('rentaloptions')[$id] === true ? 1 : 0;
        }

        return $result;
    }
}
