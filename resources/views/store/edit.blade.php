@extends('layouts.layout')

@section('content')
<div class="container mb-3">
    <h1 class="fs-5 fw-bold my-4 text-center">Manage Stores Edge Scanner</h1>
    <div class="row">
        @livewire('edit-store-dropdown', ['storeItem' => $store->id])
    </div>
</div>
@endsection