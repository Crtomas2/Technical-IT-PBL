<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\StoreItem;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class StoresTable extends Component
{
    use WithPagination;

    protected $queryString = ['sortBy', 'sortDirection'];
    
    public $currentStore = null;

    protected $listeners = [
        'updatedStore' => 'mount',
        'deletedStore' => 'mount',
        'showCreate' => 'create',
        'hideStoreCreate' => 'hideStoreCreate'
    ];

    /**
     * Modal Variables
     * 
     */
    public $showStoreEdit = false;
    public $showStoreCreate = false;
    public $confirmStoreDeletion = false;

    public $sortBy = 'ID';
    public $sortDirection = 'ASC';

    public function cancelEdit()
    {
        $this->showStoreEdit = false;

        $this->reset();
    }




    public function mount()
    {
        $this->storeitem = StoreItem::all();
    }
    public function create()
    {
        $this->showStoreCreate = true;
    }

    public function hideStoreCreate()
    {
        $this->showStoreCreate = false;

        $this->emit('hideStoreCreateModal');
    }

    public function editStore($id)
    {
        $this->currentStore = StoreItem::find($id);

        if($this->currentStore) {
            $this->showStoreEdit = true;
        }
    }

    public function hideStoreEdit()
    {
        $this->showStoreEdit = false;

        $this->currentStore = null;

    }

    public function deleteStore($id)
    {
        $this->currentStore = StoreItem::find($id);

        $this->confirmStoreDeletion = true;
    }

    public function hideStoreDelete()
    {
        $this->confirmStoreDeletion = false;
        
        $this->currentStore = null;
    }

    public function destroyStore()
    {
        try {
            DB::beginTransaction();
            
            $this->currentStore->delete();

            DB::commit();

            $this->hideStoreDelete();

            session()->flash('flash.banner', 'Store deleted successfully!');
        } catch (\Exception $e) {
            DB::rollback();

            session()->flash('flash.banner', 'Store deleted successfully!');
            session()->flash('flash.bannerStyle', 'danger');

        }


    }


    public function setSort($query ,$direction)
    {
        $this->sortBy = $query;
        $this->sortDirection = $direction;
    }

    public function render()
    {
        $stores = StoreItem::orderBy($this->sortBy, $this->sortDirection)->paginate(4);

        return view('livewire.stores-table', compact('stores'));
    }
}