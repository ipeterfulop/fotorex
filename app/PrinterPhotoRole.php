<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
        return $fullPath.'.'.$this->id.'.'.$ext;
    }
}
