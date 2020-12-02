<?php

namespace App\Http\Controllers;

use App\Dataproviders\ProductAttributeDataprovider;
use App\Helpers\Productcategory;
use App\Helpers\Productfamily;
use App\Printer;
use Illuminate\Http\Request;

class RentalsController extends ProductController
{
    public function details($slug)
    {
        $printer = Printer::findBySlug($slug);
        $attributes = ProductAttributeDataprovider::getComparableAttributeKeys(Productfamily::PRINTERS_ID);
        $slug = Productfamily::PRINTERS_SLUG;
        return view('public.products.'.$slug.'-details', [
            $slug => $printer,
            'attributes' => $attributes,
            'configuration' => Productcategory::getConfiguration(Productcategory::RENTALS_ID),
            'breadcrumbData' => $printer->getBreadcrumbData(Productcategory::RENTALS_ID, Productcategory::RENTALS_LABEL)
        ]);
    }

}
