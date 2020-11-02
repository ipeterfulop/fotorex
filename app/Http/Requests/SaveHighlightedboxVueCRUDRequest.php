<?php

namespace App\Http\Requests;

use App\Formdatabuilders\HighlightedboxVueCRUDFormdatabuilder;
use App\Highlightedbox;
use App\Photo;
use Datalytix\VueCRUD\Requests\VueCRUDRequestBase;

class SaveHighlightedboxVueCRUDRequest extends VueCRUDRequestBase
{
    const FORMDATABUILDER_CLASS = HighlightedboxVueCRUDFormdatabuilder::class;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function save(Highlightedbox $subject = null)
    {
        \DB::transaction(function() use (&$subject) {
            $dataset = $this->getDataset();
            if ($subject == null) {
                $dataset['position'] = Highlightedbox::getFirstAvailablePosition([]);
                $subject = Highlightedbox::create($dataset);
            } else {
                $subject->update($dataset);
            }
            $this->handlePhotos($subject);
        });

        return $subject;
    }

    protected function handlePhotos($subject)
    {
        if (count($this->input('photo')) == 0) {
            $subject->update(['photo_id' => null, 'custom_photo_id' => null]);
            return;
        }
        if ((count($this->input('photo')) > 0) && ($this->input('photo')[0] != $subject->photo_id)) {
            \DB::transaction(function() use (&$subject) {
                $photo = Photo::find($this->input('photo'));
                $photo->file->move(storage_path('app'.DIRECTORY_SEPARATOR.'public'.Highlightedbox::IMAGES_PATH));
                $subject->update([
                    'photo_id' => $this->input('photo')[0],
                    //TODO: photo customization
                    'custom_photo_id' => $this->input('photo')[0],
                ]);
            });
        }
    }

    public function getDataset()
    {
        $result = [
            'title' => $this->input('title'),
            'subtitle' => $this->input('subtitle'),
            'printer_id' => $this->input('printer_id'),
            'article_id' => $this->input('article_id'),
        ];

        return $result;
    }
}
