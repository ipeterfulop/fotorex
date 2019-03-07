<?php

namespace App\Http\Requests;

use App\Formdatabuilders\UserVueCRUDFormdatabuilder;
use App\User;
use Datalytix\VueCRUD\Requests\VueCRUDRequestBase;

class SaveUserVueCRUDRequest extends VueCRUDRequestBase
{
    const FORMDATABUILDER_CLASS = UserVueCRUDFormdatabuilder::class;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function save(User $subject = null)
    {
        // a very basic create/update method, you should probably replace it
        // with something customized
        if ($subject == null) {
            $subject = User::create($this-getDataset());
        } else {
            $subject->update($this->getDataset());
        }

        return $subject;
    }

    public function getDataset()
    {
        $result = $this->getBaseDatasetFromRequest(User::class);
        // this is very basic, and will probably not suffice except for very simple models
        return $result;
    }
}
