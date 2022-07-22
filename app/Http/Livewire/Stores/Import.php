<?php

namespace App\Http\Livewire\Stores;

use App\Models\Store;
use Livewire\Component;
use App\Models\StoreFile;
use App\Models\StoreItem;
use App\Models\Storegroup;
use App\Jobs\FileUploadJob;
use App\Models\LocationCode;
use App\Models\Storelocation;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Rap2hpoutre\FastExcel\FastExcel;
use WireUi\Traits\Actions;
use App\Models\StoreTempData as TempData;

class Import extends Component
{
    use WithFileUploads, Actions;

    public bool $active;

    public $file;

    protected $listeners = [
        'toggleImport' => 'toggleImport'
    ];

    public function toggleImport($value)
    {
        $this->active = $value;
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
                    'storename' => $line['storename'],
                    'storelocation' => $line['storelocation'],
                    'location_code' => $line['location_code'],
                    'store_group' => $line['store_group'],
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
        $tempData = TempData::get();

        $chunkSize = 20;

        try {
            DB::beginTransaction();

            $failedData = collect();
            if($tempData->count() >= $chunkSize) {
                foreach($tempData->chunk($chunkSize) as $chunk) {
                    foreach($chunk as $row) {
                        // dd($row);
                        try {
                            $store = StoreItem::create([
                                'store_id' => Store::firstWhere('Storename', $row->storename)->id,
                                'storelocation_id' => Storelocation::firstWhere('Storelocations', $row->storelocation)->id,
                                'locationcode_id' => LocationCode::firstWhere('LocationCode', $row->location_code)->id,
                                'storegroup_id' => Storegroup::firstWhere('StoreGroup', $row->store_group)->id,
                            ]);
                        } catch(\Exception $e) {
                           $failedData->push($row);
                        }
                       

                        // dd($store);
                        // dispatch(new FileUploadJob($row));
                    }
                }
                // dd($failedData);
            } else {
                foreach($tempData as $row) {
                    //dd('else', $row);
                    try {
                        $store = StoreItem::create([
                            'store_id' => Store::firstWhere('Storename', $row->storename)->id,
                            'storelocation_id' => Storelocation::firstWhere('Storelocations', $row->storelocation)->id,
                            'locationcode_id' => LocationCode::firstWhere('LocationCode', $row->location_code)->id,
                            'storegroup_id' => Storegroup::firstWhere('StoreGroup', $row->store_group)->id,
                        ]);
                    } catch(\Exception $e) {
                        $failedData->push($row);
                    }                 
                }
            }
            
            DB::commit();
   
            // Get the count of rows in the 'temp_data' table
            $dataCount = $tempData->count();

            // Remove the current data on 'temp_data' table after successful insertion
            TempData::truncate();
   
            // Return a message to user if rows are added successfully
            $this->emit('tempDataUploaded');
            $this->active = false;

            // Return a session message
            $this->notification([
                'icon' => 'success',
                'title' => 'Stores imported!',
                'description' => $dataCount . ' stores were imported succesfully.'
            ]);
             if($failedData->count() > 0) {
                $this->notification([
                    'icon' => 'warning',
                    'title' => 'Some stores failed',
                    'description' => $failedData->count() . ' stores were not imported.'
                ]);
             }

            

        } catch (\Exception $e) {
            DB::rollback();

            dd($e);

            $this->addError('temp_data', $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.stores.import');
    }
}
