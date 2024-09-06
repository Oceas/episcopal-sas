<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Recent Prayer Requests</h1>

    <div class="overflow-x-auto">
        <table class="table-auto w-full bg-white shadow-md rounded-lg">
            <thead class="bg-gray-200">
            <tr>
                <th class="px-4 py-2">Name</th>
                <th class="px-4 py-2 w-3/5">Request</th> <!-- Increase width for the request column -->
                <th class="px-4 py-2">Public</th>
                <th class="px-4 py-2">Reported</th>
                <th class="px-4 py-2">Reported Reason</th>
                <th class="px-4 py-2">Received</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($prayers as $prayer)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $prayer->name }}</td>
                    <td class="px-4 py-2 w-3/5">{{ $prayer->request }}</td> <!-- Keep wider cell for request -->
                    <td class="px-4 py-2">{{ $prayer->public ? 'Yes' : 'No' }}</td>
                    <td class="px-4 py-2">{{ $prayer->reported_reason }}</td>
                    <td class="px-4 py-2">{{ $prayer->reported_text }}</td>
                    <td class="px-4 py-2">{{ $prayer->created_at->format('M d, Y') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $prayers->links() }}
    </div>
</div>
