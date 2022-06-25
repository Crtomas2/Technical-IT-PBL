<div>
    <div class="container mt-5">
        <div class="row mb-5">
            <div class="col-md-12 text-center">
                <h3><strong>Edge Scanner Promo Merchandiser Form</strong></h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 style="float: left;"><strong>Lists of Promodisers</strong></h5>
                        <button class="btn btn-sm btn-primary" style="float: right;" data-toggle="modal" data-target="#addPromodiserModal">Add New Promodisers</button>
                    </div>
                    <div class="card-body">
                        @if (session()->has('message'))
                            <div class="alert alert-success text-center">{{ session('message') }}</div>
                        @endif


                        <div class="row mb-3">
                            <div class="col-md-12">
                                <input type="search" class="form-control w-25" placeholder="search" wire:model="searchTerm" style="float: right;" />
                            </div>
                        </div>

                        <div class="w-full max-w-full overflow-scroll">
                            <table class="table table-bordered max-w-full">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Firstname</th>
                                        <th>Lastname</th>
                                        <th>Mobile Number</th>
                                        <th>Location Code</th>
                                        <th style="text-align: center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($promodisers->count() > 0)
                                        @foreach ($promodisers as $promodiser)
                                            <tr>
                                                <td>{{ $promodiser->promodiser_id }}</td>
                                                <td>{{ $promodiser->Firstname }}</td>
                                                <td>{{ $promodiser->Lastname }}</td>
                                                <td>{{ $promodiser->Mobilenumber }}</td>
                                                <td>{{ $promodiser->latest_assignment ? $promodiser->latest_assignment->location->LocationCode : 'none' }}</td>

                                                <td style="text-align: center;">
                                                    <button class="btn btn-sm btn-primary" wire:click="viewPromodiserDetails({{ $promodiser->id }})">View</button>
                                                    <button class="btn btn-sm btn-secondary" wire:click="editPromodisers({{ $promodiser->id }})">Edit</button>
                                                    <button class="btn btn-sm btn-secondary" wire:click="showAssignPromodiser({{ $promodiser->id }})">Assign</button>
                                                    <button class="btn btn-sm btn-danger" wire:click="deleteConfirmation({{ $promodiser->id }})">Delete</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4" style="text-align: center;"><small>No Promodiser Found</small></td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        <div class="w-full">
                            {{-- @dump($promodisers) --}}

                            {{  $promodisers->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="addPromodiserModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Promo Merchandiser</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <form wire:submit.prevent="storePromodiserData">
                        <div class="form-group row">
                            <label for="promodiser_id" class="col-3">Promodiser ID</label>
                            <div class="col-9">
                                <input type="number" id="promodiser_id" class="form-control" wire:model="promodiser_id">
                                @error('promodiser_id')
                                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="Firstname" class="col-3">Firstname</label>
                            <div class="col-9">
                                <input type="text" id="Firstname" class="form-control" wire:model="Firstname">
                                @error('Firstname')
                                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="Lastname" class="col-3">Lastname</label>
                            <div class="col-9">
                                <input type="text" id="Lastname" class="form-control" wire:model="Lastname">
                                @error('Lastname')
                                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="Mobilenumber" class="col-3">Mobilenumber</label>
                            <div class="col-9">
                                <input type="number" id="Mobilenumber" class="form-control" wire:model="Mobilenumber">
                                @error('Mobilenumber')
                                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                


                        <div class="form-group row">
                            <label for="" class="col-3"></label>
                            <div class="col-9">
                                <button type="submit" class="btn btn-sm btn-primary">Add Promodisers</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div wire:ignore.self class="modal fade" id="editPromodiserModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Promodisers</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <form wire:submit.prevent=" editPromodiserData">
                        <div class="form-group row">
                            <label for="promodiser_id" class="col-3">Promodisers ID</label>
                            <div class="col-9">
                                <input type="number" id="promodiser_id" class="form-control" wire:model="promodiser_id">
                                @error('promodiser_id')
                                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="Firstname" class="col-3">Firstname</label>
                            <div class="col-9">
                                <input type="text" id="Firstname" class="form-control" wire:model="Firstname">
                                @error('Firstname')
                                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="Lastname" class="col-3">Lastname</label>
                            <div class="col-9">
                                <input type="text" id="Lastname" class="form-control" wire:model="Lastname">
                                @error('Lastname')
                                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="Mobilenumber" class="col-3">Mobilenumber</label>
                            <div class="col-9">
                                <input type="number" id="Mobilenumber" class="form-control" wire:model="Mobilenumber">
                                @error('Mobilenumber')
                                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-3"></label>
                            <div class="col-9">
                                <button type="submit" class="btn btn-sm btn-primary">Edit Promodiser</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div wire:ignore.self class="modal fade" id="deletePromodiserModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pt-4 pb-4">
                    <h6>Are you sure? You want to delete this Promodisers data!</h6>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-primary" wire:click="cancel()" data-dismiss="modal" aria-label="Close">Cancel</button>
                    <button class="btn btn-sm btn-danger" wire:click="deletePromodiserData()">Yes! Delete</button>
                </div>
            </div>
        </div>
    </div>


    <div wire:ignore.self class="modal fade" id="viewPromodiserModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Promodiser Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="closeViewPromodiserModal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if($selectedPromodiser)
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>ID: </th>
                                <td>{{ $selectedPromodiser->promodiser_id }}</td>
                            </tr>
                            <tr>
                                <th>Name: </th>
                                <td>{{ $selectedPromodiser->Firstname . ' ' . $selectedPromodiser->Lastname }}</td>
                            </tr>
                            <tr>
                                <th>Mobile number: </th>
                                <td>{{ $selectedPromodiser->Mobilenumber }}</td>
                            </tr>
                            <tr>
                                <th>Current Location: </th>
                                <td>{{ $selectedPromodiser->latest_assignment ? $selectedPromodiser->latest_assignment->location->LocationCode : 'none' }}</td>
                            </tr>
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="assignPromodiserModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="assignPromodiserTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="assignPromodiserTitle">Assign Promodiser</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="closeViewPromodiserModal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if($selectedPromodiser)
                    <form wire:submit.prevent="assignPromodiser({{ $selectedPromodiser->id }})">
                        <div class="form-group row">
                            <label for="current_location" class="col-3">Current Location</label>
                            <div class="col-9">
                                <span>{{ $selectedPromodiser->latest_assignment ? $selectedPromodiser->latest_assignment->location->LocationCode : '' }}</span>
                                @error('current_location')
                                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Location_code" class="col-3">Location Code</label>
                            <div class="col-9">
                                <input id="assigned_location" class="form-control" wire:model.defer="assigned_location">
                                @error('assigned_location')
                                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-9"></label>
                            <div class="col-3">
                                <button type="submit" class="btn btn-sm btn-primary">Assign</button>
                            </div>
                        </div>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


@push('scripts')
    <script>
        window.addEventListener('close-modal', event =>{
            $('#addPromodiserModal').modal('hide');
            $('#editPromodiserModal').modal('hide');
            $('#deletePromodiserModal').modal('hide');
            $('#assignPromodiserModal').modal('hide');
        });
        window.addEventListener('show-edit-promodiser-modal', event =>{
            $('#editPromodiserModal').modal('show');
        });
        window.addEventListener('show-delete-confirmation-modal', event =>{
            $('#deletePromodiserModal').modal('show');
        });
        window.addEventListener('show-view-promodiser-modal', event =>{
            $('#viewPromodiserModal').modal('show');
        });
        window.addEventListener('assign-promodiser-modal', event =>{
            $('#assignPromodiserModal').modal('show');
        });
        window.addEventListener('hide-assign-promodiser-modal', event =>{
            $('#assignPromodiserModal').modal('hide');
        });
    </script>
@endpush


