<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex space-x-4">
                <div class="flex-1  p-4">
                    <livewire:recent-prayer-requests />
                </div>
                <div class="flex-1 bg-gray-200 p-4">Column 2</div>
            </div>
        </div>
    </div>
</x-app-layout>
