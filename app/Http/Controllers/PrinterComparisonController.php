<?php

namespace App\Http\Controllers;

use App\Attribute;
use App\Dataproviders\ProductAttributeDataprovider;
use App\Helpers\ComparablePrinter;
use App\Helpers\Productfamily;
use App\Printer;
use App\PrinterPhotoRole;
use Illuminate\Http\Request;

class PrinterComparisonController extends Controller
{
    const INTERNAL_TYPE = 1;
    const EXTERNAL_TYPE = 2;

    public function index()
    {
        $comparedAttributes = ProductAttributeDataprovider::getComparableAttributeKeys(Productfamily::PRINTERS_ID);
        $printers = request()->has('first') ? [request()->get('first')] : [];

        return view('public.products.compare', [
            'comparedAttributes' => $comparedAttributes,
            'printers' => $printers,
            'dataUrl' => route('product_comparison_data'),
            'availablePrinters' => ComparablePrinter::select('name', 'slug', 'mfname')->orderBy('name', 'asc')->get()->groupBy('mfname')
        ]);
    }

    public function getComparisonData()
    {
        $printer = Printer::findBySlug(request()->get('printer'));
        $attributes = ProductAttributeDataprovider::getComparableAttributeKeys(Productfamily::PRINTERS_ID);
        $result = [
            'name' => $printer->name,
            'photo' => $printer->getMainImageUrl(request()->get('printerphotoroles')->get('index'))
        ];

        foreach ($attributes as $attribute) {
            $result[$attribute['v']] = $printer->{$attribute['v']};
        }
        $result['link'] = $printer->getDetailsUrl();
        $result['linkbutton'] = '<a class="bg-fotogray hover-red-link w-full flex items-center justify-center font-bold py-3 flex-grow"'
            .'href="'.$printer->getDetailsUrl().'">Termékoldal</a>';

        return response()->json($result);
    }
}
