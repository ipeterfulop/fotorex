<?php

namespace App\Http\Controllers;

use App\PrinterRentaloption;
use Illuminate\Http\Request;

class PrinterRentalPopularityIndexController extends Controller
{
    public function update()
    {
        $value = str_ireplace(',', '.', request()->input('value'));
        if (floatval($value) == '0.0') {
            return response('Csak 0-nál nagyobb érték lehet!', 422);
        }
        $subject = PrinterRentaloption::find(request()->get('subject')['id']);
        return $subject->update(['popularity_index' => floatval($value)])
            ? response('OK')
            : response('Hiba történt a mentés során', 419);

    }
}
