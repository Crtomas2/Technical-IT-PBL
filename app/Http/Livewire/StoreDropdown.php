<?php

namespace App\Http\Livewire;

use App\Models\Store;
use Livewire\Component;
use App\Models\StoreItem;
use App\Models\Storegroup;
use App\Models\LocationCode;
use App\Models\Storelocation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class StoreDropdown extends Component
{
    
    /*
    |--------------------------------------------------------------
    | Instantiate variables
    |--------------------------------------------------------------
    */
    public $selectedStoreName, $selectedStoreLocation, $selectedLocationCode, $selectedStoreGroup;
    public $storeNames = [], $storeLocations = [], $locationCodes = [], $storeGroups = [];

    /*
    |--------------------------------------------------------------
    | When values change
    |--------------------------------------------------------------
    */
    public function updatedSelectedStoreName()
    {
        $this->listStoreLocations();
    }

    public function updatedSelectedStoreLocation()
    {
        $this->listLocationCodes();
    }

    /*
    |--------------------------------------------------------------
    | List when variables change
    |--------------------------------------------------------------
    */
    public function listStoreLocations()
    {
        $this->storeLocations = Storelocation::where('id', $this->selectedStoreName)->get();
    }

    public function listLocationCodes()
    {
        $this->locationCodes = LocationCode::where('id', $this->selectedStoreLocation)->get();
    }

    public function submit()
    {
        try {
            DB::beginTransaction();

            $storeItem = StoreItem::create([
                'store_id' => $this->selectedStoreName,
                'storelocation_id' => $this->selectedStoreLocation,
                'locationcode_id' => $this->selectedLocationCode,
                'storegroup_id' => $this->selectedStoreGroup
            ]);

            DB::commit();

            Redirect::to(route('store.index'));
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['message' => $e->getMessage()]);
        }
    }

    public function mount()
    {
        $this->storeNames = Store::pluck('Storename', 'id');
        $this->storeLocations = [];
        $this->locationCodes = [];
        $this->storeGroups = Storegroup::pluck('StoreGroup', 'id');

        // Store::all() -> all columns of store
        // Store::pluck() -> key-value pair ('id', 'name');
    }

    public function render()
    {
        return view('livewire.store-dropdown');
    }
}
