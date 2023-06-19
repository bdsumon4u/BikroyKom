<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $with = ['menuItems'];

    protected $fillable = [
        'name', 'slug',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function menuItems()
    {
        return $this->hasMany(MenuItem::class);
    }
}
