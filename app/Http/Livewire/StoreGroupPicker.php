<?php

namespace App\Http\Livewire;

use App\Models\Storegroup;
use Livewire\Component;

class StoreGroupPicker extends Component
{
    public $selectedStoreGroup;
    public $storeGroups;

    public function mount()
    {
        $this->storeGroups = Storegroup::all();
    }

    public function render()
    {
        return view('livewire.store-group-picker');
    }
}
