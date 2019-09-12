<?php

namespace App;

use App\Traits\belongsToPrinter;
use Datalytix\VueCRUD\Traits\hasPosition;
use Illuminate\Database\Eloquent\Model;

class PrinterPhoto extends Model
{
    use belongsToPrinter, hasPosition;

    protected $table = 'printer_photo';

    protected $fillable = ['printer_id', 'position'];

    protected $with = ['original', 'thumbnail'];

    public function customized_printer_photos()
    {
        return $this->hasMany(CustomizedPrinterPhoto::class, 'printer_photo_id', 'id');
    }

    public function original()
    {
        return $this->hasOneThrough(
            Photo::class,
            CustomizedPrinterPhoto::class,
            'printer_photo_id',
            'id',
            'id',
            'photo_id'
        )->where('printer_photo_role_id', '=', PrinterPhotoRole::ORIGINAL_ID);
    }

    public function thumbnail()
    {
        return $this->hasOneThrough(
            Photo::class,
            CustomizedPrinterPhoto::class,
            'printer_photo_id',
            'id',
            'id',
            'photo_id'
        )->where('printer_photo_role_id', '=', PrinterPhotoRole::THUMBNAIL_ID);
    }

    public static function firstOrCreateWithCustomizedPrinterPhoto($printer_id, $photo_id)
    {
        $result = self::select('printer_photo.*', 'customized_printer_photos.*')->join('customized_printer_photos', 'printer_photo.id', '=', 'customized_printer_photos.printer_photo_id')->where('photo_id', '=', $photo_id)->first();
        if ($result === null) {
            $result = self::create(['printer_id' => $printer_id, 'position' => self::getFirstAvailablePosition(['printer_id' => $printer_id])]);
            CustomizedPrinterPhoto::createCustomizedPhotos($result->id, $photo_id);
        }
        return $result;
    }

    public static function getRemovablePhotos($printer_id, $photo_ids)
    {
        return self::select('printer_photo.*', 'customized_printer_photos.id AS cpp_id', 'customized_printer_photos.printer_photo_id AS pp_id')->join('customized_printer_photos', 'printer_photo.id', '=', 'customized_printer_photos.printer_photo_id')->where([['printer_id', '=', $printer_id],['printer_photo_role_id', '=', PrinterPhotoRole::ORIGINAL_ID]])->whereNotIn('photo_id', $photo_ids)->get();
    }

    public static function removePrinterPhoto($printer_photo_id)
    {
        CustomizedPrinterPhoto::removeCustomizedPrinterPhoto($printer_photo_id);
        $p = PrinterPhoto::find($printer_photo_id);
        $p->delete();
    }

    public static function getRestrictingFields()
    {
        return [];
    }
}
