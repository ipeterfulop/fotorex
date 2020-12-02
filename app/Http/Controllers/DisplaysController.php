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
    public function details($slug)
    {
        $display = Display::findBySlug($slug);
        $attributes = ProductAttributeDataprovider::getComparableAttributeKeys(Productfamily::DISPLAYS_ID);
        return view('public.products.printer-details', [
            'printer' => $display,
            'attributes' => $attributes,
            'configuration' => Productcategory::getConfiguration(Productcategory::DISPLAYS_ID),
            'breadcrumbData' => $display->getBreadcrumbData()
        ]);
    }
}
