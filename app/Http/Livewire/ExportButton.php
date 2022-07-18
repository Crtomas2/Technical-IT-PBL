<?php

namespace App\Http\Livewire;

use Illuminate\Validation\Rule;
use Livewire\Component;
use Illuminate\Support\Str;
use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Support\Facades\Storage;

class ExportButton extends Component
{
    /**
     * Get the model to be exported
     *
     * @var string
     */
    public $model = null;

    public $filename = '';

    public $filetype = '';

    public $hasError = false;

    public $message = '';

    // public string $exclude = '';

    protected $rules = [
        'model' => ['required'],
        'filetype' => [
            'required',
            'in:xlsx,csv'
        ]
    ];

    protected $messages = [
        'filetype.in' => 'The selected file type is invalid'
    ];

    public function download()
    {
        try {
            $this->validate();
            
            try {
                $model = Str::before($this->model, '::class');
            
                if (!is_subclass_of($model, 'Illuminate\Database\Eloquent\Model')) {
                    return dd($model . ' is not an instance of \'Illuminate\Database\Eloquent\Model\'');
                }

                if(!$this->model::first()) {
                    $this->hasError = true;
                    $this->message = 'Failed to download file. (Cause: no data found)';
                    return;
                }
    
                $time = time();
                $filename = $this->filename ? $this->filename . '_' . $time : $time . '.' . Str::lower($this->filetype);
                $selectedModel = $this->model::get();

                // if($this->exclude) {
                //     $excludeColumns = explode(",", $this->exclude);
                //     $selectedModel = $selectedModel->map(function ($array) use ($excludeColumns) {
                //         $array->get()->map(function ($item) use ($excludeColumns) {
                //             return $item->only($excludeColumns);
                //         });
                //     });

                //     dd($selectedModel);
                // }

                (new FastExcel($selectedModel))->export(storage_path('app/public/' . $filename));
    
                return Storage::download('public/'. $filename);
            } catch (\Exception $e) {
                return dd($e->getMessage());
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->hasError = true;

            $this->message = 'Failed to download file. (Cause: ' . $e->getMessage() . ')';
        }
    }

    public function render()
    {
        return view('livewire.export-button');
    }
}
