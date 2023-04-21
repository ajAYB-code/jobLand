

@isset($attributes['href'])
    <a {{ $attributes->merge(['class' => 'btn btn-primary text-white']) }} style="background-color: var(--color-primary) !important;border: none;box-shadow: none !important;
        ">
    {{ $content }}
    </a>
@else
    <button {{ $attributes->merge(['class' => 'btn btn-primary text-white'])  }} style="background-color: var(--color-primary) !important;border: none;box-shadow: none !important;
        ">
    {{ $content }}
    </button>
@endisset