<?php

namespace App\Http\Controllers;

use App\Models\Storelocation;
use Illuminate\Http\Request;

class StoreDropdownController extends Controller
{
    public function index()
    {
        $Storelocation = Storelocation::all();
        return view('dropdown',compact('Storelocation'));

    }
    public function destroy()
    {
        //
    }
    public function findStorelocation($Storelocation) 
    {

        
    }
    
}
