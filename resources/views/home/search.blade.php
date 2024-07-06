<x-app-layout>
    <x-slot name="title">Search</x-slot>

    <div class="flex flex-col items-center justify-center">
        <div class="min-h-screen w-full max-w-md overflow-hidden shadow-md">
            <x-home-menu></x-home-menu>

            <livewire:home.search :focus-input="true" />
        </div>
    </div>
</x-app-layout>
