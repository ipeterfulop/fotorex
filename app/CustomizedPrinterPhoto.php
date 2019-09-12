<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Intervention\Image\ImageManager;

class CustomizedPrinterPhoto extends Model
{
    protected $fillable = ['printer_photo_id', 'photo_id', 'printer_photo_role_id'];

    protected $with = ['photo'];

    public function photo()
    {
        return $this->belongsTo(Photo::class, 'photo_id', 'id');
    }

    public static function createCustomizedPhotos($printer_photo_id, $photo_id)
    {
        \DB::transaction(function() use ($printer_photo_id, $photo_id) {
            $photo = Photo::find($photo_id);
            foreach (PrinterPhotoRole::all() as $role) {
                self::createCustomizedPhoto($printer_photo_id, $photo, $role);
            }
        });
    }

    public static function createCustomizedPhoto($printer_photo_id, Photo $photo, PrinterPhotoRole $role)
    {
        $result = null;
        $fn = $role->generateFileName($photo);
        $img_manager = new ImageManager(array('driver' => 'gd'));
        try {
            $img = $img_manager->make($photo->file->getFullPath());
            if ($role->auto_process == 1) {
                $img->resize($role->preferred_width, $role->preferred_height);
            }
            $img->save($fn);
            $new_photo = Photo::createFromFilepath($fn);
            if ($new_photo === null) {
                throw (new \Exception('Nem jott letre a Photo (Photo id: '.$photo->id.'; Role id: '.$role->id.')'));
            }
            $new_photo->file->update(['original_file_id' => $photo->id]);
            $result = self::create([
                'printer_photo_id' => $printer_photo_id,
                'photo_id' => $new_photo->id,
                'printer_photo_role_id' => $role->id
            ]);
        }
        catch (\Exception $e) {
            throw $e;
        }
        return $result;
    }

    public static function removeCustomizedPrinterPhoto($printer_photo_id)
    {
        foreach (CustomizedPrinterPhoto::getRemovableCustomizedPrinterPhotos($printer_photo_id) as $cpp) {
            $cpp->delete();
        }
    }

    public static function getRemovableCustomizedPrinterPhotos($printer_photo_id)
    {
        return CustomizedPrinterPhoto::where('printer_photo_id', '=', $printer_photo_id)->get();
    }

    public function delete()
    {
        $photo_id = $this->photo_id;
        $result = parent::delete();
        Photo::removePhoto($photo_id);
        return $result;
    }
}
