<?php

namespace App\Http\Controllers;

use App\Attribute;
use App\Helpers\ComparablePrinter;
use App\Printer;
use App\PrinterPhotoRole;
use Illuminate\Http\Request;

class PrinterComparisonController extends Controller
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
            'availablePrinters' => ComparablePrinter::select('name', 'slug', 'mfname')->orderBy('name', 'asc')->get()->groupBy('mfname')
        ]);
    }

    public function getComparisonData()
    {
        $printer = Printer::findBySlug(request()->get('printer'));
        $attributes = self::getComparableAttributeKeys();
        $result = [
            'name' => $printer->name,
            'photo' => $printer->getMainImageUrl(request()->get('printerphotoroles')->get('index'))
        ];

        foreach ($attributes as $attribute) {
            $result[$attribute['v']] = $printer->{$attribute['v']};
        }
        $result['link'] = route('printer_details', ['slug' => $printer->slug]);
        $result['linkbutton'] = '<a class="bg-fotogray hover-red-link w-full flex items-center justify-center font-bold py-3 flex-grow"'
            .'href="'.route('printer_details', ['slug' => $printer->slug]).'">Termékoldal</a>';

        return response()->json($result);
    }

    public static function getComparableAttributeKeys()
    {
        $result = [
            ['v' => 'usergroup_size_id', 'n' => 'Csoportméret'],
            ['v' => 'color_technology', 'n' => 'Technológia'],
        ];
        foreach (Attribute::where('use_at_product_comparison', '=', 1)->get() as $attribute) {
            $result[] = ['v' => $attribute->variable_name, 'n' => $attribute->name];
        }

        return collect($result);
    }
}
