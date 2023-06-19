<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryMenu extends Model
{
    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

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
            ->with(['category', 'parent', 'childrens' => function ($category) {
                $category->with('childrens');
            }])
            ->withCount('childrens')
            ->orderBy('order');
        $count && $query->take($count);

        return $query->get();
    }
}
