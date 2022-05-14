<?php

namespace App\Http\Livewire;

use App\Models\LocationCode;
use Livewire\Component;

class StoreLocationCodePicker extends Component
{
    public $selectedLocationCode; //selected locationcode
    public $locationcodes; // Locationcode List

    protected $listeners = [
        'selectedLocationChanged' => "listLocationcode"
    ];
    
    public function updatedSelectedLocationCode()
    {
        $this->emit('selectedLocationCodeChanged', $this->selectedLocationCode);
    }
    public function listLocationcode ($locationcode)
    {
        $this->locationcodes = LocationCode::where('id', $locationcode)->get();
    }

    public function mount()
    {
        $this->locationcodes = [];
    }




    public function render()
    {
        return view('livewire.store-location-code-picker');
    }
}
