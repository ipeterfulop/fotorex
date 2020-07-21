<?php


namespace App\Searching;


class TextSearchField extends SearchField
{
    public function __construct()
    {
        $this->type = 'text';
    }

    public function view()
    {
        return view('public.partials.search.text', [
            'value' => $this->value,
            'label' => $this->label,
            'field' => $this->field,
            'type' => $this->type,
        ]);
    }
}
