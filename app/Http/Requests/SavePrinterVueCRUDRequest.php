<?php

namespace App\Http\Requests;

use App\CustomizedPrinterPhoto;
use App\Formdatabuilders\PrinterVueCRUDFormdatabuilder;
use App\Helpers\PrinterPhotoManager;
use App\Helpers\Productfamily;
use App\Manufacturer;
use App\Photo;
use App\Printer;
use App\PrinterPhoto;
use App\PrinterPhotoRole;
use App\TechnicalSpecificationCategory;
use App\Traits\ValidatesFloats;
use Datalytix\VueCRUD\Requests\VueCRUDRequestBase;

class SavePrinterVueCRUDRequest extends VueCRUDRequestBase
{
    const FORMDATABUILDER_CLASS = PrinterVueCRUDFormdatabuilder::class;
    const PRODUCTFAMILY = Productfamily::PRINTERS_ID;

    use ValidatesFloats;

    public function getFloatFields()
    {
        return ['popularity_index'];
    }


    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function save(Printer $subject = null)
    {
        \DB::transaction(function() use (&$subject) {
            $dataset = $this->getDataset();
            if ($subject == null) {
                $class = Productfamily::getProductfamilyClass(static::PRODUCTFAMILY);
                $dataset['slug'] = Printer::generateUniqueSlug(
                    $dataset['name'],
                    Manufacturer::find($dataset['manufacturer_id']),
                    $dataset['model_number']
                );
                $subject = $class::create($dataset);
            } else {
                $subject->update($dataset);
            }
            $this->handlePhotos($subject);
        });

        return $subject;
    }

    public function getDataset()
    {
        $result = [
            'productfamily' => static::PRODUCTFAMILY,
            'productsubfamily' => $this->input('productsubfamily'),
            'manufacturer_id' => $this->input('manufacturer_id'),
            'name' => $this->input('name'),
            'description' => $this->input('description'),
            //'slug' => $this->input('slug'),
            'html_page_title' => $this->input('html_page_title'),
            'html_page_meta_description' => $this->input('html_page_meta_description'),
            'is_enabled' => $this->input('is_enabled'),
            'price' => $this->input('price'),
            'price_discounted' => $this->input('price_discounted'),
            'request_for_price' => $this->input('request_for_price'),
            'model_number' => $this->input('model_number'),
            'model_number_displayed' => $this->input('model_number_displayed'),
            'popularity_index' => $this->input('popularity_index'),
        ];

        return $result;
    }

    protected function handlePhotos(Printer $subject)
    {
        \DB::transaction(function() use ($subject) {
            $originalPhotoRole = PrinterPhotoRole::whereName('original')->first();
            //we're getting photo_ids
            //find those not in current input and delete them
            $currentCpps = $subject->getCustomizedPhotosForRole($originalPhotoRole);
            foreach ($currentCpps as $cpp) {
                if (array_search($cpp->photo_id, $this->input('photo')) === false) {
                    PrinterPhoto::removePrinterPhoto($cpp->printer_photo_id);
                }
            }

            //check if there are new ones and create printerphotos of them
            $newPhotoIds = collect($this->input('photo'))->diff($subject->getCustomizedPhotosForRole($originalPhotoRole)->pluck('photo_id'));
            foreach ($newPhotoIds as $id) {
                PrinterPhotoManager::createPrinterPhotoWithCustomizations(
                    $subject,
                    Photo::find($id)
                );
            }
            //and finally update positions
            foreach ($this->input('photo') as $position => $photoId) {
                $cpp = $subject->getCustomizedPhotosForRole($originalPhotoRole)
                    ->firstWhere('photo_id', $photoId);

                if ($cpp != null) {
                    $cpp->printerphoto->update(['position' => $position]);
                }
            }
        });
    }
}
