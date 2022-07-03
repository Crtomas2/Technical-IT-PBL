<form wire:submit.prevent="update" class="w-full">
    <div class="w-full mb-3">
        <x-jet-label for="store_location">Store location</x-jet-label>
        <select class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full mb-2" id="store_location" wire:model.defer="selectedStoreLocation">
            <option value=""></option>
            @foreach ($storeLocations as $key => $location)
                <option value="{{ $location->id }}">{{ $location->Storelocations }}</option>
            @endforeach
        </select>
        <x-jet-input-error for="selectedStoreLocation" />
    </div>
    <div class="w-full mb-3">
        <x-jet-label for="location_code">Location Code</x-jet-label>
        <select class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full mb-2" id="location_code" wire:model.defer="selectedLocationCode">
            <option value=""></option>
            @foreach ($locationCodes as $key => $code)
                <option value="{{ $code->id }}">{{ $code->LocationCode }}</option>
            @endforeach
        </select>
        <x-jet-input-error for="selectedStoreLocation" />
    </div>
    <div class="w-full mb-3">
        <x-jet-label for="store_group">Store Group</x-jet-label>
        <select class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full mb-2" id="store_group" wire:model.defer="selectedStoreGroup">
            @if($locationCodes)
                <option hidden>Choose Store Group</option>
                 @foreach ($storeGroups as $key => $group)
                    <option value="{{ $key }}">{{ $group }}</option>
                @endforeach
            @endif
        </select>
        <x-jet-input-error for="selectedStoreGroup" />
    </div>
</form>
