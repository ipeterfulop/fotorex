<?php

namespace App\Http\Controllers;

use App\Helpers\Productfamily;
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
        $class = Productfamily::getProductfamilyClassFromProductId(request()->get('printerId'));
        return response()->json([
            'valueset' => $class::where('id', '!=', request()->get('printerId'))->get()->sortBy('shortdisplayname')->values()->all()
        ]);
    }

    public function getRelated()
    {
        $class = Productfamily::getProductfamilyClassFromProductId(request()->get('printerId'));
        $printer = $class::find(request()->get('printerId'));
        $accessor = Printer::similarRelations()[request()->get('relationType')];

        return response()->json([
            'value' => $printer->$accessor->all()
        ]);
    }

    public function saveChanges()
    {
        $class = Productfamily::getProductfamilyClassFromProductId(request()->get('printerId'));
        $printer = $class::find(request()->get('printerId'));
        $result = $printer->syncSimilarPrinters(
            request()->get('value'),
            request()->get('relationType')
        );

        return $result
            ? response('OK')
            : response('A művelet nem sikerült', 500);

    }
}
