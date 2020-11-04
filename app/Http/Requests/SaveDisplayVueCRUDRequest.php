<?php

namespace App\Http\Requests;

use App\Formdatabuilders\DisplayVueCRUDFormdatabuilder;
use App\Display;
use App\Helpers\Productfamily;
use Datalytix\VueCRUD\Requests\VueCRUDRequestBase;

class SaveDisplayVueCRUDRequest extends SavePrinterVueCRUDRequest
{
    const FORMDATABUILDER_CLASS = DisplayVueCRUDFormdatabuilder::class;
    const PRODUCTFAMILY = Productfamily::DISPLAYS_ID;
}
