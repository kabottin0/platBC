@props(['value'])

<label {{ $attributes->merge(['class' => 'block mt-1 w-full']) }}>
    {{ $value ?? $slot }}
</label>
