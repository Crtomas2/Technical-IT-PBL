<?php

namespace App\Http\Controllers;

use App\Models\Promodiser;
use Illuminate\Http\Request;

class PromodiserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promodiser = Promodiser::all();
        return view('index',compact('promodiser'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $storeData = $request->validate([
            'Firstname' => 'required|max:255',
            'Middlename' => 'required|max:255',
            'lastname' => 'required|max:255',
            'mobilenumber' => 'required|numeric',
            'Storename' => 'required|max:255',
            'Storelocation' => 'required|max:255',
            'LocationCode' => 'required|max:255',
            'StoreGroup' => 'required|max:255',
        ]);
        $promodiser = Promodiser::create($storeData);
        return redirect('/promodisers')->with('completed', 'Record has been saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $promodiser = Promodiser::findOrFail($id);
        return view('edit', compact('promodiser'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $updateData = $request->validate([
            'Firstname' => 'required|max:255',
            'Middlename' => 'required|max:255',
            'lastname' => 'required|max:255',
            'mobilenumber' => 'required|numeric',
            'Storename' => 'required|max:255',
            'Storelocation' => 'required|max:255',
            'LocationCode' => 'required|max:255',
            'StoreGroup' => 'required|max:255',
        ]);
        $promodiser = Promodiser::create($updateData);
        return redirect('/promodisers')->with('completed', 'Record has been saved!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $promodiser = Promodiser::findOrFail($id);
        $promodiser->delete();
        return redirect('/promodisers')->with('completed', 'Record has been deleted');
    }
}
