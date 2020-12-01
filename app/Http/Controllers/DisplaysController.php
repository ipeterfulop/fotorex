<?php

namespace App\Http\Controllers;

use App\Dataproviders\DisplayDataprovider;
use App\Dataproviders\ProductAttributeDataprovider;
use App\Display;
use App\Helpers\Productcategory;
use App\Helpers\Productfamily;
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
        $attributes = ProductAttributeDataprovider::getComparableAttributeKeys(Productfamily::DISPLAYS_ID);
        return view('public.products.printer-details', [
            'printer' => $display,
            'attributes' => $attributes,
        ]);
    }
}
