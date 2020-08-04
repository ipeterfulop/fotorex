<?php


namespace App\Dataproviders;


use Datalytix\VueCRUD\Indexfilters\SelectVueCRUDIndexfilter;

class PrinterPickerVueCRUDIndexfilter extends SelectVueCRUDIndexfilter
{
    public $component;
    public $props;

    public function __construct($property, $label, $default, $value = null)
    {
        parent::__construct($property, $label, $default, $value);
        $this->type = 'custom-component';
        $this->component = 'printer-picker';
        $this->props = [
            'operationsUrl' => route('printer_picker_endpoint')
        ];
    }
}
