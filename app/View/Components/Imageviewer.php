<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Imageviewer extends Component
{
    public $imageUrls;
    public $componentId;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(array $imageUrls)
    {
        $this->imageUrls = $imageUrls;
        $this->componentId = \Str::random(9);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.imageviewer');
    }
}
