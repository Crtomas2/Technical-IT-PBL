<div>
    <label for="StoreGroup" class="form-label">locationCode</label>
    <select class="form-control" name="StoreGroup" id="StoreGroup"s wire:loading.attr="disabled" @if(!$storeGroups) disabled @endif>
        @if($storeGroups)
            <option value="">Choose a Store Group</option>
            @foreach($storeGroups as $group)
            <option value="{{ $group->id }}">{{ $group->StoreGroup }}</option>
            @endforeach
        @endif
    </select>
</div>

