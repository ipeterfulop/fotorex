<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrinterPapersize extends Model
{
    use HasFactory;

    protected $table = 'printer_papersize';

    protected $fillable = ['printer_id', 'papersize_id'];

    public static function addOrUpdatePapersizes($printerId, array $papersizeCodeArr)
    {
        foreach ($papersizeCodeArr as $code) {
            $papersize = Papersize::findByCode($code);
            $printer = Printer::find($printerId);
            if ((is_null($papersize)) || (is_null($printer))) {
                throw new \Exception('Cannot add/update PrinterPapersize. Printer or Papersize does not exists.');
            }

            $printerpapersize = PrinterPapersize::where('printer_id', $printer->id)
                                                ->where('papersize_id', $papersize->id)
                                                ->get()
                                                ->first();

            if (!is_null($printerpapersize)) {
                $printerpapersize->update(['updated_at' => Carbon::now()]);
            } else {
                PrinterPapersize::create(
                    [
                        'printer_id'   => $printer->id,
                        'papersize_id' => $papersize->id,
                        'created_at'   => Carbon::now(),
                    ]
                );
            }
        }
    }
}
