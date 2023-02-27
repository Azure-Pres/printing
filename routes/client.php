<?php

use Illuminate\Support\Facades\Route;

Route::get('/', App\Http\Livewire\Client\Dashboard\Home::class)->name('client');
Route::get('/change-password', App\Http\Livewire\Client\Profile\ChangePassword::class);

//Profile related route
Route::group(['prefix' => 'profile'], function() {
	Route::get('/update', App\Http\Livewire\Client\Profile\Update::class)->name('client-update-profile');
});