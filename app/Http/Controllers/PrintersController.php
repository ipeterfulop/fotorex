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
    public function details($slug)
    {
        $printer = Printer::findBySlug($slug);
        $attributes = ProductAttributeDataprovider::getComparableAttributeKeys(Productfamily::PRINTERS_ID);
        $slug = Productfamily::getProductfamilySlug($printer->productfamily);
        return view('public.products.'.$slug.'-details', [
            $slug => $printer,
            'attributes' => $attributes,
            'configuration' => Productcategory::getConfiguration(Productcategory::PRINTERS_ID),
            'breadcrumbData' => $printer->getBreadcrumbData()
        ]);
    }
}
