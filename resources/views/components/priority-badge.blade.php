@props(['priority'])

@php
    $classes = match($priority) {
        'tinggi' => 'bg-red-100 text-red-800',
        'sedang' => 'bg-yellow-100 text-yellow-800',
        'rendah' => 'bg-green-100 text-green-800',
        default => 'bg-gray-100 text-gray-800',
    };

    $label = match($priority) {
        'tinggi' => 'Tinggi',
        'sedang' => 'Sedang',
        'rendah' => 'Rendah',
        default => ucfirst($priority),
    };
@endphp

<span {{ $attributes->merge(['class' => "px-2 inline-flex text-xs leading-5 font-semibold rounded-full $classes"]) }}>
    {{ $label }}
</span>