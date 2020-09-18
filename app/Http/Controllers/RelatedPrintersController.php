<?php

namespace App\Http\Controllers;

use App\Printer;
use Illuminate\Http\Request;

class RelatedPrintersController extends Controller
{
    public function operation()
    {
        if (!method_exists($this, request()->get('action'))) {
            abort(404);
        }

        return $this->{request()->get('action')}();
    }

    public function fetchValueset()
    {
        return response()->json([
            'valueset' => Printer::all()->all()
        ]);
    }

    public function getRelated()
    {
        $printer = Printer::find(request()->get('printerId'));
        $accessor = Printer::similarRelations()[request()->get('relationType')];

        return response()->json([
            'value' => $printer->$accessor->pluck('similar_printer_id')
        ]);
    }

    public function saveChanges()
    {
        $printer = Printer::find(request()->get('printerId'));
        $result = $printer->syncSimilarPrinters(
            request()->get('value'),
            request()->get('relationType')
        );

        return $result
            ? response('OK')
            : response('A művelet nem sikerült', 500);

    }
}
