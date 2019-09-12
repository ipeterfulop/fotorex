<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;

class Photo extends Model
{
    protected $table = 'photos';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'width',
        'height',
    ];

    protected $appends = ['name'];

    protected $with = ['file'];

    public function file() {
        return $this->belongsTo(File::class, 'id', 'id');
    }

    public static function createFromFilepath($path, $original_name = null, $new_name = null) {
        $result = null;
        \DB::transaction(function() use (&$result, $path, $original_name, $new_name) {
            $file = File::createFromFilepath($path, $original_name, $new_name);
            // open an image file
            $img = Image::make($file->getFullPath());
            $result = self::create([
                'id'        => $file->id,
                'width'     => $img->width(),
                'height'    => $img->height(),
            ]);
        });

        return $result;
    }

    public function getNameAttribute()
    {
        return $this->file->name;
    }

    public static function removePhoto($photo_id)
    {
        $p = Photo::find($photo_id);
        $p->delete();
        File::removeFile($photo_id);
    }
}
