<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">

            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Notifications') }}
            </h2>

            <livewire:new-notification />

        </div>

    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="table-auto w-full bg-white shadow-md rounded-lg">
                        <thead class="bg-gray-200">
                        <tr class="text-left">
                            <th class="px-4 py-2 text-left">Title</th>
                            <th class="px-4 py-2 text-left w-3/5">Message</th>
                            <th class="px-4 py-2 text-left">Scheduled Time</th>
                            <th class="px-4 py-2 text-left">Sent</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($notifications as $notification)
                            <tr class="border-t">
                                <td class="px-4 py-2">{{ $notification->title }}</td>
                                <td class="px-4 py-2 w-3/5">{{ $notification->body }}</td>
                                <td class="px-4 py-2">{{ $notification->scheduled_at->format('F j, Y, g:i A') }}</td>
                                <td class="px-4 py-2">{{ $notification->sent ? 'Yes' : 'No' }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $notifications->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
