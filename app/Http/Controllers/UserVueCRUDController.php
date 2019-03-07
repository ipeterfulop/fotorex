<?php

namespace App\Http\Controllers;

use App\Formdatabuilders\UserVueCRUDFormdatabuilder;
use App\Http\Requests\SaveUserVueCRUDRequest;
use App\Dataproviders\UserVueCRUDDataprovider;
use Datalytix\VueCRUD\Interfaces\ICRUDController;
use App\User;
use Datalytix\VueCRUD\Controllers\VueCRUDControllerBase;

class UserVueCRUDController extends VueCRUDControllerBase implements ICRUDController
{
    const SUBJECT_CLASS = User::class;
    const SUBJECT_SLUG = 'user';
    const SUBJECT_NAME = 'User';


    public function store(SaveUserVueCRUDRequest $request)
    {
        $request->save();
        $this->setSuccessfulAddPopupMessageInSession();

        return route($this->getRouteName('index'));
    }

    public function update(SaveUserVueCRUDRequest $request, User $subject)
    {
        $request->save($subject);
        $this->setSuccessfulModificationPopupMessageInSession();

        return route($this->getRouteName('index'));
    }

    function getElements()
    {
        // returns the result of the getElementsAndCounts method
        // of the related VueCRUDDataprovider class

        $provider = new UserVueCRUDDataprovider();

        return $provider->getElementsAndCounts();
    }

}
