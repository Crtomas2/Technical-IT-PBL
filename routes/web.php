<?php


use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App\Models\Store;
use App\Http\Controllers\FileUpload;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PromodiserController;
use App\Http\Livewire\PromodisersComponent;
use App\Models\Promodisers;
use App\Models\Storelocation;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


//Route::post('/promodiserAdd', [App\Http\Controllers\promodiserController::class, 'Index'])->name('promodiserAdd');


//Promodiser Form
//Route::resource('/promodisers', PromodiserController::class);

//Route::resource('tasks', App\Http\TaskController::class);

Route::get('/upload-file', [FileUpload::class, 'createForm']);
Route::post('/upload-file', [FileUpload::class, 'fileUpload'])->name('fileUpload');

//Drop-down Option
Route::get('/', function () {
    $Store = App\Models\Store::all();
    return view('dropdown',['Store' => $Store]);
});
Route::get('getStorelocation/{Storelocations}', function ($Storelocations) {
    // return response()->json(App\Models\Storelocation::all());
    $Storelocations = App\Models\Storelocation::where('id',$Storelocations)->get();
    return response()->json(['locations' => $Storelocations]);
});
Route::get('getLocationCode/{LocationCode}', function ($LocationCode) {
    // return response()->json(App\Models\LocationCode::all());
    $LocationCode = App\Models\LocationCode::where('id',$LocationCode)->get();
    return response()->json(['locationcode' => $LocationCode]);
});
Route::get('getStoreGroup/{StoreGroup}', function ($StoreGroup) {
    // return response()->json(App\Models\LocationCode::all());
    $StoreGroup = App\Models\Storegroup::where('id',$StoreGroup)->get();
    return response()->json(['Group' => $StoreGroup]);
});
//ending//


//Version 2 promodiserform
Route::get('promodisers', PromodisersComponent::class);


