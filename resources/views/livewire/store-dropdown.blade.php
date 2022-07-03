<form wire:submit.prevent="submit">
    <div class="w-full mb-3">
        <label for="storename" class="form-label">Store Name</label>
        <select class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full mb-2" id="storename" wire:model="selectedStoreName">
            <option hidden>Choose Store</option>
            @foreach ($storeNames as $key => $store)
                <option value="{{ $key }}">{{ $store }}</option>
            @endforeach
        </select>
    </div>
    <div class="w-full mb-3">
        <x-jet-label for="store_location">Store location</x-jet-label>
        <select class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full mb-2 disabled:bg-gray-200" id="store_location" wire:model="selectedStoreLocation" @disabled(!$storeLocations)>
            <option hidden>Choose a location</option>
            @foreach ($storeLocations as $key => $location)
                <option value="{{ $location->id }}">{{ $location->Storelocations }}</option>
            @endforeach
        </select>
        <x-jet-input-error for="selectedStoreLocation" />
    </div>
    <div class="w-full mb-3">
        <x-jet-label for="location_code">Location Code</x-jet-label>
        <select class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full mb-2 disabled:bg-gray-200" id="location_code" wire:model="selectedLocationCode" @disabled(!$locationCodes)>
            <option hidden>Choose a location code</option>
            @foreach ($locationCodes as $key => $code)
                <option value="{{ $code->id }}">{{ $code->LocationCode }}</option>
            @endforeach
        </select>
        <x-jet-input-error for="selectedStoreLocation" />
    </div>
    <div class="w-full mb-3">
        <x-jet-label for="store_group">Store Group</x-jet-label>
        <select class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full mb-2 disabled:bg-gray-200" id="store_group" wire:model.defer="selectedStoreGroup" @disabled(!$locationCodes)>
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
