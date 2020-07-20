<?php
/**
 * Created by PhpStorm.
 * User: caleb
 * Date: 3/13/19
 * Time: 5:48 PM
 */

namespace App\Dataproviders;


use Illuminate\Support\Collection;

class DataproviderResult
{
    const COMPACT_VIEW_SURROUNDING_BUTTON_COUNT = 2;

    public $results;
    public $totalCount;
    public $itemsPerPage;
    public $currentPage;
    public $indexRouteName;
    public $sortingOption;
    public $routingOptions = [];
    public $pages;
    public $pageFieldName = 'page';

    public function getPageCount()
    {
        return ceil($this->totalCount / $this->itemsPerPage);
    }

    public function shouldShowCompactButtonList()
    {
        return $this->getPageCount() > self::COMPACT_VIEW_SURROUNDING_BUTTON_COUNT * 2 + 1;
    }

    public function getPaginationButtonsToShow($compact = false)
    {
        if (($compact) && ($this->shouldShowCompactButtonList())) {
            return $this->getCompactPaginationButtonList();
        } else {
            return $this->getPaginationButtonList(1, $this->getPageCount());
        }
    }

    protected function getCompactPaginationButtonList()
    {
        $start = $this->currentPage - self::COMPACT_VIEW_SURROUNDING_BUTTON_COUNT;
        $end = $this->currentPage + self::COMPACT_VIEW_SURROUNDING_BUTTON_COUNT;
        if ($start < 1) {
            $start = 1;
        }
        if ($end > $this->getPageCount()) {
            $end = $this->getPageCount();
        }

        return $this->getPaginationButtonList($start, $end);
    }

    protected function getPaginationButtonList($start, $end)
    {
        $result = new Collection();
        for ($t = $start; $t <= $end; $t++) {
            $button = new \stdClass();
            $button->label = $t;
            $button->current = $t == $this->currentPage;
            $result->put($t, $button);
        }

        return $result;
    }

    public function isAtFirstPage()
    {
        return $this->currentPage == 1;
    }

    public function isAtLastPage()
    {
        return $this->currentPage == $this->getPageCount();
    }

    public function firstPageUrl()
    {
        return ! $this->isAtFirstPage()
            ? route($this->indexRouteName, array_merge($this->routingOptions, ['sortingOption' => $this->sortingOption, 'page' => 1]))
            : null;
    }

    public function lastPageUrl()
    {
        return ! $this->isAtLastPage()
            ? route($this->indexRouteName, array_merge($this->routingOptions, ['sortingOption' => $this->sortingOption, 'page' => $this->getPageCount()]))
            : null;
    }

    public function previousPageUrl()
    {
        return ! $this->isAtFirstPage()
            ? route($this->indexRouteName, array_merge($this->routingOptions, ['sortingOption' => $this->sortingOption, 'page' => $this->currentPage - 1]))
            : null;
    }

    public function nextPageUrl()
    {
        return ! $this->isAtLastPage()
            ? route($this->indexRouteName, array_merge($this->routingOptions, ['sortingOption' => $this->sortingOption, 'page' => $this->currentPage + 1]))
            : null;
    }

    public function pageUrl($page)
    {
        return route($this->indexRouteName, array_merge($this->routingOptions, ['sortingOption' => $this->sortingOption, 'page' => $page]));
    }

}
