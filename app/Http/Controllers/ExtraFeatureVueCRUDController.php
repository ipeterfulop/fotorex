<?php

namespace App\Http\Controllers;

use App\Formdatabuilders\ExtraFeatureVueCRUDFormdatabuilder;
use App\Http\Requests\SaveExtraFeatureVueCRUDRequest;
use App\Dataproviders\ExtraFeatureVueCRUDDataprovider;
use App\Photo;
use Datalytix\VueCRUD\Interfaces\ICRUDController;
use App\ExtraFeature;
use Datalytix\VueCRUD\Controllers\VueCRUDControllerBase;

class ExtraFeatureVueCRUDController extends VueCRUDControllerBase implements ICRUDController
{
    const SUBJECT_CLASS = ExtraFeature::class;
    const SUBJECT_SLUG = 'extrafeature';
    const SUBJECT_NAME = 'ExtraFeature';
    // an optional constant to allow for using other views
    // the views still have to have the model-manager component
    // (included or copied from the model-manager-inner view)
    // just like in vendor.vue-crud.model-manager, but this way a package
    // update & publish won't overwrite customizations
    //
    // an app-wide default can also be set in config.vuecrud.vueCrudDefaultView
    //const CUSTOM_VIEW_PATH = 'blade.view.path'

    public function processUploadedFileToObject($path)
    {
        $new_path = ExtraFeature::moveFileToStorage($path, self::cleanRandomizationStringFromUploadFilename(basename($path)));
        return Photo::createFromFilepath($new_path);
    }

    public function store(SaveExtraFeatureVueCRUDRequest $request)
    {
        $subject = $request->save();
        $this->setSuccessfulAddPopupMessageInSession();

        return $this->getModificationResponse($subject);
    }

    public function update(SaveExtraFeatureVueCRUDRequest $request, ExtraFeature $subject)
    {
        $request->save($subject);
        $this->setSuccessfulModificationPopupMessageInSession();

        return $this->getModificationResponse($subject);
    }

    function getElements()
    {
        // returns the result of the getElementsAndCounts method
        // of the related VueCRUDDataprovider class

        $provider = new ExtraFeatureVueCRUDDataprovider();

        return $provider->getElementsAndCounts();
    }

}
