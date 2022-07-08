<?php

namespace App\Http\Controllers;

use App\Jobs\FileUploadJob;
use App\Models\NewTable;
use App\Models\TempData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Rap2hpoutre\FastExcel\FastExcel;

class FileUploadController extends Controller
{
    public function index () {
        $temp_data = TempData::paginate(10);

        return view('file.test-upload', compact('temp_data'));
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
                return TempData::create([
                    'barcode_number' => $line['barcode_number'],
                    'color' => $line['color'],
                    'size_code' =>$line['size_code'],
                    'unit_measure' =>$line['unit_measure'],
                    'barcode_class' =>$line['barcode_class'],
                ]);
            });

            // Get all rows from the 'temp_data' table
            $temp_data = TempData::all();

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
        return redirect()->route('test-upload.index');
    }

    public function store (Request $request)
    {
        /**
         * TODO: Create an algorithm that will store the
         * data from 'temp_data' table to another specific table
         */
        $temp_data = TempData::get();

        $chunkSize = 20;

        try {
            DB::beginTransaction();

            if($temp_data->count() >= $chunkSize) {
                foreach($temp_data->chunk($chunkSize) as $chunk) {
                    // dd(true, $chunk);
                    foreach($chunk as $row) {
                        // dd($row);
                        NewTable::insert([
                            'barcode_number' => $row->barcode_number,
                            'color' => $row->color,
                            'size_code'=>$row->size_code,
                            'unit_measure'=>$row->unit_measure,
                            'barcode_class'=>$row->barcode_class,

                        ]);
                        // dispatch(new FileUploadJob($row));
                    }
                }
            } else {
                foreach($temp_data as $row) {
                    //dd('else', $row);
                    NewTable::insert([
                        'barcode_number' => $row->barcode_number,
                        'color' => $row->color,
                        'size_code' => $row->size_code,
                        'unit_measure' => $row->unit_measure,
                        'barcode_class' => $row->barcode_class
                    ]);
                }
            }
            
            DB::commit();
   
           // Get the count of rows in the 'temp_data' table
           $temp_data_count = $temp_data->count();

   
           // Remove the current data on 'temp_data' table after successful insertion
           TempData::truncate();
   
           // Return a message to user if rows are added successfully
           session()->flash('flash.banner', $temp_data_count . ' rows were added successfully.');
           session()->flash('flash.bannerStyle', 'success');

           return redirect()->route('test-upload.index');
        } catch (\Exception $e) {
            DB::rollback();

            session()->flash('flash.banner', $e->getMessage());
            session()->flash('flash.bannerStyle', 'danger');

            return redirect()->route('test-upload.index');
        }
        
    }
        
}
