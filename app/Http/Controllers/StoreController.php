<?php

namespace App\Http\Controllers;

use App\Models\StoreItem;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index () 
    {
        $stores = StoreItem::get();

        // dd($stores);

        return view('store.index', compact('stores'));
    }

    public function edit (StoreItem $store)
    {
        return view('store.edit', compact('store'));
    }
    
}
