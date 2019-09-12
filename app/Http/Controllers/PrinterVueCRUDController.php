<?php

namespace App\Http\Controllers;

use App\Formdatabuilders\PrinterVueCRUDFormdatabuilder;
use App\Http\Requests\SavePrinterVueCRUDRequest;
use App\Dataproviders\PrinterVueCRUDDataprovider;
use App\Photo;
use Datalytix\VueCRUD\Interfaces\ICRUDController;
use App\Printer;
use Datalytix\VueCRUD\Controllers\VueCRUDControllerBase;

class PrinterVueCRUDController extends VueCRUDControllerBase implements ICRUDController
{
    const SUBJECT_CLASS = Printer::class;
    const SUBJECT_SLUG = 'printer';
    const SUBJECT_NAME = 'Printer';
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
        $new_path = Printer::moveFileToStorage($path, self::cleanRandomizationStringFromUploadFilename(basename($path)));
        return Photo::createFromFilepath($new_path);
    }

    public function store(SavePrinterVueCRUDRequest $request)
    {
        $subject = $request->save();
        $this->setSuccessfulAddPopupMessageInSession();

        return $this->getModificationResponse($subject);
    }

    public function update(SavePrinterVueCRUDRequest $request, Printer $subject)
    {
        $request->save($subject);
        $this->setSuccessfulModificationPopupMessageInSession();

        return $this->getModificationResponse($subject);
    }

    function getElements()
    {
        // returns the result of the getElementsAndCounts method
        // of the related VueCRUDDataprovider class

        $provider = new PrinterVueCRUDDataprovider();

        return $provider->getElementsAndCounts();
    }

}
