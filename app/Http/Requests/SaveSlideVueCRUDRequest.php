<?php

namespace App\Http\Requests;

use App\Article;
use App\Articlecategory;
use App\Formdatabuilders\SlideVueCRUDFormdatabuilder;
use App\Helpers\ImageManager;
use App\Slide;
use Datalytix\VueCRUD\Requests\VueCRUDRequestBase;

class SaveSlideVueCRUDRequest extends VueCRUDRequestBase
{
    const FORMDATABUILDER_CLASS = SlideVueCRUDFormdatabuilder::class;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function save(Slide $subject = null)
    {
        if ($subject == null) {
            $dataset = $this->getDataset();
            $dataset['image'] = '';
            $dataset['position'] = Slide::getFirstAvailablePosition(['slider_id' => $this->input('slider_id')]);
            $subject = Slide::create($dataset);
        } else {
            $subject->update($this->getDataset());
        }
        $this->handleImage($subject);
        return $subject;
    }


    public function handleImage($subject)
    {
        if (($subject != null) && (isset($this->input('image')[0])) && ($subject->image != basename($this->input('image')))) {
            @mkdir(public_path(Slide::PHOTO_URL_BASE));
            $extension = \Str::afterLast($this->input('image'), '.');
            $filename = public_path(Slide::PHOTO_URL_BASE).\Str::slug($subject->id.'-'.$subject->slider_id).\Str::random(6).'.'.$extension;
            rename(
                storage_path('/app/public/attachments/'.basename($this->input('image'))),
                $filename
            );
            $subject->update(['image' => basename($filename)]);
        }
    }


    public function getDataset()
    {
        $result = [
            'slider_id' => $this->input('slider_id'),
            'url' => $this->input('url'),
            'open_in' => $this->input('open_in'),
            'articlecategory_url_prefix' => Articlecategory::where('tag', '=', 'news')->first()->url_prefix,
            'article_slug' => $this->input('article_slug'),
        ];

        return $result;
    }
}
