<?php

namespace App\View\Components\Forms\Inputs;

use Illuminate\Support\Str;
use BladeUIKit\Components\Forms\Inputs\Input as OriginalInput;

class Input extends OriginalInput
{
    public $key;

    public function __construct(string $name, string $id = null, string $type = 'text', $value = '')
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
        $this->type = $type;
        $this->value = old($this->key, (string)$value);
    }
}
