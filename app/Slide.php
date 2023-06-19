<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    protected $fillable = [
        'mobile_src', 'desktop_src', 'title', 'text', 'btn_name', 'btn_href', 'is_active',
    ];
}
