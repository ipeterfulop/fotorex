<?php

namespace App\Http\Controllers;

use App\Attribute;
use App\Display;
use App\Helpers\ComparableDisplay;
use Illuminate\Http\Request;

class DisplayComparisonController extends Controller
{
    const INTERNAL_TYPE = 1;
    const EXTERNAL_TYPE = 2;

    public function index()
    {
        $comparedAttributes = self::getComparableAttributeKeys();
        $printers = request()->has('first') ? [request()->get('first')] : [];
        return view('public.products.compare', [
            'comparedAttributes' => $comparedAttributes,
            'printers' => $printers,
            'dataUrl' => route('display_comparison_data'),
            'availablePrinters' => ComparableDisplay::select('name', 'slug', 'mfname')->orderBy('name', 'asc')->get()->groupBy('mfname')
        ]);
    }

    public function getComparisonData()
    {
        $printer = Display::findBySlug(request()->get('printer'));
        $attributes = self::getComparableAttributeKeys();
        $result = [
            'name' => $printer->shortdisplayname,
            'photo' => $printer->getMainImageUrl(request()->get('printerphotoroles')->get('index'))
        ];

        foreach ($attributes as $attribute) {
            $result[$attribute['v']] = $printer->{$attribute['v']};
        }
        $result['link'] = $printer->getDetailsUrl();
        $result['linkbutton'] = '<a class="bg-fotogray hover-red-link w-full flex items-center justify-center font-bold py-3 flex-grow"'
            .'href="'.$result['link'].'">Termékoldal</a>';

        return response()->json($result);
    }

    public static function getComparableAttributeKeys()
    {
        $result = [];
        foreach (Attribute::where('position_at_product_comparison', '!=', null)->orderBy('position_at_product_comparison', 'asc')->get() as $attribute) {
            $result[] = ['v' => $attribute->variable_name.'_label', 'n' => $attribute->name];
        }

        return collect($result);
    }

}
