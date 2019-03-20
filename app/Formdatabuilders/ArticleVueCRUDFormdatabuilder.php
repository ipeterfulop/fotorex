<?php


namespace App\Formdatabuilders;


use App\Article;
use App\Articlecategory;
use Datalytix\VueCRUD\Formdatabuilders\Formfieldtypes\DateTimepickerVueCRUDFormfield;
use Datalytix\VueCRUD\Formdatabuilders\Formfieldtypes\ImagePickerVueCRUDFormfield;
use Datalytix\VueCRUD\Formdatabuilders\Formfieldtypes\RichtextTrixVueCRUDFormfield;
use Datalytix\VueCRUD\Formdatabuilders\Formfieldtypes\SelectVueCRUDFormfield;
use Datalytix\VueCRUD\Formdatabuilders\Formfieldtypes\SlugVueCRUDFormfield;
use Datalytix\VueCRUD\Formdatabuilders\Formfieldtypes\TextVueCRUDFormfield;
use Datalytix\VueCRUD\Formdatabuilders\Formfieldtypes\YesNoSelectVueCRUDFormfield;
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
        $result['articlecategory_id'] = (new SelectVueCRUDFormfield())
            ->setLabel('Kategória')
            ->setAddChooseMessage(false)
            ->setValuesetClass(Articlecategory::class)
            ->setDefault(0);
        $result['slug'] = (new SlugVueCRUDFormfield())->setMandatory(true)
            ->setLabel('URL')
            ->setProperty('slug')
            ->addSourceFieldName('title')
            ->setContainerClass('col-6')
            ->setRules(['unique:articles', 'regex:/^[A-Za-z0-9\-\_]*$/miu'])
            ->setMessages([
                'unique' => 'Ez az URL már foglalt',
                'regex' => 'Az URL csak ékezet nélküli betűket, számokat, kötőjelet és alávonást tartalmazhat'
            ]);
        $result['published_at'] = (new DateTimepickerVueCRUDFormfield())->setMandatory(true)
            ->setLabel('Publikálás dátuma')
            ->setProperty('published_at')
            ->setContainerClass('col-6');
        $result['title'] = (new TextVueCRUDFormfield())->setMandatory(true)
            ->setLabel('Cím')
            ->setProperty('title')
            ->setContainerClass('col-10');
        $result['is_published'] = (new YesNoSelectVueCRUDFormfield())->setMandatory(true)
            ->setLabel('Publikus')
            ->setProperty('is_published')
            ->setDefault(0)
            ->setContainerClass('col-2');

        $result['summary'] = (new RichtextTrixVueCRUDFormfield())->setMandatory(true)
            ->setLabel('Összefoglaló')
            ->setProperty('summary')
            ->setProps([
                'allowTableOperations' => 'false',
                'allowPreview' => 'false',
            ])
            ->setContainerClass('col-12');
        $result['content'] = (new RichtextTrixVueCRUDFormfield())->setMandatory(true)
            ->setLabel('Tartalom')
            ->setProperty('content')
            ->setProps([
                'allowTableOperations' => 'true',
                'allowPreview' => 'true',
            ])
            ->setContainerClass('col-12');
        $result['index_image'] = (new ImagePickerVueCRUDFormfield())
            ->setLabel('Indexkép')
            ->setProperty('index_image')
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