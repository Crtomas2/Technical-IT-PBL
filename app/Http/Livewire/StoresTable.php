<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\StoreItem;

class StoresTable extends Component
{
    public $stores;
    public $currentStore = null;

    protected $listeners = [
        'updatedStore' => 'mount',
        'deletedStore' => 'mount'
    ];

    public function mount()
    {
        $this->stores = StoreItem::all();
    }

    public function showStore($id)
    {
        $this->currentStore = StoreItem::find($id);
        
        if($this->currentStore) {
            $this->dispatchBrowserEvent('show-modal');
        }
    }

    public function editStore($id)
    {
        $this->currentStore = StoreItem::find($id);

        if($this->currentStore) {
            $this->dispatchBrowserEvent('edit-modal');
        }
    }

    public function deleteStore($id)
    {
        $this->currentStore = StoreItem::find($id);

        if($this->currentStore) {
            $this->dispatchBrowserEvent('delete-modal');
        }
    }

    public function destroyStore($id)
    {
        $this->currentStore = StoreItem::find($id);

        $this->currentStore->delete();

        $this->currentStore = null;

        $this->emit('deletedStore');
    }

    public function render()
    {
        return view('livewire.stores-table');
    }
}