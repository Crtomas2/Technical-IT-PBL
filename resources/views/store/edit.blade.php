@extends('layouts.layout')

@section('content')
<div class="container mb-3">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <h1 class="fs-5 fw-bold my-4 text-center">Manage Stores Edge Scanner</h1>
    <div class="row">
        @livewire('edit-store-dropdown', ['storeItem' => $store->id])
    </div>
</div>
@endsection