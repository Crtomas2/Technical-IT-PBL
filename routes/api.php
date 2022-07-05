<?php

use App\Models\SMSApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SMSController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Api
Route::group(['prefix' => 'ess-api', 'as' => 'ess-api.'], function () {
    Route::get('/', [SMSController::class, 'index']);
    Route::get('{smsapi}', [SMSController::class, 'show']);
    Route::post('{smsapi}', [SMSController::class, 'create']);
});

Route::get('test', function () {
    return 'hi';
});

Route::post('test', function () {
    return 'hello';
});

//API gateway
//Route::get('/token',function(){
    //return csrf_token();
//});
//Route::get('EssAPI', [SMSController::class,'index'])->name('EssAPI');
//Route::get('EssAPI/{id}', [SMSController::class, 'show'])->name('EssAPI');
//Route::post('EssAPI/create', [SMSController::class,'store'])->name('EssAPI/create');



