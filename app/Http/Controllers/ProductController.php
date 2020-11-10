<?php

namespace App\Http\Controllers;

use App\Helpers\Productcategory;
use App\Http\Requests\SendPrinterInEmailRequest;
use App\Printer;
use Illuminate\Http\Request;

abstract class ProductController extends Controller
{
    public function sendEmail(SendPrinterInEmailRequest $request)
    {
        try {
            $request->send();
        } catch (\Exception $e) {
            return response('Sikertelen küldés, kérjük próbálja meg később.');
        }

        return response('Üzenet elküldve.');
    }

    public function category($productcategoryId)
    {
        $configuration = Productcategory::getConfiguration($productcategoryId);
        $productFilters = $configuration->filterbuilderClass::createFilters();

        return view('public.category', [
            'productFilters' => $productFilters,
            'ajaxUrl' => route('list_products_in_category', ['productcategoryId' => $productcategoryId]),
            'categoryLabel' => $configuration->label
        ]);
    }

    public function productcategoryList($productcategoryId)
    {
        if (!request()->isXmlHttpRequest()) {
            abort(404);
        }
        $configuration = Productcategory::getConfiguration($productcategoryId);
        $sortingOption = Printer::validateSortingOption(request()->get('sortby', Printer::SORTING_OPTION_POPULARITY_DOWN));
        $dataprovider = new $configuration->dataproviderClass($productcategoryId);
        $dataproviderResult = $dataprovider->getResults(
            request()->get('page', 1),
            $sortingOption,
            );
        return view('public.partials.list-or-grid-inner', [
            'view' => $configuration->detailsViewName,
            'elements' => $dataproviderResult->results,
            'showPagination' => 'true',
            'result' => $dataproviderResult,
            'paginationPageFieldName' => 'page'
        ]);
    }

}
