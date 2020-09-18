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
}
