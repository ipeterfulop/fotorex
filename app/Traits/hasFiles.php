<?php


namespace App\Traits;


trait hasFiles
{
    public static function moveFileToStorage($path, $new_name = null)
    {
        $new_name = ($new_name===null ? basename($path) : $new_name);
        $new_path = storage_path('app'.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.static::FILE_PUBLIC_PATH);
        if (!file_exists($new_path)) {
            mkdir($new_path, 02755);
        }
        try {
            $ret = $new_path.DIRECTORY_SEPARATOR.$new_name;
            rename($path, $ret);
            return $ret;
        }
        catch (\Exception $e) {
            return false;
        }
    }
}