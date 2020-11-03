<?php


namespace App\Formdatabuilders;


use App\Display;
use Datalytix\VueCRUD\Formdatabuilders\VueCRUDFormdatabuilder;

class DisplayVueCRUDFormdatabuilder extends PrinterVueCRUDFormdatabuilder
{
    public function __construct(Display $subject = null, $defaults = [])
    {
        $this->subject = $subject;
        $this->defaults = $defaults;
    }
}