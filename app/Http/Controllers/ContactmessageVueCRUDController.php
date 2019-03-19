<?php

namespace App\Http\Controllers;

use App\Formdatabuilders\ContactmessageVueCRUDFormdatabuilder;
use App\Http\Requests\SaveContactmessageVueCRUDRequest;
use App\Dataproviders\ContactmessageVueCRUDDataprovider;
use Datalytix\VueCRUD\Interfaces\ICRUDController;
use App\Contactmessage;
use Datalytix\VueCRUD\Controllers\VueCRUDControllerBase;

class ContactmessageVueCRUDController extends VueCRUDControllerBase implements ICRUDController
{
    const SUBJECT_CLASS = Contactmessage::class;
    const SUBJECT_SLUG = 'contactmessage';
    const SUBJECT_NAME = 'Contactmessage';
    // an optional constant to allow for using other views
    // the views still have to have the model-manager component
    // (included or copied from the model-manager-inner view)
    // just like in vendor.vue-crud.model-manager, but this way a package
    // update & publish won't overwrite customizations
    //
    // an app-wide default can also be set in config.app.vueCrudDefaultView
    //const CUSTOM_VIEW_PATH = 'blade.view.path'

    public function store(SaveContactmessageVueCRUDRequest $request)
    {
        $request->save();
        $this->setSuccessfulAddPopupMessageInSession();

        return route($this->getRouteName('index'));
    }

    public function update(SaveContactmessageVueCRUDRequest $request, Contactmessage $subject)
    {
        $request->save($subject);
        $this->setSuccessfulModificationPopupMessageInSession();

        return route($this->getRouteName('index'));
    }

    function getElements()
    {
        // returns the result of the getElementsAndCounts method
        // of the related VueCRUDDataprovider class

        $provider = new ContactmessageVueCRUDDataprovider();

        return $provider->getElementsAndCounts();
    }
}
