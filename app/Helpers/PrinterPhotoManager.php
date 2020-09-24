<?php


namespace App\Helpers;


use App\PrinterPhoto;

class PrinterPhotoManager
{
    public static function createPrinterPhotoWithVariants(
        $printerId,
        $photoId,
        $printerPhotoId = null
    ) {
        \DB::transaction(function() use ($printerId, $photoId, $printerPhotoId) {

        });
    }
}