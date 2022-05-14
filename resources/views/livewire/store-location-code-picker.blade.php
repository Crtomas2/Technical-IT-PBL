<div>
    <label for="LocationCode" class="form-label">locationCode</label>
    <select class="form-control" name="Location Code" id="Location Code"s wire:loading.attr="disabled" @if(!$locationcodes) disabled @endif>
        @if($locationcodes)
            <option value="" selected>Choose a location Code</option>
            @foreach($locationcodes as $code)
            <option value="{{ $code->id }}">{{ $code->LocationCode }}</option>
            @endforeach
        @endif
    </select>
</div>
