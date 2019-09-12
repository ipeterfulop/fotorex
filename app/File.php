<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = 'files';

    protected $fillable = [
        'original_filename',
        'filename',
        'path_to',
        'original_file_id'
    ];

    protected $appends = [
        'name',
        'public_url',
    ];

    public static function createFromFilepath($path, $original_name = null, $new_name = null)
    {
        return self::create([
            'original_filename' => ($original_name === null ? basename($path) : $original_name),
            'filename'          => ($new_name === null ? basename($path) : $new_name),
            'path_to'           =>  str_ireplace(storage_path('app'.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR), '', dirname($path)),
        ]);
    }

    public function getFullPath()
    {
        return storage_path('app'.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.$this->path_to.DIRECTORY_SEPARATOR.$this->filename);
    }

    public function getNameAttribute()
    {
        return $this->filename;
    }

    public function getPublicUrlAttribute() {
        return asset('storage/'.$this->path_to.'/'.$this->filename);
    }

    public static function removeFile($file_id)
    {
        $f = File::find($file_id);
        unlink($f->getFullPath());
        $f->delete();
    }
}
