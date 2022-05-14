@extends('layouts.base')

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
                        <button class="btn btn-sm btn-primary" style="float: right;" data-toggle="modal" data-target="addPromodiserModal">Add New Promodisers</button>
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

                        @livewire('promodisers-table')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection