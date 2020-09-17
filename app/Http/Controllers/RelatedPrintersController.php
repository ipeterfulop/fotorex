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
}
