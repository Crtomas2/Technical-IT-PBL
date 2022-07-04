<?php

namespace App\Http\Controllers;

use App\Models\NewTable;
use App\Models\TempData;
use App\Jobs\FileUploadJob;
use Illuminate\Http\Request;
use App\Models\StoreTempData;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\StoreFile;
use Rap2hpoutre\FastExcel\FastExcel;

class StoreFileController extends Controller
{
    public function index () {
        $storetemp_data = StoreTempData::paginate(10);

        return view('file.stores-upload', compact('storetemp_data'));
    }

    public function upload (Request $request) {
        try {
            // Validate if file uploaded has mime type of csv, xlsx, or xls
            $request->validate([
                'file' => ['required', 'max:20480', 'mimes:csv,xlsx,xls']
            ]);
            
            // Delete all rows on the temp_data table
            // TempData::truncate();

            // Insert new rows to the 'temp_data' table
            $collection = (new FastExcel())->import($request->file, function ($line) {
                return StoreTempData::create([
                    'storename' => $line['storename'],
                    'storelocation' => $line['storelocation'],
                    'location_code' =>$line['location_code'],
                    'store_group' =>$line['store_group'],

                ]);
            });

            // Get all rows from the 'storetemp_data' table
            $storetemp_data = StoreTempData::all();

            // Return a session message
            session()->flash('flash.banner', 'Data imported successfully.');
            session()->flash('flash.bannerStyle', 'success');

            return redirect()->back();

        } catch (\Exception $e) {
            // Return an error
            return redirect()->back()->withErrors([
                'file' => $e->getMessage()
            ]);
        }
    }

    public function view ()
    {
        session()->flash('flash.banner', 'You must upload a file first.');
        session()->flash('flash.bannerStyle', 'danger');

        // Redirect user if routed here
        return redirect()->route('stores-upload.index');
    }

    public function store (Request $request)
    {
        /**
         * TODO: Create an algorithm that will store the
         * data from 'temp_data' table to another specific table
         */
        $storetemp_data = StoreTempData::get();

        $chunkSize = 20;

        try {
            DB::beginTransaction();

            if($storetemp_data->count() >= $chunkSize) {
                foreach($storetemp_data ->chunk($chunkSize) as $chunk) {
                    // dd(true, $chunk);
                    foreach($chunk as $row) {
                        // dd($row);
                        StoreFile::insert([
                            'storename' => $row->storename,
                            'storelocation' => $row->storelocation,
                            'location_code'=>$row->location_code,
                            'store_group'=>$row->store_group,
                        ]);
                        // dispatch(new FileUploadJob($row));
                    }
                }
            } else {
                foreach($storetemp_data as $row) {
                    //dd('else', $row);
                    StoreFile::insert([
                        'storename' => $row->storename,
                        'storelocation' => $row->storelocation,
                        'location_code'=>$row->location_code,
                        'store_group'=>$row->store_group,
                    ]);
                }
            }
            
            DB::commit();
   
           // Get the count of rows in the 'temp_data' table
           $storetemp_data_count = $storetemp_data->count();

   
           // Remove the current data on 'temp_data' table after successful insertion
            StoreTempData::truncate();
   
           // Return a message to user if rows are added successfully
           session()->flash('flash.banner',$storetemp_data_count . ' rows were added successfully.');
           session()->flash('flash.bannerStyle', 'success');

           return redirect()->route('stores-upload.index');
        } catch (\Exception $e) {
            DB::rollback();

            session()->flash('flash.banner', $e->getMessage());
            session()->flash('flash.bannerStyle', 'danger');

            return redirect()->route('stores-upload.index');
        }
        
    }
}
