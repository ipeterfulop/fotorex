<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Papersize extends Model
{
    use HasFactory;

    protected $appends = ['value', 'label'];

    public static function findByCode($code): ?Papersize
    {
        return Papersize::where('code', $code)
                        ->get()
                        ->first();
    }

    public function getValueAttribute()
    {
        return $this->id;
    }

    public function getLabelAttribute()
    {
        return $this->code;
    }

    public static function getAllCurrentlySold()
    {
        return self::whereIn(
            'id',
            PrinterPapersize::select('papersize_id')->distinct('papersize_id')->get()->pluck(
                'papersize_id'
            )
        )
                   ->orderBy('width_in_millimetres', 'asc')
                   ->get();
    }
}
