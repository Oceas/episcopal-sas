<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Devices') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="table-auto w-full bg-white shadow-md rounded-lg">
                        <thead class="bg-gray-200">
                        <tr class="text-left">
                            <th class="px-4 py-2 text-left">VID</th>
                            <th class="px-4 py-2 text-left">Brand</th>
                            <th class="px-4 py-2 text-left">Year</th>
                            <th class="px-4 py-2 text-left">App Version</th>
                            <th class="px-4 py-2 text-left">Push Token</th>
                            <th class="px-4 py-2 text-left">Registered</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($devices as $device)
                            <tr class="border-t">
                                <td class="px-4 py-2">{{ $device->vid }}</td>
                                <td class="px-4 py-2">{{ $device->brand }}</td>
                                <td class="px-4 py-2">{{ $device->device_year_class }}</td>
                                <td class="px-4 py-2">{{ $device->app_version }}</td>
                                <td class="px-4 py-2">{{ $device->push_token }}</td>
                                <td class="px-4 py-2">{{ $device->created_at->format('M d, Y') }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $devices->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
