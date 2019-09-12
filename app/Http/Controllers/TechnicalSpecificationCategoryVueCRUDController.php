<?php

namespace App\Http\Controllers;

use App\Formdatabuilders\TechnicalSpecificationCategoryVueCRUDFormdatabuilder;
use App\Http\Requests\SaveTechnicalSpecificationCategoryVueCRUDRequest;
use App\Dataproviders\TechnicalSpecificationCategoryVueCRUDDataprovider;
use Datalytix\VueCRUD\Interfaces\ICRUDController;
use App\TechnicalSpecificationCategory;
use Datalytix\VueCRUD\Controllers\VueCRUDControllerBase;

class TechnicalSpecificationCategoryVueCRUDController extends VueCRUDControllerBase implements ICRUDController
{
    const SUBJECT_CLASS = TechnicalSpecificationCategory::class;
    const SUBJECT_SLUG = 'technicalspecificationcategory';
    const SUBJECT_NAME = 'TechnicalSpecificationCategory';
    // an optional constant to allow for using other views
    // the views still have to have the model-manager component
    // (included or copied from the model-manager-inner view)
    // just like in vendor.vue-crud.model-manager, but this way a package
    // update & publish won't overwrite customizations
    //
    // an app-wide default can also be set in config.vuecrud.vueCrudDefaultView
    //const CUSTOM_VIEW_PATH = 'blade.view.path'

    public function store(SaveTechnicalSpecificationCategoryVueCRUDRequest $request)
    {
        $subject = $request->save();
        $this->setSuccessfulAddPopupMessageInSession();

        return $this->getModificationResponse($subject);
    }

    public function update(SaveTechnicalSpecificationCategoryVueCRUDRequest $request, TechnicalSpecificationCategory $subject)
    {
        $request->save($subject);
        $this->setSuccessfulModificationPopupMessageInSession();

        return $this->getModificationResponse($subject);
    }

    function getElements()
    {
        // returns the result of the getElementsAndCounts method
        // of the related VueCRUDDataprovider class

        $provider = new TechnicalSpecificationCategoryVueCRUDDataprovider();

        return $provider->getElementsAndCounts();
    }

}
