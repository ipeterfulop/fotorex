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
        'label',
        'url',
    ];

    protected $appends = [
        'final_label',
        'final_url',
        'custom_id'
    ];

    public function similarprinter()
    {
        return $this->belongsTo(Printer::class, 'similar_printer_id');
    }

    public function getFinalUrlAttribute()
    {
        if ($this->similar_printer_id != null) {
            return $this->similarprinter->getDetailsUrl();
        }

        return $this->url;
    }

    public function getFinalLabelAttribute()
    {
        if ($this->similar_printer_id != null) {
            return $this->similarprinter->shortdisplayname;
        }

        return $this->label;
    }

    public function getCustomIdAttribute()
    {
        return $this->similar_printer_id == null
            ? 'x_'.random_int(1000000, 9999999)
            : $this->similar_printer_id;
    }
}
