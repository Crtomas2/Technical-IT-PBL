<?php

namespace App\Http\Controllers;

use App\Models\NewTable;
use App\Models\TempData;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;

class FileUploadController extends Controller
{
    public function index () {
        return view('file.test-upload');
    }

    public function upload (Request $request) {
        try {
            // Validate if file uploaded has mime type of csv, xlsx, or xls
            $request->validate([
                'file' => ['required', 'max:2048', 'mimes:csv,xlsx,xls']
            ]);
            
            // Delete all rows on the temp_data table
            TempData::truncate();

            // Insert new rows to the 'temp_data' table
            $collection = (new FastExcel())->import($request->file, function ($line) {
                return TempData::create([
                    'first_name' => $line['Firstname'],
                    'last_name' => $line['Lastname']
                ]);
            });

            // Get all rows from the 'temp_data' table
            $temp_data = TempData::all();

            // Return a session message
            return redirect()->route('test-upload')
                ->with('collection', $temp_data);

        } catch (\Exception $e) {
            // Return an error
            return redirect()->back()->withErrors([
                'file' => $e->getMessage()
            ]);
        }
    }

    public function view ()
    {
        // Redirect user if routed here
        return redirect()->route('test-upload')
            ->with('message', 'You must upload a file first.')
            ->with('status', 'warning');
    }

    public function store (Request $request)
    {
        /**
         * TODO: Create an algorithm that will store the
         * data from 'temp_data' table to another specific table
         */
        $temp_data = TempData::get();

        foreach($temp_data as $row) {
             $new_data = NewTable::insert([
                 'firstname' => $row->first_name,
                 'last_name' => $row->last_name
             ]);
        }

        // Get the count of rows in the 'temp_data' table
        $temp_data_count = $temp_data->count();

        // Remove the current data on 'temp_data' table after successful insertion
        TempData::truncate();

        // Return a message to user if rows are added successfully
        return redirect()->route('test-upload')
            ->with('message', $temp_data_count . ' rows were added successfully.')
            ->with('status', 'success');
    }
        
}
