@extends('layouts.layout')

@section('content')
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

                        @livewire('promodisers-table', ['store' => $store])
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

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
	Open Form
</button>

<!-- Modal -->
<div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
           <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Name</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Enter Name" wire:model="name">
                        @error('name') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput2">Email address</label>
                        <input type="email" class="form-control" id="exampleFormControlInput2" wire:model="email" placeholder="Enter Email">
                        @error('email') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="store()" class="btn btn-primary close-modal">Save changes</button>
            </div>
        </div>
    </div>
</div>


    {{--
    <div wire:ignore.self class="modal fade" id="editPromodiserModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true"> -->
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
                                <button type="submit" class="btn btn-sm btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> -->


    <!-- <div wire:ignore.self class="modal fade" id="deletePromodiserModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
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
    </div> -->


    <!-- <div wire:ignore.self class="modal fade" id="viewPromodiserModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Promodiser Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="closeViewPromodiserModal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>ID: </th>
                                <td>{{ $view_promodiser_id }}</td>
                            </tr>


                            <tr>
                                <th>Name: </th>
                                <td>{{ $view_promodiser_Firstname }}</td>
                            </tr>


                            <tr>
                                <th>Email: </th>
                                <td>{{ $view_promodiser_Lastname }}</td>
                            </tr>


                            <tr>
                                <th>Phone: </th>
                                <td>{{ $view_promodiser_Mobilenumber }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> -->
</div> --}}


@push('scripts')
    <script>
        $(document).on('ready', function () {
            $('#addPromodiserModal').modal('show');
        })

        window.addEventListener('close-modal', event =>{
            $('#addPromodiserModal').modal('hide');
            $('#editPromodiserModal').modal('hide');
            $('#deletePromodiserModal').modal('hide');
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
    </script>
@endpush
