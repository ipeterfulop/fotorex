<?php

namespace App\Http\Controllers;

use App\Dataproviders\PrinterDataprovider;
use App\Dataproviders\ProductAttributeDataprovider;
use App\Factories\PrinterFilterFactory;
use App\Helpers\Productcategory;
use App\Helpers\Productfamily;
use App\Http\Requests\SendPrinterInEmailRequest;
use App\Printer;
use Illuminate\Http\Request;

class PrintersController extends ProductController
{
    public function printerList()
    {
        if (!request()->isXmlHttpRequest()) {
            return view('public.articles.index');
        }
        $sortingOption = Printer::validateSortingOption(request()->get('sortby', Printer::SORTING_OPTION_PRICE_DOWN));
        $dataprovider = new PrinterDataprovider(Productcategory::ALLPRINTERS_ID);
        $dataproviderResult = $dataprovider->getResults(
            request()->get('page', 1),
            $sortingOption,
        );
        return view('public.partials.list-or-grid-inner', [
            'view' => 'public.partials.printer-summary-block',
            'elements' => $dataproviderResult->results,
            'showPagination' => 'true',
            'result' => $dataproviderResult,
            'paginationPageFieldName' => 'page'
        ]);
    }

    public function details($slug)
    {
        $printer = Printer::findBySlug($slug);
        $attributes = ProductAttributeDataprovider::getComparableAttributeKeys(Productfamily::PRINTERS_ID);
        $slug = Productfamily::getProductfamilySlug($printer->productfamily);
        return view('public.products.'.$slug.'-details', [
            $slug => $printer,
            'attributes' => $attributes,
        ]);
    }
}
