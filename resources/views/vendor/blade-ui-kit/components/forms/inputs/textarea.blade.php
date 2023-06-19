<textarea
    name="{{ $name }}"
    id="{{ $id }}"
    rows="{{ $rows }}"
    {{ $attributes->merge([
        'class' => 'form-control '.($errors->has($key) ? 'is-invalid' : ''),
    ]) }}
>{{ old($key, $slot) }}</textarea>
