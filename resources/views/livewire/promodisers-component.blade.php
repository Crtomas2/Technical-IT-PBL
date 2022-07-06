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
                <div class="flex items-center justify-between space-x-4 px-4 py-5">
                    <x-jet-input type="text" class="block mt-1" wire:model="searchTerm" placeholder="Search" />
                    <x-jet-button wire:click="createPromodiser()">Create</x-jet-button>
                </div>
                <div class="relative max-w-full overflow-x-scroll">
                    <table class="table-auto overflow-scroll w-full max-w-full px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
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
                                <th align="center" role="button" wire:click="setSort('Firstname', '{{ $sortBy === 'Firstname' && $sortDirection === 'ASC' ? 'DESC' : 'ASC'}}')">
                                    <div class="flex items-center justify-center space-x-4 py-2 pl-8 pr-4">
                                        <span>First Name</span>
                                        @if($sortBy)
                                            @if($sortBy === 'Firstname')
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
                                <th role="button" align="center" wire:click="setSort('Lastname', '{{ $sortBy === 'Lastname' && $sortDirection === 'ASC' ? 'DESC' : 'ASC' }}')">
                                    <div class="flex items-center justify-center space-x-4 py-2 pl-8 pr-4">
                                        <span>Last Name</span>
                                        @if($sortBy)
                                            @if($sortBy === 'Lastname')
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
                                <th role="button" align="center" wire:click="setSort('Mobilenumber', '{{ $sortBy === 'Mobilenumber' && $sortDirection === 'ASC' ? 'DESC' : 'ASC' }}')">
                                    <div class="flex items-center justify-center space-x-4 py-2 pl-8 pr-4">
                                        <span>Mobile No.</span>
                                        @if($sortBy)
                                            @if($sortBy === 'Mobilenumber')
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
                                <th role="button" align="center" wire:click="setSort('LocationCode', '{{ $sortBy === 'LocationCode' && $sortDirection === 'ASC' ? 'DESC' : 'ASC' }}')">
                                    <div class="flex items-center justify-center space-x-4 py-2 pl-8 pr-4">
                                        <span>Location Code</span>
                                        @if($sortBy)
                                            @if($sortBy === 'LocationCode')
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
                            @if($promodisers->count() > 0)
                                @foreach($promodisers as $promodiser)
                                <tr>
                                    <td align="center" class="border-b border-slate-200 p-4 pl-8">{{ $promodiser->id }}</td>
                                    <td class="border-b border-slate-200 p-4 pl-8">{{ $promodiser->Firstname }}</td>
                                    <td class="border-b border-slate-200 p-4 pl-8">{{ $promodiser->Lastname }}</td>
                                    <td class="border-b border-slate-200 p-4 pl-8">{{ $promodiser->Mobilenumber }}</td>
                                    <td class="border-b border-slate-200 p-4 pl-8">{{ $promodiser->latest_assignment ? $promodiser->latest_assignment->location->LocationCode : 'none' }}</td>
                                
                                    <td align="right">
                                        <div class="flex px-4">
                                            <button type="button" wire:click.prevent="editPromodiser({{$promodiser->id}})" class="btn btn-primary ml-2">Edit</a>
                                            <button type="button" wire:click.prevent="assignPromodiser({{$promodiser->id}})" class="btn btn-primary ml-2">Assign</a>
                                            <button type="button" wire:click.prevent="deleteConfirmation({{$promodiser->id}})" class="btn btn-danger ml-2">Delete</button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr height="50">
                                    <td colspan="6">
                                        <center>No promodisers found.</center>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                    {{  $promodisers->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- start: Create -->
    <x-jet-dialog-modal wire:model="showPromodiserCreate">
        <x-slot name="title">
            Add new Promodiser
        </x-slot>
    
        <x-slot name="content">
            <form wire:submit="addPromodiserData()">
                <div class="flex flex-col sm:flex-row sm:space-x-4">
                    <div class="w-full mb-3">
                        <x-jet-label for="first_name">First name</x-jet-label>
                        <x-jet-input type="text" class="w-full mb-2" id="first_name" wire:model.defer="Firstname" />
                        <x-jet-input-error for="Firstname" />
                    </div>
                    <div class="w-full mb-3">
                        <x-jet-label for="first_name">Last name</x-jet-label>
                        <x-jet-input type="text" class="w-full mb-2" id="first_name" wire:model.defer="Lastname" />
                        <x-jet-input-error for="Lastname" />
                    </div>
                </div>
                <div class="w-full mb-3">
                    <x-jet-label for="mobile_number">Mobile number</x-jet-label>
                    <x-jet-input type="text" class="w-full mb-2" id="mobile_number" wire:model.defer="Mobilenumber" size="12" />
                    <x-jet-input-error for="Mobilenumber" />
                </div>
            </form>
        </x-slot>
    
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="cancelAdd()" wire:loading.attr="disabled">
                Cancel
            </x-jet-secondary-button>
    
            <x-jet-button class="ml-2" wire:click="storePromodiserData()" wire:loading.attr="disabled">
                <span>Add</span>
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
    <!-- end: Create -->

    <!-- start: Assign -->
    <x-jet-dialog-modal wire:model="showPromodiserAssign">
        <x-slot name="title">
            Assign Promodiser
        </x-slot>
    
        <x-slot name="content">
            <form wire:submit="editPromodiserData()">
                <div class="flex flex-col">
                    <div class="w-full mb-3">
                        <x-jet-label for="current_assignment">Current assignment: {{  $selectedPromodiser && $selectedPromodiser->latest_assignment ? 'Last Assigned: (' .  $selectedPromodiser->latest_assignment->created_at->diffForHumans() . ')' : null }} </x-jet-label>
                        <x-jet-input type="text" class="w-full mb-2" id="current_assignment" value="{{ $selectedPromodiserLocationCode }}" disabled />
                    </div>

                    <div class="w-full mb-3">
                        <x-jet-label for="assign_to">Assign to</x-jet-label>
                        <select class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full mb-2" id="assign_to" wire:model.defer="assigned_location">
                            <option value=""></option>
                            @foreach($locations as $key => $option)
                                <option value="{{ $key }}">{{ $option }}</option>
                            @endforeach
                        </select>
                        <x-jet-input-error for="assigned_location" />
                    </div>
                </div>
            </form>
        </x-slot>
    
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="cancelEdit()" wire:loading.attr="disabled">
                Cancel
            </x-jet-secondary-button>
    
            <x-jet-button class="ml-2" wire:click="assignPromodiserData()" wire:loading.attr="disabled">
                <span>Assign</span>
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
    <!-- end: Assign -->

    <!-- start: Edit -->
    <x-jet-dialog-modal wire:model="showPromodiserEdit">
        <x-slot name="title">
            Edit Promodiser Data
        </x-slot>
    
        <x-slot name="content">
            <form wire:submit="editPromodiserData()">
                <div class="flex flex-col sm:flex-row sm:space-x-4">
                    <div class="w-full mb-3">
                        <x-jet-label for="first_name">First name</x-jet-label>
                        <x-jet-input type="text" class="w-full mb-2" id="first_name" wire:model.defer="Firstname" />
                        <x-jet-input-error for="Firstname" />
                    </div>
                    <div class="w-full mb-3">
                        <x-jet-label for="first_name">Last name</x-jet-label>
                        <x-jet-input type="text" class="w-full mb-2" id="first_name" wire:model.defer="Lastname" />
                        <x-jet-input-error for="Lastname" />
                    </div>
                </div>
                <div class="w-full mb-3">
                    <x-jet-label for="mobile_number">Mobile number</x-jet-label>
                    <x-jet-input type="text" class="w-full mb-2" id="mobile_number" wire:model.defer="Mobilenumber" size="12" />
                    <x-jet-input-error for="Mobilenumber" />
                </div>
            </form>
        </x-slot>
    
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="cancelEdit()" wire:loading.attr="disabled">
                Cancel
            </x-jet-secondary-button>
    
            <x-jet-button class="ml-2" wire:click="editPromodiserData()" wire:loading.attr="disabled">
                <span>Edit</span>
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
    <!-- end: Edit -->

    <!-- start: Delete -->
    <x-jet-confirmation-modal wire:model="confirmingUserDeletion">
        <x-slot name="title">
            Delete Account
        </x-slot>
    
        <x-slot name="content">
            Are you sure you want to delete the promodiser data?
        </x-slot>
    
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="cancelDelete()" wire:loading.attr="disabled">
                Cancel
            </x-jet-secondary-button>
    
            <x-jet-danger-button class="ml-2" wire:click="confirmDelete()" wire:loading.attr="disabled">
                Confirm
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>
    <!-- end: Delete -->

</div>


