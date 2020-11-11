<?php


namespace App\Formdatabuilders;


use App\Article;
use App\Highlightedbox;
use App\Printer;
use Datalytix\VueCRUD\Formdatabuilders\Formfieldtypes\ImageLibraryVueCRUDFormfield;
use Datalytix\VueCRUD\Formdatabuilders\Formfieldtypes\ImagePickerVueCRUDFormfield;
use Datalytix\VueCRUD\Formdatabuilders\Formfieldtypes\SearchableSelectVueCRUDFormfield;
use Datalytix\VueCRUD\Formdatabuilders\Formfieldtypes\TextVueCRUDFormfield;
use Datalytix\VueCRUD\Formdatabuilders\VueCRUDFormdatabuilder;

class HighlightedboxVueCRUDFormdatabuilder extends VueCRUDFormdatabuilder
{
    /**
     * @return Illuminate\Support\Collection;
     * returns a collection of VueCRUDFormfield descendants that
     * define what the edit/create forms will contain
     */
    protected static function getFields()
    {
        $result = [];
        $result['title'] = (new TextVueCRUDFormfield())
            ->setContainerClass('col-12')
            ->setRules(['max:100'])
            ->setMessages(['max' => 'Nem lehet 100 karakternél hosszabb'])
            ->setLabel('Cím (max. 100 karakter)')
            ->setMandatory(true);
        $result['subtitle'] = (new TextVueCRUDFormfield())
            ->setContainerClass('col-12')
            ->setRules(['max:50'])
            ->setMessages(['max' => 'Nem lehet 50 karakternél hosszabb'])
            ->setLabel('Alcím (max. 50 karakter)')
            ->setMandatory(true);
        $result['printer_id'] = (new SearchableSelectVueCRUDFormfield())
            ->setLabel('Termék')
            ->setRules(['required_without:article_id'])
            ->setValuesetClass(Printer::class)
            ->setValuesetSortedGetter('getForSearchableSelect');
        $result['article_id'] = (new SearchableSelectVueCRUDFormfield())
            ->setLabel('Cikk')
            ->setRules(['required_without:printer_id'])
            ->setValuesetClass(Article::class)
            ->setValuesetSortedGetter('getForSearchableSelect');
        $result['photo'] = (new ImageLibraryVueCRUDFormfield())
            ->setLabel('Kép')
            ->setContainerClass('col-12')
            ->addRoutes(Highlightedbox::SUBJECT_SLUG)
            ->addAcceptCondition(ImageLibraryVueCRUDFormfield::ACCEPTS_PRESET_IMAGE);

        return collect($result);
    }

    public function __construct(Highlightedbox $subject = null, $defaults = [])
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