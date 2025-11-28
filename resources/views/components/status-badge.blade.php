@props(['status'])

@php
    $classes = match($status) {
        'selesai' => 'bg-green-100 text-green-800',
        'dalam_proses' => 'bg-blue-100 text-blue-800',
        'menunggu' => 'bg-yellow-100 text-yellow-800',
        'ditolak' => 'bg-red-100 text-red-800',
        default => 'bg-gray-100 text-gray-800',
    };

    $label = match($status) {
        'selesai' => 'Selesai',
        'dalam_proses' => 'Dalam Proses',
        'menunggu' => 'Menunggu',
        'ditolak' => 'Ditolak',
        default => ucfirst($status),
    };
@endphp

<span {{ $attributes->merge(['class' => "px-2 inline-flex text-xs leading-5 font-semibold rounded-full $classes"]) }}>
    {{ $label }}
</span>