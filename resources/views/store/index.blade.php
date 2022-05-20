@extends('layouts.layout')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <h2>Lists of Stores</h2>
    <div>
        <a href="{{ route('store.create') }}" class=" btn btn-primary active -2" role="button" aria-pressed="true">Create</a>
    </div>
</div>

<livewire:stores-table />
@endsection