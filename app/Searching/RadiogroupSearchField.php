<?php


namespace App\Searching;


class RadiogroupSearchField extends SearchField
{
    public function __construct()
    {
        $this->type = 'radiogroup';
        $this->value = -1;
    }

    public function view()
    {
        return view('public.partials.search.radiogroup', [
            'value' => $this->value,
            'label' => $this->label,
            'field' => $this->field,
            'type' => $this->type,
            'valueset' => $this->valueset
        ]);
    }

}