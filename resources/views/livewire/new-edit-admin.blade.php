<div>
    <!-- Button to open the modal -->
    <button wire:click="openModal" class="bg-blue-500 text-white px-4 py-2 rounded-md">New Admin</button>

    <!-- Modal -->
    @if($showModal)
        <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

            <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left w-full">
                                <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">New Admin</h3>
                                <div class="mt-2 w-full">
                                    <div>

                                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                        <input type="text" wire:model="name" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror

                                        <label for="email" class="block text-sm font-medium text-gray-700 mt-3">Email</label>
                                        <input type="text" wire:model="email" type="email" id="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></input>
                                        @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror

                                        <label for="password" class="block text-sm font-medium text-gray-700 mt-3">Password</label>
                                        <input type="password" wire:model="password" id="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        @error('password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5 sm:ml-10 sm:mt-4 sm:flex sm:pl-4">
                            <button wire:click="saveAdmin" class="inline-flex w-full justify-center rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 sm:w-auto">Save</button>
                            <button wire:click="closeModal" type="button" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:ml-3 sm:mt-0 sm:w-auto">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
