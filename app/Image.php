<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $appends = ['size_human'];

    protected $fillable = [
        'filename', 'disk', 'path', 'extension', 'mime', 'size',
    ];

    public function getSizeHumanAttribute()
    {
        $bytes = $this->size;
        $units = ['B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB'];

        for ($i = 0; $bytes > 1024; $bytes /= 1024, $i++);
        return round($bytes, 2) . ' ' . $units[$i];
    }

    public function getSrcAttribute()
    {
        return asset($this->path);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
