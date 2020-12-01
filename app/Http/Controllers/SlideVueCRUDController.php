<?php

namespace App\Http\Controllers;

use App\Formdatabuilders\SlideVueCRUDFormdatabuilder;
use App\Http\Requests\SaveSlideVueCRUDRequest;
use App\Dataproviders\SlideVueCRUDDataprovider;
use Datalytix\VueCRUD\Interfaces\ICRUDController;
use App\Slide;
use Datalytix\VueCRUD\Controllers\VueCRUDControllerBase;

class SlideVueCRUDController extends VueCRUDControllerBase implements ICRUDController
{
    const SUBJECT_CLASS = Slide::class;
    const SUBJECT_SLUG = 'slide';
    const SUBJECT_NAME = 'Slide';
    // an optional constant to allow for using other views
    // the views still have to have the model-manager component
    // (included or copied from the model-manager-inner view)
    // just like in vendor.vue-crud.model-manager, but this way a package
    // update & publish won't overwrite customizations
    //
    // an app-wide default can also be set in config.vuecrud.vueCrudDefaultView
    //const CUSTOM_VIEW_PATH = 'blade.view.path'

    public function store(SaveSlideVueCRUDRequest $request)
    {
        $subject = $request->save();
        $this->setSuccessfulAddPopupMessageInSession();

        return $this->getModificationResponse($subject);
    }

    public function update(SaveSlideVueCRUDRequest $request, Slide $subject)
    {
        $request->save($subject);
        $this->setSuccessfulModificationPopupMessageInSession();

        return $this->getModificationResponse($subject);
    }

    function getElements()
    {
        // returns the result of the getElementsAndCounts method
        // of the related VueCRUDDataprovider class

        $provider = new SlideVueCRUDDataprovider();

        return $provider->getElementsAndCounts();
    }

    public function storePublicPicture()
    {
        return $this->storePublicAttachment();
    }

    public function removePublicPicture()
    {
        return $this->removePublicAttachment();
    }

}
