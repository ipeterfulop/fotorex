<?php


namespace App\Formdatabuilders;


use App\Articlecategory;
use App\Helpers\ColorTechnology;
use App\Helpers\DeviceFunctionality;
use App\Manufacturer;
use App\Photo;
use App\Printer;
use App\PrinterPhotoRole;
use App\PrinterTechnicalSpecificationCategory;
use App\TechnicalSpecificationCategory;
use Datalytix\VueCRUD\Formdatabuilders\Formfieldtypes\FileCollectorVueCRUDFormfield;
use Datalytix\VueCRUD\Formdatabuilders\Formfieldtypes\ImageLibraryVueCRUDFormfield;
use Datalytix\VueCRUD\Formdatabuilders\Formfieldtypes\RichtextTrixVueCRUDFormfield;
use Datalytix\VueCRUD\Formdatabuilders\Formfieldtypes\RichttextQuillVueCRUDFormfield;
use Datalytix\VueCRUD\Formdatabuilders\Formfieldtypes\SelectVueCRUDFormfield;
use Datalytix\VueCRUD\Formdatabuilders\Formfieldtypes\SlugVueCRUDFormfield;
use Datalytix\VueCRUD\Formdatabuilders\Formfieldtypes\TextareaVueCRUDFormfield;
use Datalytix\VueCRUD\Formdatabuilders\Formfieldtypes\TextVueCRUDFormfield;
use Datalytix\VueCRUD\Formdatabuilders\Formfieldtypes\YesNoSelectVueCRUDFormfield;
use Datalytix\VueCRUD\Formdatabuilders\VueCRUDFormdatabuilder;

class PrinterVueCRUDFormdatabuilder extends VueCRUDFormdatabuilder
{
    /**
     * @return Illuminate\Support\Collection;
     * returns a collection of VueCRUDFormfield descendants that
     * define what the edit/create forms will contain
     */
    protected static function getFields()
    {
        $result = [];
        $result['name'] = (new TextVueCRUDFormfield())
            ->setMandatory(true)
            ->setLabel('Név')
            ->setContainerClass('col-6');
        $result['manufacturer_id'] = (new SelectVueCRUDFormfield())
            ->setMandatory(true)
            ->setLabel('Gyártó')
            ->setAddChooseMessage(true)
            ->setValuesetClass(Manufacturer::class)
            ->setDefault(0)
            ->setContainerClass('col-6');
        $result['model_number'] = (new TextVueCRUDFormfield())
            ->setMandatory(true)
            ->setLabel('Modellszám')
            ->setContainerClass('col-6');
        $result['model_number_displayed'] = (new TextVueCRUDFormfield())
            ->setMandatory(true)
            ->setLabel('Modellszám (megjelenítéshez)')
            ->setContainerClass('col-6');
        $result['is_enabled'] = (new YesNoSelectVueCRUDFormfield())->setMandatory(true)
            ->setLabel('Aktív')
            ->setDefault(0)
            ->setContainerClass('col-3');
        $result['request_for_price'] = (new YesNoSelectVueCRUDFormfield())->setMandatory(true)
            ->setLabel('Árhoz hívjon')
            ->setDefault(0)
            ->setContainerClass('col-3');
        $result['price'] = (new TextVueCRUDFormfield())
            ->setLabel('Ár')
            ->setRules(['required_if:request_for_price,0'])
            ->setDefault(0)
            ->setContainerClass('col-3');
        $result['price_discounted'] = (new TextVueCRUDFormfield())
            ->setLabel('Ár (kedvezményes)')
            ->setContainerClass('col-3');
        $result['popularity_index'] = (new TextVueCRUDFormfield())
            ->setContainerClass('col-4')
            ->setLabel('Népszerűségi index')
            ->setRules(['numeric']);
        $result['description'] = (new RichttextQuillVueCRUDFormfield())->setMandatory(true)
            ->setLabel('Leírás')
            ->setProperty('content')
            ->setContainerClass('col-12');
//        $result['slug'] = (new SlugVueCRUDFormfield())->setMandatory(true)
//            ->setLabel('URL')
//            ->setProperty('slug')
//            ->addSourceFieldName('manufacturer_id')
//            ->addSourceFieldName('model_number_displayed')
//            ->addSourceFieldName('name')
//            ->setContainerClass('col-6')
//            ->setRules(['unique:printers', 'regex:/^[A-Za-z0-9\-\_]*$/miu'])
//            ->setMessages([
//                'unique' => 'Ez az URL már foglalt',
//                'regex' => 'Az URL csak ékezet nélküli betűket, számokat, kötőjelet és alávonást tartalmazhat'
//            ]);
        $result['html_page_title'] = (new TextVueCRUDFormfield())
            ->setMandatory(true)
            ->setLabel('Oldalcím')
            ->setContainerClass('col-8');
        $result['html_page_meta_description'] = (new TextAreaVueCRUDFormfield())
            ->setMandatory(true)
            ->setLabel('Meta')
            ->setContainerClass('col-12');
        $result['photo'] = (new ImageLibraryVueCRUDFormfield())
            ->setLabel('Képek')
            ->setContainerClass('col-12')
            ->addAcceptCondition(ImageLibraryVueCRUDFormfield::ACCEPTS_PRESET_IMAGE)
            ->addRoutes('printer')
            ->setLimit(22);

        return collect($result);
    }

    public function get_photo_value()
    {
        if ($this->subject === null) {
            return [];
        }
        else {
            return $this->subject->getCustomizedPhotosForRole(PrinterPhotoRole::whereName('original')->first())->transform(function($cpp) {
                return [
                    'id' => $cpp->photo_id,
                    'url' => $cpp->getUrl()
                ];
            })->values()->all();
        }
    }

    public function getFormfieldValue($fieldId) {
        $tsc_ids = [];
        foreach (TechnicalSpecificationCategory::where('is_enabled', '=', 1)->get()->pluck('id')->all() as $tsc_id) {
            $tsc_ids[] = 'tsc_'.$tsc_id;
            if ($this->subject===null) {
                return null;
            }
            else {
                if ($fieldId === 'tsc_'.$tsc_id) {
                    return PrinterTechnicalSpecificationCategory::where([['printer_id', '=', $this->subject->id], ['technical_specification_category_id', '=', $tsc_id]])->get()->pluck('html_content')->first();
                }
            }
        }
        if (array_search($fieldId, $tsc_ids) === false) {
            return false;
        }
    }

    public function __construct(Printer $subject = null, $defaults = [])
    {
        $this->subject = $subject;
        $this->defaults = $defaults;
    }
}
