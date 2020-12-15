<?php


namespace App\Formdatabuilders;


use App\Article;
use App\Highlightedbox;
use App\Printer;
use App\PrinterRentaloption;
use App\Rules\HighlightedboxHasLink;
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
            ->setRules(['max:100'])
            ->setMessages(['max' => 'Nem lehet 100 karakternél hosszabb'])
            ->setLabel('Alcím (max. 50 karakter)')
            ->setMandatory(false);
        $result['printer_id'] = (new SearchableSelectVueCRUDFormfield())
            ->setLabel('Termék')
            ->setProps(['undefinedLabel' => 'Nem adott', 'undefinedValue' => -1])
            ->setRules([new HighlightedboxHasLink()])
            ->setValuesetClass(Printer::class)
            ->setContainerClass('col-12')
            ->setValuesetSortedGetter('getForSearchableSelect');
        $result['printer_rentaloption_id'] = (new SearchableSelectVueCRUDFormfield())
            ->setLabel('Bérelhető nyomtató')
            ->setProps(['undefinedLabel' => 'Nem adott', 'undefinedValue' => -1])
            ->setRules([new HighlightedboxHasLink()])
            ->setValuesetClass(PrinterRentaloption::class)
            ->setContainerClass('col-12')
            ->setValuesetSortedGetter('getForSearchableSelect');
        $result['article_id'] = (new SearchableSelectVueCRUDFormfield())
            ->setLabel('Cikk')
            ->setProps(['undefinedLabel' => 'Nem adott', 'undefinedValue' => -1])
            ->setRules([new HighlightedboxHasLink()])
            ->setValuesetClass(Article::class)
            ->setContainerClass('col-12')
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

    public function get_printer_id_value()
    {
        if ($this->subject == null) {
            return -1;
        }
        return $this->subject->printer_id ?? -1;
    }

    public function get_printer_rentaloption_id_value()
    {
        if ($this->subject == null) {
            return -1;
        }
        return $this->subject->printer_rentaloption_id ?? -1;
    }

    public function get_article_id_value()
    {
        if ($this->subject == null) {
            return -1;
        }
        return $this->subject->article_id ?? -1;
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