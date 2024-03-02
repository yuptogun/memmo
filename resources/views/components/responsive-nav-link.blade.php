@props(['active'])

@php
$classes =
    'block w-full ps-3 pe-4 py-2 text-start text-base font-medium text-white focus:outline-none transition duration-150 ease-in-out ' . (
    ($active ?? false)
        ? 'bg-binder-500'
        : 'hover:bg-binder-700');
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
