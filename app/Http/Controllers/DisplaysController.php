<?php

namespace App\Http\Controllers;

use App\Dataproviders\DisplayDataprovider;
use App\Display;
use App\Helpers\Productcategory;
use Illuminate\Http\Request;

class DisplaysController extends ProductController
{
    public function displayList()
    {
        if (!request()->isXmlHttpRequest()) {
            return view('public.articles.index');
        }
        $sortingOption = Display::validateSortingOption(request()->get('sortby', Display::SORTING_OPTION_PRICE_DOWN));
        $dataprovider = new DisplayDataprovider(Productcategory::DISPLAYS_ID);
        $dataproviderResult = $dataprovider->getResults(
            request()->get('page', 1),
            $sortingOption,
            );
        return view('public.partials.list-or-grid-inner', [
            'view' => 'public.partials.display-summary-block',
            'elements' => $dataproviderResult->results,
            'showPagination' => 'true',
            'result' => $dataproviderResult,
            'paginationPageFieldName' => 'page'
        ]);
    }

    public function details($slug)
    {
        $display = Display::findBySlug($slug);
        $attributes = PrinterComparisonController::getComparableAttributeKeys();
        return view('public.products.display-details', [
            'display' => $display,
            'attributes' => $attributes,
        ]);
    }
}
