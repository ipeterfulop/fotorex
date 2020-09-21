<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SimilarPrinter extends Model
{
    protected $fillable = [
        'printer_id',
        'similar_printer_id',
        'is_enabled',
        'position',
        'relationtype',
    ];

    public function similarprinter()
    {
        return $this->belongsTo(Printer::class, 'similar_printer_id');
    }
}
