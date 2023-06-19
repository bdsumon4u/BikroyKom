<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HomeSection extends Model
{
    protected $fillable = [
        'title', 'type', 'order', 'data',
    ];

    public function setDataAttribute($data)
    {
        $this->attributes['data'] = json_encode($data);
    }

    public function getDataAttribute($data)
    {
        return json_decode($data);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function products($limited = true, $paginate = 0)
    {
        $rows = $this->data->rows ?? 3;
        $cols = $this->data->cols ?? 5;
        $categories = $this->categories->pluck('id')->toArray();
        $query = Product::whereIsActive(1)
            ->whereHas('categories', function ($query) use ($categories) {
                $query->whereIn('categories.id', $categories);
            })
            // ->inRandomOrder()
            ->when($limited, function ($query) use ($rows, $cols) {
                $query->take($rows * $cols);
            });

        return $paginate
            ? $query->paginate($paginate)
            : $query->get();
    }
}
