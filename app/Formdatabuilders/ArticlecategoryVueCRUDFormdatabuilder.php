<?php


namespace App\Formdatabuilders;


use App\Articlecategory;
use Datalytix\VueCRUD\Formdatabuilders\Formfieldtypes\ImageLibraryVueCRUDFormfield;
use Datalytix\VueCRUD\Formdatabuilders\VueCRUDFormdatabuilder;

class ArticlecategoryVueCRUDFormdatabuilder extends VueCRUDFormdatabuilder
{
    /**
     * @return Illuminate\Support\Collection;
     * returns a collection of VueCRUDFormfield descendants that
     * define what the edit/create forms will contain
     */
    protected static function getFields()
    {
        $result = [];
        $result['photo'] = (new ImageLibraryVueCRUDFormfield())
            ->setLabel('Kép')
            ->setContainerClass('col-12')
            ->addRoutes(Articlecategory::SUBJECT_SLUG)
            ->addAcceptCondition(ImageLibraryVueCRUDFormfield::ACCEPTS_PRESET_IMAGE);

        return collect($result);

    }

    public function __construct(Articlecategory $subject = null, $defaults = [])
    {
        $this->subject = $subject;
        $this->defaults = $defaults;
    }

    public function get_photo_value()
    {
        if (($this->subject === null) || ($this->subject->photo_id == null)) {
            return [];
        }
        return [
            ['id' => $this->subject->photo_id, 'url' => $this->subject->image_url,]
        ];
    }

}