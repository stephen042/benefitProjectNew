<x-layouts.app.sidebar :title="$title ?? null">
    <flux:main>
        {{ $slot }}
        <x-bottom-nav ></x-bottom-nav>
    </flux:main>
</x-layouts.app.sidebar>
