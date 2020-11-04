<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Image;

class PrinterPhotoRole extends Model
{
    const ORIGINAL_ID = 1;
    const THUMBNAIL_ID = 2;

    protected $table = 'printer_photo_roles';

    public function generateFileName(Photo $photo)
    {
        $fullPath = $photo->file->getFullPath();
        $pathinfo = pathinfo($fullPath);
        $ext = (isset($pathinfo['extension']) ? $pathinfo['extension'] : 'jpg');

        return preg_replace('/'.$ext.'$/', '', $fullPath).$this->id.'.'.$ext;
    }

    public function createCustomizedPhoto($printerPhoto, $photo)
    {
        try {
            $image = \Image::make($photo->file->getFullPath());
            if (($this->preferred_width != 1) && ($this->preferred_height != 1)) {
                $newImage = self::createResizedImage($image, $this->preferred_width, $this->preferred_height);
            } else {
                $newImage = \Image::make($image);
            }
            $filename = $printerPhoto->id.'.'.basename($this->generateFileName($photo));
            $directory = storage_path('app'.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.PrinterPhoto::SUBDIRECTORY);
            @mkdir($directory, 02777, false);
            $newImage->save($directory.DIRECTORY_SEPARATOR.$filename);
            $newPhoto = Photo::createFromFilepath($directory.DIRECTORY_SEPARATOR.$filename);
            $newPhoto->file->update(['original_file_id' => $photo->file->id]);
            return CustomizedPrinterPhoto::updateOrCreate([
                'printer_photo_id' => $printerPhoto->id,
                'printer_photo_role_id' => $this->id
                ], [
                'photo_id' => $newPhoto->id,
            ]);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return null;
        }
    }

    public static function createResizedImage(Image $original, $width, $height)
    {
        $result = \Image::canvas($width, $height);
        if (($original->width() > $width) || ($original->height() > $height)) {
            if ($original->height() > $original->width()) {
                $original->resize(null, $height, function($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
            } else {
                $original->resize($width, null, function($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
            }
        }
        $result->insert($original, 'center');

        return $result;
    }
}
