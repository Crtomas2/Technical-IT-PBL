<?php

namespace App\Http\Livewire;

use App\Models\Storelocation;
use Livewire\Component;

class StoreLocationPicker extends Component
{
    public $selectedLocation;   // selected location
    public $locations;          // list of locations

    protected $listeners = [
        "selectedStoreChanged" => "listLocations"
    ];

    public function updatedSelectedLocation()
    {
        if($this->selectedLocation) {
            $this->emit('selectedLocationChanged', $this->selectedLocation);
        }
    }

    public function listLocations($location)
    {
        $this->locations = Storelocation::where('id', $location)->get();
    }

    public function mount()
    {
        $this->locations = [];
    }

    public function render()
    {
        return view('livewire.store-location-picker');
    }
}
