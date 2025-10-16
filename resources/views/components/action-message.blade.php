@props([
    'on',
    'type' => 'success' // default to success
])

@php
    $baseClasses = 'text-sm px-4 py-2 rounded-md transition-opacity duration-500';
    $colorClasses = match ($type) {
        'success' => 'bg-green-100 text-green-800 border border-green-300',
        'error' => 'bg-red-100 text-red-800 border border-red-300',
        'info' => 'bg-blue-100 text-blue-800 border border-blue-300',
        'warning' => 'bg-yellow-100 text-yellow-800 border border-yellow-300',
        default => 'bg-gray-100 text-gray-800 border border-gray-300',
    };
@endphp

<div
    x-data="{ shown: false, timeout: null }"
    x-init="@this.on('{{ $on }}', () => {
        clearTimeout(timeout);
        shown = true;
        timeout = setTimeout(() => { shown = false }, 6000);
    })"
    x-show.transition.out.opacity.duration.1500ms="shown"
    x-transition:leave.opacity.duration.1500ms
    style="display: none"
    {{ $attributes->merge(['class' => "$baseClasses $colorClasses"]) }}
>
    {{ $slot->isEmpty() ? __('Saved.') : $slot }}
</div>
