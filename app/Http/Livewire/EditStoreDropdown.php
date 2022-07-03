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

class EditStoreDropdown extends Component
{
    
    /*
    |--------------------------------------------------------------
    | Instantiate variables
    |--------------------------------------------------------------
    */
    public $selectedStoreName, $selectedStoreLocation, $selectedLocationCode, $selectedStoreGroup;
    public $storeNames = [], $storeLocations = [], $locationCodes = [], $storeGroups = [];
    public $storeItem;

    /**
     * Listeners
     */
    protected $listeners = [
        'updateStore' => 'update'
    ];

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

    public function update()
    {
        try {
            DB::beginTransaction();

            $storeItem = StoreItem::find($this->storeItem)->update([
                'store_id' => $this->selectedStoreName,
                'storelocation_id' => $this->selectedStoreLocation,
                'locationcode_id' => $this->selectedLocationCode,
                'storegroup_id' => $this->selectedStoreGroup
            ]);

            DB::commit();

            session()->flash('message', 'Store Item was updated successfully');

            $this->dispatchBrowserEvent('close-modal');
            $this->emit('updatedStore');
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['message' => $e->getMessage()]);
        }
    }

    public function delete()
    {
        $storeItem = StoreItem::find($this->storeItem);
        $storeItem->delete();

        session()->flash('message', 'Store Item was deleted successfully');

        return redirect()->to(route('store.index'));
    }

    public function mount()
    {
        $store = StoreItem::find($this->storeItem);

        // dd($store);
        $this->selectedStoreName = $store->store_id;
        $this->selectedStoreLocation = $store->storelocation_id;
        $this->selectedLocationCode = $store->locationcode_id;
        $this->selectedStoreGroup = $store->storegroup_id;

        $this->storeNames = Store::pluck('Storename', 'id');
        $this->storeLocations = Storelocation::where('id', $this->selectedStoreLocation)->get();
        $this->locationCodes = LocationCode::where('id', $this->selectedLocationCode)->get();
        $this->storeGroups = Storegroup::pluck('StoreGroup', 'id');

        // Store::all() -> all columns of store
        // Store::pluck() -> key-value pair ('id', 'name');
    }

    public function render()
    {
        return view('livewire.edit-store-dropdown');
    }
}
