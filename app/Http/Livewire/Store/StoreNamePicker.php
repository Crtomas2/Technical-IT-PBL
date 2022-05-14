<?php

namespace App\Models\Store;

use App\Models\Store;
use Livewire\Component;

class StoreNamePicker extends Component
{
    public $selectedStore;  // selected store
    public $stores;         // list of all stores

    public function mount()
    {
        $this->stores = Store::all();
    }

    public function render()
    {
        return view('livewire.store.store-name-picker');
    }
}
