<?php

namespace App\Http\Controllers;

use App\Attribute;
use App\Printer;
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
            'printers' => $printers
        ]);
    }

    public function getComparisonData()
    {
        $printer = Printer::findBySlug(request()->get('printer'));
        $attributes = self::getComparableAttributeKeys();
        $result = ['name' => $printer->name];
        foreach ($attributes as $attribute) {
            $result[$attribute['v']] = $printer->{$attribute['v']};
        }

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
