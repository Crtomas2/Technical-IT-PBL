<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Stores') }}
            </h2>
        </div>
    </x-slot>

    <livewire:stores-table />
</x-app-layout>