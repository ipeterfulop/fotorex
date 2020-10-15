<?php

namespace App\Http\Requests;

use App\CustomizedPrinterPhoto;
use App\Formdatabuilders\PrinterVueCRUDFormdatabuilder;
use App\Helpers\PrinterPhotoManager;
use App\Photo;
use App\Printer;
use App\PrinterPhoto;
use App\PrinterPhotoRole;
use App\TechnicalSpecificationCategory;
use Datalytix\VueCRUD\Requests\VueCRUDRequestBase;

class SavePrinterVueCRUDRequest extends VueCRUDRequestBase
{
    const FORMDATABUILDER_CLASS = PrinterVueCRUDFormdatabuilder::class;

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
            $dataset['usergroup_size_id'] = 11;
            if ($subject == null) {
                $subject = Printer::create($dataset);
            } else {
                $subject->update($dataset);
            }
            $this->handlePhotos($subject);
            $this->handleTechnicalSpecifications($subject);
        });

        return $subject;
    }

    public function getDataset()
    {
        $result = $this->getBaseDatasetFromRequest(Printer::class);

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

    protected function handleTechnicalSpecifications(Printer $subject)
    {
        foreach (TechnicalSpecificationCategory::where('is_enabled', '=', 1)->get()->all() as $tsc) {
            $p[$tsc->id] = $this->input('tsc_'.$tsc->id);
        }
        return $subject->syncTechnicalSpecifications($p);
    }

}
