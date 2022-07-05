<?php

use App\Exports\ImportExportController;
use App\Http\Controllers\CsvExportController;
use App\Http\Controllers\CsvImportController;
use App\Models\SMSApi;
use App\Models\Promodisers;
use Illuminate\Http\Request;

use App\Models\Storelocation;
use App\Models\ItemMasterlists;
use Illuminate\Routing\Controller;
use App\Http\Controllers\FileUpload;
use App\Http\Livewire\StoreDropdown;
use App\Http\Livewire\StoreComponent;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\StoresComponent;
use App\Http\Controllers\SMSController;
use App\Http\Controllers\StoreController;
use App\Http\Livewire\PromodisersComponent;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\PromodiserController;
use Illuminate\Support\Facades\App\Models\Store;
use App\Http\Controllers\ItemMasterlistController;
use App\Http\Controllers\Promodiser_fileController;
use App\Http\Controllers\Store\PromodisersController;
use App\Http\Controllers\StoreFileController;

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

Route::middleware(['auth'])->group(function () {
    Route::group(['prefix' => 'stores', 'as' => 'store.'], function () {
        Route::get('/', [StoreController::class, 'index'])->name('index');
    });

    Route::group(['prefix' => 'promodisers', 'as' => 'promodisers.'], function () {
        Route::get('/', [PromodiserController::class, 'index'])->name('index');
    });

    Route::group(['prefix' => 'test-upload', 'as' => 'test-upload.'], function () {
        Route::get('/', [FileUploadController::class, 'index'])->name('index');
        Route::post('/', [FileUploadController::class, 'upload'])->name('upload');
        Route::get('store', [FileUploadController::class, 'view']);
        Route::post('store', [FileUploadController::class, 'store'])->name('store');
    });
    Route::group(['prefix' => 'stores-upload', 'as' => 'stores-upload.'], function () {
        Route::get('/', [StoreFileController::class, 'index'])->name('index');
        Route::post('/', [StoreFileController::class, 'upload'])->name('upload');
        Route::get('store', [StoreFileController::class, 'view']);
        Route::post('store', [StoreFileController::class, 'store'])->name('store');
    });
    Route::group(['prefix' => 'promodisers-upload', 'as' => 'promodisers-upload.'], function () {
        Route::get('/', [Promodiser_fileController::class, 'index'])->name('index');
        Route::post('/', [Promodiser_fileController::class, 'upload'])->name('upload');
        Route::get('store', [Promodiser_fileController::class, 'view']);
        Route::post('store', [Promodiser_fileController::class, 'store'])->name('store');
    });
    // Route::group(['prefix' => 'ess-api', 'as' => 'ess-api.'], function () {
    //     Route::get('/', [SMSController::class, 'index'])->name('index');
    //     Route::get('{smsapi}', [SMSController::class, 'show'])->name('show');
    //     Route::post('create', [SMSController::class, 'create'])->name('create');
    // });
});
    // Route::group(['prefix' => 'ess-api', 'as' => 'ess-api.'], function () {
    //     Route::get('/', [SMSController::class, 'index'])->name('index');
    //     Route::get('{smsApi}', [SMSController::class, 'show'])->name('show');
    //     Route::post('create', [SMSController::class, 'create'])->name('create');
    // });
// Route::group(['prefix' => 'ess-api', 'as' => 'ess-api.'], function () {
//     Route::get('/', [SMSController::class, 'index'])->name('index');
//     Route::get('{smsapi}', [SMSController::class, 'show'])->name('show');
//     Route::post('create', [SMSController::class, 'create'])->name('create');
// });


// Store drop-down
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
//Ending of Store drop-down


//Api Routes
Route::get('/token',function(){
    return csrf_token();
});

Route::group(['prefix' => 'ess-api', 'as' => 'ess-api.'], function () {
    Route::get('/', [SMSController::class, 'index'])->name('index');
    Route::get('{smsapi}', [SMSController::class, 'show'])->name('show');
    Route::post('create', [SMSController::class, 'create'])->name('create');
});

// Route::group(['prefix' => 'ess-api', 'as' => 'ess-api.'], function () {
//     Route::get('/', [SMSController::class, 'index'])->name('index');
//     Route::get('ess-api{smsapi}', [SMSController::class, 'show'])->name('show');
//     Route::post('create', [SMSController::class, 'create'])->name('create');
// });