<?php


namespace App\Searching;


class RangeSearchField extends SearchField
{
    public $min;
    public $max;

    public function __construct($min, $max)
    {
        $this->type = 'range';
        $this->min = $min;
        $this->max = $max;
    }

    public function view()
    {
        return view('public.partials.search.range', [
            'value' => $this->value,
            'label' => $this->label,
            'field' => $this->field,
            'type' => $this->type,
            'min' => $this->min,
            'max' => $this->max
        ]);
    }
}
