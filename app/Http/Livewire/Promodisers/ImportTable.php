<?php

namespace App\Http\Livewire\Promodisers;

use App\Models\Promodiser_tempdata;
use Livewire\Component;
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
        $promodisers = Promodiser_tempdata::paginate(5);

        return view('livewire.promodisers.import-table', [
            'promodisers' => $promodisers
        ]);
    }
}
