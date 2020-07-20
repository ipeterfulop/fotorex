<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AjaxListOrGridView extends Component
{
    public $url;
    public $sortingOptions;
    public $pushState;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($url, $sortingOptions, $pushState = false)
    {
        //
        $this->url = $url;
        $this->sortingOptions = $sortingOptions;
        $this->pushState = $pushState;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.ajax-list-or-grid-view');
    }
}
