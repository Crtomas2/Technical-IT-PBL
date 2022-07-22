<?php

namespace App\Http\Livewire\Stores;

use Livewire\Component;
use App\Models\StoreTempData;
use Livewire\WithPagination;

class ImportTable extends Component
{
    use WithPagination;
    
    protected $listeners = [
        'refresh' => 'render',
        'tempDataUploaded' => 'render'
    ];

    public function render()
    {
        $stores = StoreTempData::paginate(5);

        return view('livewire.stores.import-table', [
            'stores' => $stores
        ]);
    }
}
