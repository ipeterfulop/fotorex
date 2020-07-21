<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AjaxListOrGridView extends Component
{
    public $url;
    public $sortingOptions;
    public $pushState;
    public $filters = [];
    public $page = 1;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($url, $sortingOptions, $filters = [], $pushState = false)
    {
        //
        $this->url = $url;
        $this->sortingOptions = $sortingOptions;
        $this->pushState = $pushState;
        $this->filters = $filters;
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

    /**
     * @param int $page
     * @return AjaxListOrGridView
     */
    public function setPage(int $page): AjaxListOrGridView
    {
        $this->page = $page;
        return $this;
    }
}
