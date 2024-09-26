<div wire:poll.2000ms>

    <h1 class="text-xl mb-4 uppercase underline font-extrabold">Recent Prayer Requests</h1>

    @foreach ( $prayers as $prayer )

        <div class="divide-y divide-gray-200 overflow-hidden rounded-lg bg-white shadow mb-4">

            <div class="px-4 py-5 sm:p-6">
                {{$prayer->request}}
            </div>
            <div class="px-4 py-4 sm:px-6">
                - {{ $prayer->name }}
            </div>
        </div>

    @endforeach
</div>
