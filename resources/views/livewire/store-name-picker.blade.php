<div>
    <label for="storename" class="form-label">Store Name</label>
    <select class="form-control" name="" id="storename" wire:model="selectedStore">
        <option hidden>Choose Store</option>
        @foreach ($stores as $store)
            <option value="{{ $store->id }}">{{ $store->Storename }}</option>
        @endforeach
    </select>
</div>
