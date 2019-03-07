<?php


namespace App\Formdatabuilders;


use App\Article;
use Datalytix\VueCRUD\Formdatabuilders\Formfieldtypes\DateTimepickerVueCRUDFormfield;
use Datalytix\VueCRUD\Formdatabuilders\Formfieldtypes\RichtextTrixVueCRUDFormfield;
use Datalytix\VueCRUD\Formdatabuilders\Formfieldtypes\TextVueCRUDFormfield;
use Datalytix\VueCRUD\Formdatabuilders\VueCRUDFormdatabuilder;

class ArticleVueCRUDFormdatabuilder extends VueCRUDFormdatabuilder
{
    /**
     * @return Illuminate\Support\Collection;
     * returns a collection of VueCRUDFormfield descendants that
     * define what the edit/create forms will contain
     */
    protected static function getFields()
    {
        $result = [];
        $result['slug'] = (new TextVueCRUDFormfield())->setMandatory(true)
            ->setLabel('URL')
            ->setProperty('slug')
            ->setContainerClass('col-6');
        $result['published_at'] = (new DateTimepickerVueCRUDFormfield())->setMandatory(true)
            ->setLabel('Publikálás dátuma')
            ->setProperty('published_at')
            ->setContainerClass('col-6');
        $result['title'] = (new TextVueCRUDFormfield())->setMandatory(true)
            ->setLabel('Cím')
            ->setProperty('title')
            ->setContainerClass('col-12');
        $result['content'] = (new RichtextTrixVueCRUDFormfield())->setMandatory(true)
            ->setLabel('Tartalom')
            ->setProperty('content')
            ->setContainerClass('col-12');

        return collect($result);
    }

    public function __construct(Article $subject = null, $defaults = [])
    {
        $this->subject = $subject;
        $this->defaults = $defaults;
    }


    public function get_published_at_value()
    {
        if ($this->subject == null) {
            return now();
        } else {
            return $this->subject->published_at->format('Y-m-d H:i:s');
        }
    }

}