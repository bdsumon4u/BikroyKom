<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class ModelRepository {

    protected $model;

    public function setModel($model = null)
    {
        if (! $model) {
            $name = Str::beforeLast(Str::afterLast(debug_backtrace()[1]['class'], '\\'), 'Controller');
            $model = 'App\\'.$name;
        }

        $this->model = $model;

        return $this;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function newModel()
    {
        return new $this->model;
    }

    public function paginate($count = 15)
    {
        return Cache::remember($this->model, 10, function () use ($count) {
            return $this->newModel()->paginate($count);
        });
    }

}