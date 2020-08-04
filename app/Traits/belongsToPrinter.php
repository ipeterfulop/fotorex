<?php

namespace App\Traits;

use App\Printer;

trait belongsToPrinter
{
    public function scopeForPrinter($query, Printer $printer)
    {
        return $query->where('printer_id', '=', $printer->id);
    }

    public function printer()
    {
        return $this->belongsTo(Printer::class);
    }
}
