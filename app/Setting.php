<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = [
        'name', 'value',
    ];

    public static function booted()
    {
        static::saved(function () {
            Cache::put('settings', static::array());
        });
    }

    public static function array()
    {
        return self::all()->flatMap(function ($setting) {
            return [$setting->name => $setting->value];
        })->toArray();
    }

    public function setValueAttribute($value)
    {
        $this->attributes['value'] = json_encode($value);
    }

    public function getValueAttribute($value)
    {
        return json_decode($value);
    }
}
