<?php

namespace App\Http\Controllers;

use App\Manufacturer;
use App\Printer;
use Illuminate\Http\Request;

class PrinterPickerController extends Controller
{
    public function operation()
    {
        if (method_exists($this, request()->get('action'))) {
            return $this->{request()->get('action')}();
        }
        abort(404);
    }

    protected function fetchManufacturers()
    {
        $manufacturers = request()->get('allowUndefined', true)
            ? [['id' => -1, 'name' => 'Mind']]
            : [];
        $manufacturers = $manufacturers
            + Manufacturer::orderBy('name', 'asc')->enabled()->get()->transform(function($manufacturer) {
                return ['id' => $manufacturer->id, 'name' => $manufacturer->name];
            })->all();

        return response()->json([
            'manufacturers' => $manufacturers
        ]);
    }

    protected function fetchPrinters()
    {
        $printers = request()->get('allowUndefined', true)
            ? [['id' => -1, 'name' => 'Mind']]
            : [];
        $printers = $printers + Printer::when(request()->get('manufacturer_id') > 0, function($query) {
                return $query->where('manufacturer_id', '=', request()->get('manufacturer_id'));
            })->orderBy('name', 'asc')->enabled()->get()->transform(function($printer) {
                    return ['id' => $printer->id, 'name' => $printer->name];
                })->all();

        return response()->json([
            'printers' => $printers
        ]);
    }
}
