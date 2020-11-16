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
        $result = request()->get('allowUndefined', true)
            ? [['id' => -1, 'name' => 'Mind']]
            : [];
        $manufacturers = Manufacturer::orderBy('name', 'asc')->enabled()->get()->transform(function($manufacturer) {
            return ['id' => $manufacturer->id, 'name' => $manufacturer->name];
        })->all();
        foreach ($manufacturers as $manufacturer) {
            $result[] = $manufacturer;
        }

        return response()->json([
            'manufacturers' => $result
        ]);
    }

    protected function fetchPrinters()
    {
        $result = request()->get('allowUndefined', true)
            ? [['id' => -1, 'name' => 'Mind']]
            : [];
        $printers = Printer::printer()->when(request()->get('manufacturer_id') > 0, function($query) {
                return $query->where('manufacturer_id', '=', request()->get('manufacturer_id'));
            })->orderBy('name', 'asc')->enabled()->get()->transform(function($printer) {
                    return ['id' => $printer->id, 'name' => $printer->shortdisplayname];
                })->all();
        foreach ($printers as $printer) {
            $result[] = $printer;
        }
        return response()->json([
            'printers' => $result
        ]);
    }
}
