<?php


namespace App\Helpers;


use App\Photo;
use App\Printer;
use App\PrinterPhoto;
use App\PrinterPhotoRole;

class PrinterPhotoManager
{
    public static function createPrinterPhotoWithCustomizations(
        Printer $printer,
        Photo $photo,
        $printerPhoto = null
    ) {
        return \DB::transaction(function() use ($printer, $photo, $printerPhoto) {
            if ($printerPhoto == null) {
                $printerPhoto = PrinterPhoto::create([
                    'printer_id' => $printer->id,
                    'position' => PrinterPhoto::getFirstAvailablePosition(['printer_id' => $printer->id])
                ]);
            }
            foreach (PrinterPhotoRole::all() as $role) {
                $role->createCustomizedPhoto($printerPhoto, $photo);
            }

        }) === null;
    }
    public static function createPrinterPhotoWithCustomizationsFromFile(
        Printer $printer,
        $file,
        $printerPhoto = null
    ) {
        try {
            $photo = Photo::createFromFilepath($file);
            return self::createPrinterPhotoWithCustomizations($printer, $photo, $printerPhoto);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return false;
        }
    }
}