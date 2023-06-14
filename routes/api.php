<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api as ApiRoot;
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

Route::post("login",[ApiRoot\Auth\LoginController::class,'index']);

Route::group(['middleware' => 'auth:sanctum'], function(){
    Route::post("upload-data",[ApiRoot\UploadData\UploadDataController::class,'store']);
});

Route::group(['middleware' => 'auth:sanctum'], function(){
    Route::resource("dashboard",ApiRoot\User\DashboardController::class);
    Route::resource("job-cards",ApiRoot\User\JobCardController::class);
    Route::resource("printing",ApiRoot\User\PrintingController::class);
    Route::resource("permissions",ApiRoot\User\PermissionController::class);
    Route::resource("verifications",ApiRoot\User\VerificationController::class);
    Route::resource("verifications-offline",ApiRoot\User\OfflineVerificationController::class);
    Route::post('scan-code',[ApiRoot\User\ScanCodeController::class,'index']);
    Route::get('clients',[ApiRoot\User\DashboardController::class,'clients']);
    Route::post('update-batch-print',[ApiRoot\User\ScanCodeController::class,'updateBatchPrint']);
});

Route::get('print-file/{id}',[ApiRoot\User\PrintingController::class,'download']);
