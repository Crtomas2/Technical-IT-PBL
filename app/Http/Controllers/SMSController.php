<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SMSApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SMSController extends Controller
{
    //

    public function index(Request $request)
    {
        $smsApi = SMSAPI::all();

        if($request->acceptsJson() && $request->expectsJson()) {
            return $smsApi;
        }

        return view('ess-api.index', compact('smsApi'));
       
        //return response()->json(SMSApi::all(),200);
    }

    public function show(SMSApi $smsapi)
    {
        //return SMSApi::find();
        return $smsapi;

        // $smsapi = SMSApi::all();
    }

    public function create(Request $request)
    {
        try {
            $data = $request->all();

            DB::beginTransaction();

            $newData = SMSApi::create([
                'barcode_number' => $data['barcode_number'],
                // 'Store_name' =>$data['Store_name'],
                // 'Fullname' =>$data['Fullname'],
            ]);

            DB::commit();
    
            if($request->wantsJson()) {
                return response()->json([
                    'data' => $newData
                ]);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            if($request->wantsJson()) {
                return response()->json([
                    'message' => 'Failed to create data'
                ]);
            }
        }
        
    }

    public function store(Request $request)
    {
       $smsapi = SMSApi::save();

       return response()->json($request,201);
    }
       
}

