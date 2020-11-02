<?php

namespace App\Http\Controllers;

use App\Formdatabuilders\HighlightedboxVueCRUDFormdatabuilder;
use App\Http\Requests\SaveHighlightedboxVueCRUDRequest;
use App\Dataproviders\HighlightedboxVueCRUDDataprovider;
use App\Photo;
use Datalytix\VueCRUD\Interfaces\ICRUDController;
use App\Highlightedbox;
use Datalytix\VueCRUD\Controllers\VueCRUDControllerBase;

class HighlightedboxVueCRUDController extends VueCRUDControllerBase implements ICRUDController
{
    const SUBJECT_CLASS = Highlightedbox::class;
    const SUBJECT_SLUG = 'highlightedbox';
    const SUBJECT_NAME = 'Highlightedbox';
    // an optional constant to allow for using other views
    // the views still have to have the model-manager component
    // (included or copied from the model-manager-inner view)
    // just like in vendor.vue-crud.model-manager, but this way a package
    // update & publish won't overwrite customizations
    //
    // an app-wide default can also be set in config.vuecrud.vueCrudDefaultView
    //const CUSTOM_VIEW_PATH = 'blade.view.path'

    public function store(SaveHighlightedboxVueCRUDRequest $request)
    {
        $subject = $request->save();
        $this->setSuccessfulAddPopupMessageInSession();

        return $this->getModificationResponse($subject);
    }

    public function update(SaveHighlightedboxVueCRUDRequest $request, Highlightedbox $subject)
    {
        $request->save($subject);
        $this->setSuccessfulModificationPopupMessageInSession();

        return $this->getModificationResponse($subject);
    }

    function getElements()
    {
        // returns the result of the getElementsAndCounts method
        // of the related VueCRUDDataprovider class

        $provider = new HighlightedboxVueCRUDDataprovider();

        return $provider->getElementsAndCounts();
    }

    public function storePublicPicture()
    {
        //create photo from file in attachments
        $processedFilename = $this->saveUploadedFileToPublic();
        $photo = Photo::createFromFilepath(storage_path('app'.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.$processedFilename));

        return response()->json([
            'image' => [
                'id' => $photo->id,
                'url' => asset('storage'
                    .DIRECTORY_SEPARATOR
                    .'attachments'
                    .DIRECTORY_SEPARATOR
                    .basename($processedFilename))
            ]
        ]);
    }

}
