<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Auth\Login;

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
    return redirect('login');
});

Route::get('/qr-pdf/{id}', [App\Http\Controllers\QrPdfController::class,'index']);
Route::get('/prepare-pdf/{jobcard}/{template}', [App\Http\Controllers\QrPdfController::class,'preparePdf']);

Route::get('/login', Login::class)->name('login');
Route::get('/logout', function () {
    
    if(Auth::check())
    {
        userlog('Logout','logout');
        Auth::logout();
    }

    return Redirect::to('login');
});



// Route::get('/duplicate',[App\Http\Controllers\Api\User\ScanCodeController::class,'duplicate']);
// Route::get('/mark-success',[App\Http\Controllers\Api\User\ScanCodeController::class,'markSuccess']);
// Route::get('/serial-update',[App\Http\Controllers\Api\User\ScanCodeController::class,'serialUpdate']);
Route::get('/serial-update',[App\Http\Controllers\Api\User\ScanCodeController::class,'updateSerialNumbers']);
Route::get('/paytm-batch-add',[App\Http\Controllers\TestController::class,'importCsv']);