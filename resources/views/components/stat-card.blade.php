@props(['title', 'value', 'change', 'icon', 'color' => 'blue'])

@php
    $colorClasses = [
        'blue' => 'bg-blue-100 text-blue-600',
        'green' => 'bg-green-100 text-green-600',
        'yellow' => 'bg-yellow-100 text-yellow-600',
        'purple' => 'bg-purple-100 text-purple-600',
        'red' => 'bg-red-100 text-red-600',
    ];

    $iconClass = $colorClasses[$color] ?? $colorClasses['blue'];
@endphp

<div {{ $attributes->merge(['class' => 'bg-white overflow-hidden shadow-sm sm:rounded-lg p-6']) }}>
    <div class="flex items-center justify-between">
        <div>
            <p class="text-sm text-gray-600 mb-1">{{ $title }}</p>
            <h3 class="text-3xl font-bold text-gray-900 mb-1">{{ $value }}</h3>
            <p class="text-sm {{ str_starts_with($change, '+') ? 'text-green-600' : (str_starts_with($change, '-') ? 'text-red-600' : 'text-gray-600') }}">
                {{ $change }} dari bulan lalu
            </p>
        </div>
        <div class="{{ $iconClass }} p-3 rounded-lg">
            {{ $icon }}
        </div>
    </div>
</div>