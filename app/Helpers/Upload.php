<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;

final class Upload extends Helper
{
    public static function getPhotoAttribute($photo, $sectionName)
    {
        $path = realpath(public_path(config('project.uploadPath') . $sectionName .'/' . $photo));

        if (is_file($path)) {
            return url(str_replace([public_path(), '\\'], ['', '/'], $path));
        } else if (strpos($photo, 'http') !== false) {
            return $photo;
        } else {
            return url('/img/placeholder.png');
        }
    }

    public static function getThumbnailAttribute($photo, $sectionName)
    {
        $path = realpath(public_path(config('project.uploadPath') . $sectionName .'/' . preg_replace('#\.(jpg|jpeg|png)#i', '_100x100.$1', $photo)));

        if (is_file($path)) {
            return str_replace([public_path(), '\\'], ['', '/'], $path);
        } else if (strpos($photo, 'http') !== false) {
            return $photo;
        } else {
            return '/img/placeholder.png';
        }
    }

}