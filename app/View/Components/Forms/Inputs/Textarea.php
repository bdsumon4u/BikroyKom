<?php

namespace App\View\Components\Forms\Inputs;

use Illuminate\Support\Str;
use BladeUIKit\Components\Forms\Inputs\Textarea as OriginalTextarea;

class Textarea extends OriginalTextarea
{
    public $key;

    public function __construct(string $name, string $id = null, $rows = 3)
    {
        $this->name = $name;
        $this->key = Str::containsAll($name, ['[', ']'])
            ? Str::of($name)
                ->replace('[]', '.*')
                ->replace(['][', '[', ']'], '.')
                ->replaceMatches('/\.+/', '.')
                ->rtrim('.')
                ->__toString()
            : $name;
        $this->id = $id ?? $name;
        $this->rows = $rows;
    }
}
