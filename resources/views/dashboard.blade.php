<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <!-- Core stats on the left in desktop/tablet, first on mobile -->
                <div class="p-4">
                    <livewire:core-stats />
                </div>
                <!-- Recent prayer requests on the right in desktop/tablet, second on mobile -->
                <div class="p-4">
                    <livewire:recent-prayer-requests />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
