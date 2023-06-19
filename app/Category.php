<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'parent_id', 'name', 'slug',
    ];

    public function childrens()
    {
        return $this->hasMany(static::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(static::class, 'parent_id');
    }

    public static function nested($count = 0)
    {
        $query = self::whereNull('parent_id')
            ->with(['childrens' => function ($category) {
                $category->with('childrens');
            }])
            ->withCount('childrens')
            ->orderBy('childrens_count', 'desc');
        $count && $query->take($count);

        return $query->get();
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function categoryMenu()
    {
        return $this->hasOne(CategoryMenu::class);
    }
}