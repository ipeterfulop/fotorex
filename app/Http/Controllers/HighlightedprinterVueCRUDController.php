<?php

namespace App\Http\Controllers;

use App\Formdatabuilders\HighlightedprinterVueCRUDFormdatabuilder;
use App\Http\Requests\SaveHighlightedprinterVueCRUDRequest;
use App\Dataproviders\HighlightedprinterVueCRUDDataprovider;
use Datalytix\VueCRUD\Interfaces\ICRUDController;
use App\Highlightedprinter;
use Datalytix\VueCRUD\Controllers\VueCRUDControllerBase;

class HighlightedprinterVueCRUDController extends VueCRUDControllerBase implements ICRUDController
{
    const SUBJECT_CLASS = Highlightedprinter::class;
    const SUBJECT_SLUG = 'highlightedprinter';
    const SUBJECT_NAME = 'Highlightedprinter';
    // an optional constant to allow for using other views
    // the views still have to have the model-manager component
    // (included or copied from the model-manager-inner view)
    // just like in vendor.vue-crud.model-manager, but this way a package
    // update & publish won't overwrite customizations
    //
    // an app-wide default can also be set in config.vuecrud.vueCrudDefaultView
    //const CUSTOM_VIEW_PATH = 'blade.view.path'

    public function store(SaveHighlightedprinterVueCRUDRequest $request)
    {
        $subject = $request->save();
        $this->setSuccessfulAddPopupMessageInSession();

        return $this->getModificationResponse($subject);
    }

    public function update(SaveHighlightedprinterVueCRUDRequest $request, Highlightedprinter $subject)
    {
        $request->save($subject);
        $this->setSuccessfulModificationPopupMessageInSession();

        return $this->getModificationResponse($subject);
    }

    function getElements()
    {
        // returns the result of the getElementsAndCounts method
        // of the related VueCRUDDataprovider class

        $provider = new HighlightedprinterVueCRUDDataprovider();

        return $provider->getElementsAndCounts();
    }

}
