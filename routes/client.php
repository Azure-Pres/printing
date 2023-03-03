<?php

use Illuminate\Support\Facades\Route;

Route::get('/', App\Http\Livewire\Client\Dashboard\Home::class)->name('client');
Route::get('/change-password', App\Http\Livewire\Client\Profile\ChangePassword::class);

//Profile related route
Route::group(['prefix' => 'profile'], function() {
	Route::get('/update', App\Http\Livewire\Client\Profile\Update::class)->name('client-update-profile');
});

//Upload data related route
Route::group(['prefix' => 'upload-data'], function() {
	Route::get('/', App\Http\Livewire\Client\UploadData\Home::class)->name('client-upload-data');
	Route::get('/upload', App\Http\Livewire\Client\UploadData\Upload::class)->name('client-upload-data-upload');
	Route::get('/{id}/details', App\Http\Livewire\Client\UploadData\Detail::class)->name('client-upload-data-details');
});

//Codes related route
Route::group(['prefix' => 'codes'], function() {
	Route::get('/', App\Http\Livewire\Client\Codes\Home::class)->name('client-codes');
	Route::get('/view/{id}', App\Http\Livewire\Client\Codes\View::class)->name('client-view-codes');	
});