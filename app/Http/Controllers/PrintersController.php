<?php

namespace App\Http\Controllers;

use App\Dataproviders\PrinterDataprovider;
use App\Printer;
use Illuminate\Http\Request;

class PrintersController extends Controller
{
    public function printerList()
    {
        if (!request()->isXmlHttpRequest()) {
            return view('public.articles.index');
        }
        $sortingOption = Printer::validateSortingOption(request()->get('sortby', Printer::SORTING_OPTION_PRICE_DOWN));
        $dataproviderResult = PrinterDataprovider::getPrinters(
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

        return view('public.products.details', [
            'printer' => $printer
        ]);
    }

}
