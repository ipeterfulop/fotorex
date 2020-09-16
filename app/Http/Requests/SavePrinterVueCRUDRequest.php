<?php

namespace App\Http\Requests;

use App\Formdatabuilders\PrinterVueCRUDFormdatabuilder;
use App\Printer;
use App\PrinterPhoto;
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
            $dataset['color_technology'] = 1;
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
        $subject->syncPhotos($this->input('photo'));
    }

    protected function handleTechnicalSpecifications(Printer $subject)
    {
        foreach (TechnicalSpecificationCategory::where('is_enabled', '=', 1)->get()->all() as $tsc) {
            $p[$tsc->id] = $this->input('tsc_'.$tsc->id);
        }
        return $subject->syncTechnicalSpecifications($p);
    }

}
