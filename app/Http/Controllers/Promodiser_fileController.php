<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PromodiserTable;
use App\Models\Promodiser_tempdata;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Rap2hpoutre\FastExcel\FastExcel;



class Promodiser_fileController extends Controller
{

    public function index () {
        $promodisertemp_data = Promodiser_tempdata::paginate(10);

        return view('promodisers-upload', compact('promodisertemp_data'));
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
        return redirect()->route('promodisers-upload.index');
    }

    public function store (Request $request)
    {
        /**
         * TODO: Create an algorithm that will store the
         * data from 'temp_data' table to another specific table
         */
        $promodisertemp_data  = Promodiser_tempdata::get();

        $chunkSize = 20;

        try {
            DB::beginTransaction();

            if($promodisertemp_data ->count() >= $chunkSize) {
                foreach($promodisertemp_data ->chunk($chunkSize) as $chunk) {
                    // dd(true, $chunk);
                    foreach($chunk as $row) {
                        // dd($row);
                        PromodiserTable::insert([
                            'firstname' => $row->firstname,
                            'lastname' => $row->lastname,
                            'mobile_number'=>$row->mobile_number,
                        ]);
                        // dispatch(new FileUploadJob($row));
                    }
                }
            } else {
                foreach($promodisertemp_data as $row) {
                    //dd('else', $row);
                    PromodiserTable::insert([
                        'firstname' => $row->firstname,
                        'lastname' => $row->lastname,
                        'mobile_number'=>$row->mobile_number,
                    ]);
                }
            }
            
            DB::commit();
   
           // Get the count of rows in the 'temp_data' table
           $promodisertemp_data_count = $promodisertemp_data->count();

   
           // Remove the current data on 'temp_data' table after successful insertion
          Promodiser_tempdata::truncate();
   
           // Return a message to user if rows are added successfully
           session()->flash('flash.banner', $promodisertemp_data_count . ' rows were added successfully.');
           session()->flash('flash.bannerStyle', 'success');

           return redirect()->route('promodisers-upload.index');
        } catch (\Exception $e) {
            DB::rollback();

            session()->flash('flash.banner', $e->getMessage());
            session()->flash('flash.bannerStyle', 'danger');

            return redirect()->route('promodisers-upload.index');
        }
        
    }
}
