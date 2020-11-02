<?php

namespace App\Http\Requests;

use App\Formdatabuilders\HighlightedprinterVueCRUDFormdatabuilder;
use App\Highlightedprinter;
use Datalytix\VueCRUD\Requests\VueCRUDRequestBase;

class SaveHighlightedprinterVueCRUDRequest extends VueCRUDRequestBase
{
    const FORMDATABUILDER_CLASS = HighlightedprinterVueCRUDFormdatabuilder::class;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function save(Highlightedprinter $subject = null)
    {
        $dataset = $this->getDataset();
        if ($subject == null) {
            $dataset['position'] = Highlightedprinter::getFirstAvailablePosition([]);
            $subject = Highlightedprinter::create($dataset);
        } else {
            $subject->update($dataset);
        }

        return $subject;
    }

    public function getDataset()
    {
        $result = [
            'printer_id' => $this->input('printer_id')
        ];

        return $result;
    }
}
