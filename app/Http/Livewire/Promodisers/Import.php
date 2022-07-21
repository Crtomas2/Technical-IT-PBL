<?php

namespace App\Http\Livewire\Promodisers;

use Livewire\Component;
use App\Models\TempData;
use App\Jobs\FileUploadJob;
use Livewire\WithFileUploads;
use App\Models\Promodisers;
use Illuminate\Support\Facades\DB;
use App\Models\Promodiser_tempdata;
use Rap2hpoutre\FastExcel\FastExcel;

class Import extends Component
{
    use WithFileUploads;

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
            TempData::truncate();

            $file = $this->file->store('imports');

            // dd(storage_path('app\\' . $file));

            // Insert new rows to the 'temp_data' table
            $collection = (new FastExcel())->import(storage_path('app\\' . $file), function ($line) {
                return Promodiser_tempdata::create([
                    'firstname' => $line['firstname'],
                    'lastname' => $line['lastname'],
                    'mobile_number' =>$line['mobile_number'],
                ]);
            });

            // Get all rows from the 'storetemp_data' table
            $promodisertemp_data = Promodiser_tempdata::all();

            // Return a session message
            session()->flash('flash.banner', 'Data imported successfully.');
            session()->flash('flash.bannerStyle', 'success');

            $this->emit('refresh');

        } catch (\Exception $e) {
            // Return an error
            $this->addError('file', $e->getMessage());
        }
    }

    public function upload()
    {
        /**
         * TODO: Create an algorithm that will store the
         * data from 'temp_data' table to another specific table
         */
        $promodisertemp_data  = Promodiser_tempdata::get();

        $chunkSize = 20;

        try {
            DB::beginTransaction();

            if($promodisertemp_data->count() >= $chunkSize) {
                foreach($promodisertemp_data->chunk($chunkSize) as $chunk) {
                    foreach($chunk as $row) {
                        // dd($row);
                        Promodisers::insert([
                            'Firstname' => $row->firstname,
                            'Lastname' => $row->lastname,
                            'Mobilenumber'=> $row->mobile_number,
                        ]);
                        // dispatch(new FileUploadJob($row));
                    }
                }
            } else {
                foreach($promodisertemp_data as $row) {
                    //dd('else', $row);
                    Promodisers::insert([
                        'Firstname' => $row->firstname,
                        'Lastname' => $row->lastname,
                        'Mobilenumber'=>$row->mobile_number,
                    ]);
                }
            }
            
            DB::commit();
   
            // Get the count of rows in the 'temp_data' table
            $promodisertemp_data_count = $promodisertemp_data->count();

    
            // Remove the current data on 'temp_data' table after successful insertion
            Promodiser_tempdata::truncate();
   
            // Return a message to user if rows are added successfully
            $this->emit('tempDataUploaded');
            $this->active = false;

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
