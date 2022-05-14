<div>
    <label for="Storelocations" class="form-label">Storelocation</label>
    <select class="form-control" name="Storelocations" id="Storelocations" wire:model="selectedLocation" wire:loading.attr="disabled" @if(!$locations) disabled @endif>
        @if($locations)
            <option value="" selected>Choose a location</option>
            @foreach($locations as $location)
            <option value="{{ $location->id }}">{{ $location->Storelocations }}</option>
            @endforeach
        @endif
    </select>
</div>
