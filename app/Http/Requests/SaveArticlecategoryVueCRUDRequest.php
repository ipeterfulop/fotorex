<?php

namespace App\Http\Requests;

use App\Formdatabuilders\ArticlecategoryVueCRUDFormdatabuilder;
use App\Articlecategory;
use App\Highlightedbox;
use App\Photo;
use Datalytix\VueCRUD\Requests\VueCRUDRequestBase;

class SaveArticlecategoryVueCRUDRequest extends VueCRUDRequestBase
{
    const FORMDATABUILDER_CLASS = ArticlecategoryVueCRUDFormdatabuilder::class;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function save(Articlecategory $subject = null)
    {
        // a very basic create/update method, you should probably replace it
        // with something customized
//        if ($subject == null) {
//            $subject = Articlecategory::create($this->getDataset());
//        } else {
//            $subject->update($this->getDataset());
//        }
        $this->handlePhotos($subject);

        return $subject;
    }

    protected function handlePhotos($subject)
    {
        if (count($this->input('photo')) == 0) {
            $subject->update(['photo_id' => null]);
            return;
        }
        if ((count($this->input('photo')) > 0) && ($this->input('photo')[0] != $subject->photo_id)) {
            \DB::transaction(function() use (&$subject) {
                $photo = Photo::find($this->input('photo')[0]);
                @mkdir(storage_path('app'.DIRECTORY_SEPARATOR.'public'.Articlecategory::IMAGES_PATH));
                $photo->file->move(storage_path('app'.DIRECTORY_SEPARATOR.'public'.Articlecategory::IMAGES_PATH));
                $subject->update([
                    'photo_id' => $this->input('photo')[0],
                ]);
            });
        }
    }

    public function getDataset()
    {
    }
}
