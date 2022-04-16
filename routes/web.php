<?php

use App\Http\Controllers\PromodiserController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

use function GuzzleHttp\Promise\task;

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

Route::resource('/promodisers', PromodiserController::class);

Route::resource('tasks', [App\Http\ControllersTaskController::class]);