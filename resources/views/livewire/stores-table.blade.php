<div>
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <td>ID</td>
                <td>Store Name</td>
                <td>Location</td>
                <td>Code</td>
                <td>Group</td>
                <td align="right">Actions</td>
            </tr>
        </thead>
        <tbody>
            @if($stores->count() > 0)
                @foreach($stores as $store)
                <tr>
                    <td>{{ $store->id }}</td>
                    <td>{{ $store->storeName->Storename }}</td>
                    <td>{{ $store->storeLocation->Storelocations }}</td>
                    <td>{{ $store->locationCode->LocationCode }}</td>
                    <td>{{  $store->storeGroup->StoreGroup }}</td>
                    <td align="right">
                        <div class="flex">
                            <button type="button" wire:click.prevent="showStore({{$store->id}})" class="btn btn-primary ml-2" data-toggle="modal" data-target="#showModal">View</button>
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

    {{-- Show Modal--}}
    @if($currentStore)
    <div wire:ignore.self class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledBy="showModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showModalLabel">{{  $currentStore->storeName->Storename }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true" class="close-btn">x</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <tr>
                            <td><strong>Store Name</strong></td>
                            <td>{{ $currentStore->storeName->Storename }}</td>
                        </tr>
                        <tr>
                            <td><strong>Location</strong></td>
                            <td>{{ $currentStore->storeLocation->Storelocations }}</td>
                        </tr>
                        <tr>
                            <td><strong>Code</strong></td>
                            <td>{{ $currentStore->locationCode->LocationCode }}</td>
                        </tr>
                        <tr>
                            <td><strong>Group</strong></td>
                            <td>{{ $currentStore->storeGroup->StoreGroup }}</td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                    <button type="button" wire:click.prevent="editStore({{$store->id}})" class="btn btn-primary close-modal" data-dismiss="modal">Edit</button>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- Edit Modal--}}
    @if($currentStore)
    <div wire:ignore.self class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledBy="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showModalLabel">{{  $currentStore->storeName->Storename }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true" class="close-btn">x</span>
                    </button>
                </div>
                <div class="modal-body">
                    <livewire:edit-store-dropdown storeItem="{{ $currentStore->id }}" />
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- Delete Modal--}}
    @if($currentStore)
    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledBy="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete {{ $currentStore->storeName->Storename }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true" class="close-btn">x</span>
                    </button>
                </div>
                <div class="modal-body">
                    Do you want to delete <strong>{{  $currentStore->storeName->Storename }}</strong>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Cancel</button>
                    <button type="button" wire:click.prevent="destroyStore({{$store->id}})" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">Yes, delete</button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <script>
        window.addEventListener('show-modal', event => {
            $('#showModal').modal('show');
        })
        window.addEventListener('edit-modal', event => {
            $('#editModal').modal('show');
            $('#showModal').modal('hide');
        })
        window.addEventListener('delete-modal', event => {
            $('#editModal').modal('hide');
            $('#showModal').modal('hide');
            $('#deleteModal').modal('show');
        })
        window.addEventListener('close-modal', event => {
            $('#editModal').modal('hide');
            $('#showModal').modal('hide');
            $('#deleteModal').modal('hide');
        })
    </script>
</div>
