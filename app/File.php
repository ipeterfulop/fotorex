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

    protected $appends = ['name'];

    public static function createFromFilepath($path, $original_name = null, $new_name = null)
    {
        return self::create([
            'original_filename' => ($original_name === null ? basename($path) : $original_name),
            'filename'          => ($new_name === null ? basename($path) : $new_name),
            'path_to'           =>  dirname($path),
        ]);
    }

    public function getFullPath()
    {
        return $this->path_to.DIRECTORY_SEPARATOR.$this->filename;
    }

    public function getNameAttribute()
    {
        return $this->filename;
    }

    public function getPublicUrlAttribute() {
        return $this->path_to.DIRECTORY_SEPARATOR.$this->filename;
    }
}
