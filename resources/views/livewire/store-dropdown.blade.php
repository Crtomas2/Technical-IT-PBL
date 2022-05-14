<form wire:submit.prevent="submit">
    <div class="mb-3">
         <label for="storename" class="form-label">Store Name</label>
        <select class="form-control" name="" id="storename" wire:model="selectedStoreName">
            <option hidden>Choose Store</option>
            @foreach ($storeNames as $key => $store)
                <option value="{{ $key }}">{{ $store }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="storename" class="form-label">Store Location</label>
        <select class="form-control" name="" id="storename" wire:model="selectedStoreLocation" wire:loading.attr="disabled" @if(!$storeLocations) disabled @endif>
            @if($storeLocations)
                <option hidden>Choose Location</option>
                @foreach ($storeLocations as $key => $location)
                    <option value="{{ $location->id }}">{{ $location->Storelocations }}</option>
                @endforeach
            @endif
        </select>
    </div>
    <div class="mb-3">
        <label for="storename" class="form-label">Location Code</label>
        <select class="form-control" id="storename" wire:model="selectedLocationCode" wire:loading.attr="disabled" @if(!$locationCodes) disabled @endif>
            @if($locationCodes)
                <option hidden>Choose Location Code</option>
                @foreach ($locationCodes as $key => $code)
                    <option value="{{ $code->id }}">{{ $code->LocationCode }}</option>
                @endforeach
            @endif
        </select>
    </div>
    <div class="mb-3">
        <label for="storename" class="form-label">Store Group</label>
        <select class="form-control" name="" id="store-group" wire:model="selectedStoreGroup">
            <option hidden>Choose Store Group</option>
            @foreach ($storeGroups as $key => $group)
                <option value="{{ $key }}">{{ $group }}</option>
            @endforeach
        </select>
    </div>
    <center><button type="submit" class="btn btn-block btn-danger">SUBMIT</button></center>
</form>
