<?php


namespace App\Formdatabuilders;


use App\Article;
use App\Helpers\LinkTarget;
use App\Slide;
use App\Slider;
use Datalytix\VueCRUD\Formdatabuilders\Formfieldtypes\ImagePickerVueCRUDFormfield;
use Datalytix\VueCRUD\Formdatabuilders\Formfieldtypes\SearchableSelectVueCRUDFormfield;
use Datalytix\VueCRUD\Formdatabuilders\Formfieldtypes\SelectVueCRUDFormfield;
use Datalytix\VueCRUD\Formdatabuilders\Formfieldtypes\StaticVueCRUDFormfield;
use Datalytix\VueCRUD\Formdatabuilders\Formfieldtypes\TextVueCRUDFormfield;
use Datalytix\VueCRUD\Formdatabuilders\VueCRUDFormdatabuilder;

class SlideVueCRUDFormdatabuilder extends VueCRUDFormdatabuilder
{
    /**
     * @return Illuminate\Support\Collection;
     * returns a collection of VueCRUDFormfield descendants that
     * define what the edit/create forms will contain
     */
    protected static function getFields()
    {
        $result = [];
        if (request()->has('slider_id')) {
            $result['slider_id'] = (new StaticVueCRUDFormfield())
                ->setDefault(request()->get('slider_id'))
                ->setStaticValue('')
                ->setContainerClass('col-12 hidden');
        } else {
            $result['slider_id'] = (new SelectVueCRUDFormfield())
                ->setLabel('Slider')
                ->setMandatory(true)
                ->setContainerClass('col-12')
                ->setValuesetClass(Slider::class);
        }
        $result['article_slug'] = (new SearchableSelectVueCRUDFormfield())
            ->setLabel('Cikk')
            ->setContainerClass('col-12')
            ->setValuesetClass(Article::class)
            ->setValuesetSortedGetter('getNewsForSlideSelect')
            ->setProps(['undefinedLabel' => 'Nem adott'])
            ->setMandatory(false);
        $result['url'] = (new TextVueCRUDFormfield())
            ->setLabel('URL')
            ->setContainerClass('col-12')
            ->setRules(['required_if:article_slug,-1']);
        $result['open_in'] = (new SelectVueCRUDFormfield())
            ->setLabel('Megnyitás...')
            ->setContainerClass('col-12')
            ->setValuesetClass(LinkTarget::class)
            ->setDefault(LinkTarget::BLANK_ID);
        $result['image'] = (new ImagePickerVueCRUDFormfield())
            ->setContainerClass('col-12')
            ->setLabel('Kép (javasolt méret: 1080x370px)')
            ->setMandatory(true);

        return collect($result);
    }

    public function __construct(Slide $subject = null, $defaults = [])
    {
        $this->subject = $subject;
        $this->defaults = $defaults;
    }


    public function get_image_value()
    {
        return $this->subject == null
            ? ''
            : $this->subject->image_url;
    }

    public function get_article_slug_value()
    {
        return ($this->subject == null) || ($this->subject->article_slug == null)
            ? -1
            : $this->subject->article_slug;
    }

}