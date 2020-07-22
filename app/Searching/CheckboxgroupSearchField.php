<?php


namespace App\Searching;


class CheckboxgroupSearchField extends SearchField
{
    public function __construct()
    {
        $this->type = 'checkboxgroup';
    }

    public function view()
    {
        return view('public.partials.search.checkboxgroup', [
            'value' => $this->value,
            'label' => $this->label,
            'field' => $this->field,
            'type' => $this->type,
            'valueset' => $this->valueset
        ]);
    }
}
