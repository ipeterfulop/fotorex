<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PriceSlider extends Component
{
    public $componentId;
    public $min;
    public $max;
    public $field;

    /**
     * Create a new component instance.
     *
     * @param int $min
     * @param int $max
     */
    public function __construct(int $min, int $max, string $field)
    {
        $this->componentId = \Str::random(9);
        $this->min = $min;
        $this->max = $max;
        $this->field = $field;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.price-slider');
    }
}
