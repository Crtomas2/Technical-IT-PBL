<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session()->has('flash.banner'))
                <div class="overflow-hidden rounded-md mb-3">
                    <x-jet-banner message="{{ session('flash.banner') }}" class="rounded-md"></x-jet-banner>
                </div>
            @endif
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex items-center justify-end px-4 py-5">
                    <x-jet-button wire:click="create()">Create</x-jet-button>
                </div>
                
                <table class="table-auto px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md w-full">
                    <thead class="px-4 py-3 bg-gray-200 text-right sm:px-6 border-b sm:rounded-bl-md sm:rounded-br-md">
                        <tr height="50">
                            <th align="center" role="button" wire:click="setSort('id','{{ $sortBy === 'id' && $sortDirection === 'ASC' ? 'DESC' : 'ASC'}}')">
                                <div class="flex items-center justify-center space-x-4 py-2 pl-8 pr-4">
                                    <span>ID</span>
                                    @if($sortBy)
                                        @if($sortBy === 'id')
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="height: 16px; width: 16px;">
                                                @if($sortDirection === 'ASC')
                                                    <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                                @else
                                                    <path fill-rule="evenodd" d="M14.707 10.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 12.586V5a1 1 0 012 0v7.586l2.293-2.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                @endif
                                            </svg>
                                        @endif
                                    @endif
                                </div>
                            </th>
                            <th align="center" role="button" wire:click="setSort('store_id', '{{ $sortBy === 'store_id' && $sortDirection === 'ASC' ? 'DESC' : 'ASC'}}')">
                                <div class="flex items-center justify-center space-x-4 py-2 pl-8 pr-4">
                                    <span>Store Name</span>
                                    @if($sortBy)
                                        @if($sortBy === 'store_id')
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="height: 16px; width: 16px;">
                                                @if($sortDirection === 'ASC')
                                                    <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                                @else
                                                    <path fill-rule="evenodd" d="M14.707 10.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 12.586V5a1 1 0 012 0v7.586l2.293-2.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                @endif
                                            </svg>
                                        @endif
                                    @endif
                                </div>
                            </th>
                            <th role="button" align="center" wire:click="setSort('storelocation_id', '{{ $sortBy === 'storelocation_id' && $sortDirection === 'ASC' ? 'DESC' : 'ASC' }}')">
                                <div class="flex items-center justify-center space-x-4 py-2 pl-8 pr-4">
                                    <span>Location</span>
                                    @if($sortBy)
                                        @if($sortBy === 'storelocation_id')
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" style="height: 16px; width: 16px;">
                                                @if($sortDirection === 'ASC')
                                                    <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                                @else
                                                    <path fill-rule="evenodd" d="M14.707 10.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 12.586V5a1 1 0 012 0v7.586l2.293-2.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                @endif
                                            </svg>
                                        @endif
                                    @endif
                                </div>
                            </th>
                            <th role="button" align="center" wire:click="setSort('locationcode_id', '{{ $sortBy === 'locationcode_id' && $sortDirection === 'ASC' ? 'DESC' : 'ASC' }}')">
                                <div class="flex items-center justify-center space-x-4 py-2 pl-8 pr-4">
                                    <span>Code</span>
                                    @if($sortBy)
                                        @if($sortBy === 'locationcode_id')
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="height: 16px; width: 16px;">
                                                @if($sortDirection === 'ASC')
                                                    <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                                @else
                                                    <path fill-rule="evenodd" d="M14.707 10.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 12.586V5a1 1 0 012 0v7.586l2.293-2.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                @endif
                                            </svg>
                                        @endif
                                    @endif
                                </div>
                            </th>
                            <th role="button" align="center" wire:click="setSort('storegroup_id', '{{ $sortBy === 'storegroup_id' && $sortDirection === 'ASC' ? 'DESC' : 'ASC' }}')">
                                <div class="flex items-center justify-center space-x-4 py-2 pl-8 pr-4">
                                    <span>Group</span>
                                    @if($sortBy)
                                        @if($sortBy === 'storegroup_id')
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="height: 16px; width: 16px;">
                                                @if($sortDirection === 'ASC')
                                                    <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                                @else
                                                    <path fill-rule="evenodd" d="M14.707 10.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 12.586V5a1 1 0 012 0v7.586l2.293-2.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                @endif
                                            </svg>
                                        @endif
                                    @endif
                                </div>
                            </th>
                            <th align="center">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @if($stores->count() > 0)
                            @foreach($stores as $store)
                            <tr>
                                <td align="center" class="border-b border-slate-200 p-4 pl-8">{{ $store->id }}</td>
                                <td class="border-b border-slate-200 p-4 pl-8">{{ $store->storeName->Storename }}</td>
                                <td align="center" class="border-b border-slate-200 p-4 pl-8">{{ $store->storeLocation->Storelocations }}</td>
                                <td class="border-b border-slate-200 p-4 pl-8">{{ $store->locationCode->LocationCode }}</td>
                                <td align="center" class="border-b border-slate-200 p-4 pl-8">{{  $store->storeGroup->StoreGroup }}</td>
                                <td align="right">
                                    <div class="flex">
                                        {{-- <button type="button" wire:click.prevent="showStore({{$store->id}})" class="btn btn-primary ml-2" data-toggle="modal" data-target="#showModal">View</button> --}}
                                        <button type="button" wire:click.prevent="editStore({{$store->id}})" class="btn btn-primary ml-2" data-toggle="modal" data-target="#editModal">Edit</a>
                                        <button type="button" wire:click.prevent="deleteStore({{$store->id}})" class="btn btn-danger ml-2" data-toggle="modal" data-target="#deleteModal">Delete</button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6">
                                    <center>No stores found.</center>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>

                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                    {{  $stores->links() }}
                </div>

            </div>
        </div>
    </div>

    <!-- start: Edit -->
    <x-jet-dialog-modal wire:model="showStoreCreate">
        <x-slot name="title">
            Add a new store
        </x-slot>

        <x-slot name="content">
            <div class="relative flex flex-col space-y-2">
                <livewire:store-dropdown />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="hideStoreCreate" wire:loading.attr="disabled">
                Close
            </x-jet-secondary-button>
            <x-jet-button wire:click="$emit('createStore')" wire:loading.attr="disabled" class="ml-2">
                Create
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

    

    <!-- start: Edit -->
    <x-jet-confirmation-modal wire:model="confirmStoreDeletion">
        <x-slot name="title">
           Delete {{ $currentStore ? $currentStore->storeName->Storename : null }}
        </x-slot>

        <x-slot name="content">
            Are you sure you want to delete "{{ $currentStore ? $currentStore->storeName->Storename : null }}"?
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="hideStoreDelete" wire:loading.attr="disabled">
                Close
            </x-jet-secondary-button>
            <x-jet-danger-button wire:click="destroyStore" wire:loading.attr="disabled" class="ml-2">
                Yes, delete
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>

    <!-- start: Edit -->
    <x-jet-dialog-modal wire:model="showStoreEdit">
        <x-slot name="title">
            {{ $currentStore ? $currentStore->storeName->Storename : null }}
        </x-slot>

        <x-slot name="content">
            <div class="relative flex flex-col space-y-2">
                @if($currentStore)
                    <livewire:edit-store-dropdown storeItem="{{$currentStore->id }}" />
                @endif
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="hideStoreEdit" wire:loading.attr="disabled">
                Close
            </x-jet-secondary-button>
            <x-jet-button wire:click="$emit('updateStore')" wire:loading.attr="disabled" class="ml-2">
                Update
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

</div>


