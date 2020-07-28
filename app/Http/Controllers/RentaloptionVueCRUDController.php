<?php

namespace App\Http\Controllers;

use App\Formdatabuilders\RentaloptionVueCRUDFormdatabuilder;
use App\Http\Requests\SaveRentaloptionVueCRUDRequest;
use App\Dataproviders\RentaloptionVueCRUDDataprovider;
use Datalytix\VueCRUD\Interfaces\ICRUDController;
use App\Rentaloption;
use Datalytix\VueCRUD\Controllers\VueCRUDControllerBase;

class RentaloptionVueCRUDController extends VueCRUDControllerBase implements ICRUDController
{
    const SUBJECT_CLASS = Rentaloption::class;
    const SUBJECT_SLUG = 'rentaloption';
    const SUBJECT_NAME = 'Rentaloption';
    // an optional constant to allow for using other views
    // the views still have to have the model-manager component
    // (included or copied from the model-manager-inner view)
    // just like in vendor.vue-crud.model-manager, but this way a package
    // update & publish won't overwrite customizations
    //
    // an app-wide default can also be set in config.vuecrud.vueCrudDefaultView
    //const CUSTOM_VIEW_PATH = 'blade.view.path'

    public function store(SaveRentaloptionVueCRUDRequest $request)
    {
        $subject = $request->save();
        $this->setSuccessfulAddPopupMessageInSession();

        return $this->getModificationResponse($subject);
    }

    public function update(SaveRentaloptionVueCRUDRequest $request, Rentaloption $subject)
    {
        $request->save($subject);
        $this->setSuccessfulModificationPopupMessageInSession();

        return $this->getModificationResponse($subject);
    }

    function getElements()
    {
        // returns the result of the getElementsAndCounts method
        // of the related VueCRUDDataprovider class

        $provider = new RentaloptionVueCRUDDataprovider();

        return $provider->getElementsAndCounts();
    }

}
