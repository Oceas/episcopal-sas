<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">

            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Admins') }}
            </h2>

            <livewire:new-edit-admin />
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full bg-white shadow-md rounded-lg">
                            <thead class="bg-gray-200">
                            <tr class="text-left">
                                <th class="px-4 py-2 text-left">Name</th>
                                <th class="px-4 py-2 text-left">Email</th>
                                <th class="px-4 py-2 text-left">Last Logged In</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($admins as $admin)
                                <tr class="border-t">
                                    <td class="px-4 py-2">{{ $admin->name }}</td>
                                    <td class="px-4 py-2">{{ $admin->email }}</td>
                                    <td class="px-4 py-2">
                                        @if($admin->last_logged_in)
                                            {{ $admin->last_logged_in->format('M d, Y h:i A') }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $admins->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
