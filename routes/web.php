<?php


use App\Models\Promodisers;
use Illuminate\Http\Request;
use App\Models\Storelocation;

use Illuminate\Routing\Controller;
use App\Http\Controllers\FileUpload;
use App\Http\Livewire\StoreDropdown;
use App\Http\Livewire\StoreComponent;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\StoresComponent;
use App\Http\Controllers\StoreController;
use App\Http\Livewire\PromodisersComponent;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\SMSController;
use Illuminate\Support\Facades\App\Models\Store;
use App\Http\Controllers\Store\PromodisersController;
use App\Models\SMSApi;



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


//Version 2 promodiserform
Route::get('promodisers', PromodisersComponent::class);


//Drop-down Option
// Route::get('/', function () {
//     $Store = App\Models\Store::all();
//     return view('dropdown',['Store' => $Store]);
// });

Route::group(['prefix' => 'stores'], function () {
    Route::get('/', [StoreController::class, 'index'])->name('store.index');
    Route::view('create', 'store.create')->name('store.create');
    Route::get('{store}/edit', [StoreController::class, 'edit'])->name('store.edit');
    Route::get('{store}', [PromodisersController::class])->name('');
    Route::get('{store}/view', [StoreController::class,'view'])->name('store.view');
});

// localhost:8000/store/1/promodisers

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

Route::group(['layout' => 'layouts.base', 'section' => 'body'], function () {
    //
Route::get('promodisers', PromodisersComponent::class)->name('promodisers');
});



//Route::get('promodisers', PromodisersComponent::class)->name('promodisers');

Route::view('test-upload', 'file.test-upload')->name('test-upload');
Route::post('test-upload', [FileUploadController::class, 'upload'])->name('test-upload.upload');
Route::get('test-upload/store', [FileUploadController::class, 'view']);
Route::post('test-upload/store', [FileUploadController::class, 'store'])->name('test-upload.store');



//Route::post('test-upload/store', [FileUploadController::class, 'store'])->name('test-upload.store');


//Api Routes
Route::get('/token',function(){
    return csrf_token();
});
// Route::get('EssAPI', function(){
//     //return SMSApi::all();
//     //  return view('EssAPI');

// });

Route::get('EssAPI', [SMSController::class, 'index']);

Route::get('EssAPI/{id}', function($id) {
    return SMSApi::find($id);
});
 Route::post('EssAPI/create', function(Request $request) {
     //return SMSApi::create($request->all);
     $data = $request->all();
         return SMSApi::create([
            'barcode_number' => $data['barcode_number'],
        ]);
 });

