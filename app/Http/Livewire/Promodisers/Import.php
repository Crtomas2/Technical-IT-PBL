<?php

namespace App\Http\Livewire\Promodisers;

use Livewire\Component;
use App\Jobs\FileUploadJob;
use Livewire\WithFileUploads;
use App\Models\Promodisers;
use Illuminate\Support\Facades\DB;
use App\Models\Promodiser_tempdata as TempData;
use Rap2hpoutre\FastExcel\FastExcel;
use WireUi\Traits\Actions;

class Import extends Component
{
    use WithFileUploads, Actions;

    public $active;

    public $file;

    protected $listeners = [
        'toggleImport' => 'toggleActive'
    ];

    public function toggleActive($active)
    {
        $this->active = $active;
    }

    public function updatedFile()
    {
        $this->validate(
            [ 'file' => ['required', 'max:20480', 'mimes:csv,xlsx,xls,mp3']]
        );

        // dd($this->file);
    }

    public function import()
    {
        try {            
            // dd($this->file);

            // Validate if file uploaded has mime type of csv, xlsx, or xls
            $this->validate(
                [ 'file' => ['required', 'max:20480', 'mimes:csv,xlsx,xls,mp3']]
            );

            // Delete all rows on the temp_data table
            // TempData::truncate();

            $file = $this->file->store('imports');

            // dd(storage_path('app\\' . $file));

            // Insert new rows to the 'temp_data' table
            $collection = (new FastExcel())->import(storage_path('app\\' . $file), function ($line) {
                return TempData::create([
                    'firstname' => $line['firstname'],
                    'lastname' => $line['lastname'],
                    'mobile_number' =>$line['mobile_number'],
                ]);
            });

            $this->emit('refresh');

        } catch (\Exception $e) {
            // Return an error
            $this->addError('file', $e->getMessage());
        }
    }

    public function upload()
    {
        $promodisertemp_data  = TempData::get();

        $chunkSize = 20;

        try {
            DB::beginTransaction();

            $failedData = collect();
            if($promodisertemp_data->count() >= $chunkSize) {
                foreach($promodisertemp_data->chunk($chunkSize) as $chunk) {
                    foreach($chunk as $row) {
                        // dd($row);
                        try{
                            Promodisers::insert([
                                'Firstname' => $row->firstname,
                                'Lastname' => $row->lastname,
                                'Mobilenumber'=> $row->mobile_number,
                            ]);      
                        } catch(\Exception $e) {
                            $failedData->push($row);
                        }
                       
                        // dispatch(new FileUploadJob($row));
                    }
                }
            } else {
                foreach($promodisertemp_data as $row) {
                    //dd('else', $row);
                    try{
                        Promodisers::insert([
                            'Firstname' => $row->firstname,
                            'Lastname' => $row->lastname,
                            'Mobilenumber'=> $row->mobile_number,
                        ]);      
                    } catch(\Exception $e) {
                        $failedData->push($row);
                    }
                   
                }
            }
            
            DB::commit();
   
            // Get the count of rows in the 'temp_data' table
            $dataCount = $promodisertemp_data->count();

    
            // Remove the current data on 'temp_data' table after successful insertion
            TempData::truncate();
   
            // Return a message to user if rows are added successfully
            $this->emit('tempDataUploaded');
            $this->active = false;

            // Return a session message
            $this->notification([
                'icon' => 'success',
                'title' => 'Promodisers imported!',
                'description' => $dataCount . ' promodisers were imported succesfully.'
            ]);
            if($failedData->count() > 0) {
            $this->notification([
                'icon' => 'warning',
                'title' => 'Some Pormodiser failed!',
                'description' => $failedData->count() . 'promodisers were not imported.'
            ]);

            }
            
            
            
            $this->notification([
                'icon' => 'warning',
                'title' => 'Some Pormodiser failed!',
                'description' => $failedData->count() . ' promodisers were not imported.'
            ]);

        } catch (\Exception $e) {
            DB::rollback();

            $this->addError('temp_data', $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.promodisers.import');
    }
}
