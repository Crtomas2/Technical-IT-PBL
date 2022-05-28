<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Rap2hpoutre\FastExcel\FastExcel;

class FileUploadComponent extends Component
{
    use WithFileUploads;
    
    public $file;

    public function upload()
    {
        $file = (new FastExcel)->import($this->file);
        // dd($this->file);
    }

    public function render()
    {
        return view('livewire.file-upload-component');
    }
}
