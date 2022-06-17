<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SMSApi;
use Illuminate\Http\Request;

class SMSController extends Controller
{
    //

    public function index()
    {
        $smsApi = SMSAPI::all();

        return view('ESSAPI', compact('smsApi'));
       
        //return response()->json(SMSApi::all(),200);
    }
    public function show(SMSApi $smsapi)
    {
        //return SMSApi::find();
        return $smsapi;

        $smsapi= SMSApi::all();
    }
    public function store(Request $request)
    {
       $smsapi = SMSApi::save();

       return response()->json($request,201);
    }
       
}

