<?php

namespace App\Http\Livewire;

use App\Models\Store;
use Livewire\Component;

class StoreNamePicker extends Component
{
    public $selectedStore;  // selected store
    public $stores;         // list of all stores

    public function updatedSelectedStore()
    {
        $this->emit('selectedStoreChanged', $this->selectedStore);
    }

    public function mount()
    {
        $this->stores = Store::all();

        // dd(Store::all());
    }

    public function render()
    {
        return view('livewire.store-name-picker');
    }
}
