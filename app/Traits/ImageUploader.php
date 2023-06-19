<?php

namespace App\Traits;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

trait ImageUploader
{
    protected function uploadImage($file, $arg = [])
    {
        $arg += [
            'dir' => 'images',
            'width' => 250,
            'height' => 66,
        ];
        $path = implode('/', [
            date('d-M-Y'),
            $arg['dir'],
            time(),
        ]).'-'.preg_replace('/\s+/', '-', $file->getClientOriginalName());

        $image = Image::make($file);
        data_get($arg, 'resize', true)
            && $image = $image->{$arg['method'] ?? 'resize'}($arg['width'], $arg['height']);
        Storage::disk($arg['disk'] ?? 'public')->put($path, (string)$image->encode());

        return Storage::url($path);
    }
}
