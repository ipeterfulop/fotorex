<?php

namespace App\Http\Controllers;

use App\Attribute;
use App\Helpers\PrinterAttributeValue;
use App\Papersize;
use App\Printer;
use App\PrinterAttribute;
use App\PrinterPapersize;
use App\UsergroupSize;
use Illuminate\Http\Request;

class PrinterAttributeController extends Controller
{
    public function operation()
    {
        if (!method_exists($this, request()->get('action'))) {
            abort(404);
        }

        return $this->{request()->get('action')}();
    }

    protected function fetchData()
    {
        $printer = Printer::find(request()->get('printerId'));
        $attributes = Attribute::with('attribute_value_set')->orderBy('name', 'asc')->where('is_computed', '=', 0)->get();
        $attributes->push((object)[
            'name' => 'Papírméretek',
            'variable_name' => 'papersize',
            'multiselect' => true,
            'attribute_value_set' => (object)['attribute_values' => Papersize::orderBy('code', 'asc')->get()]
        ]);
        $attributes->push((object)[
            'name' => 'Munkakörnyezet',
            'variable_name' => 'usergroup_size_id',
            'attribute_value_set' => (object)['attribute_values' => UsergroupSize::orderBy('position', 'asc')->get()]
        ]);
        $printerAttributeValues = PrinterAttributeValue::where('printer_id', '=', request()->get('printerId'))->get();
        $printerAttributeValues->push((object)[
            'variable_name' => 'papersize',
            'finalvalue_or_id' => PrinterPapersize::where('printer_id', '=', request()->get('printerId'))->pluck('papersize_id')->all()
        ]);
        $printerAttributeValues->push((object)[
            'variable_name' => 'usergroup_size_id',
            'finalvalue_or_id' => $printer->usergroup_size_id
        ]);
        $attributes = $attributes->sortBy('name')->values()->all();
        return response()->json([
            'printer' => $printer,
            'attributes' => $attributes,
            'printerattributevalues' => $printerAttributeValues
        ]);
    }

    protected function saveChanges()
    {
        $transactionResult = \DB::transaction(function() {
            $printer = Printer::findOrFail(request()->get('printerId'));
            $attributes = Attribute::where('is_computed', '=', 0)->get()->keyBy('variable_name');
            $attributeInput = collect(request()->get('attributes'))->keyBy('variable_name');
            $printer->syncPapersizes($attributeInput->get('papersize')['value']);
            $printer->update(['usergroup_size_id' => $attributeInput->get('usergroup_size_id')['value']]);
            foreach ($attributeInput as $attributeInputElement) {
                if ($attributes->get($attributeInputElement['variable_name']) != null) {
                    $baseDataset = [
                        'attribute_id' => $attributes->get($attributeInputElement['variable_name'])->id,
                        'printer_id' => $printer->id,
                    ];

                    if ($attributes->get($attributeInputElement['variable_name'])->takesValueFromSet()) {
                        $valueDataset = ['attribute_value_id' => $attributeInputElement['value']];
                    } else {
                        $valueDataset = ['customvalue' => $attributeInputElement['value']];
                    }
                    PrinterAttribute::updateOrCreate($baseDataset, $valueDataset);
                }
            }
        });

        return $transactionResult === null ? response('OK') : response('Hiba történt', 419);
    }
}
