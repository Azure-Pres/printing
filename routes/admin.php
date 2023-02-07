<?php

use Illuminate\Support\Facades\Route;

Route::get('/', App\Http\Livewire\Admin\Dashboard\Home::class)->name('admin');

//Users related route
Route::group(['prefix' => 'users'], function() {
	Route::get('/', App\Http\Livewire\Admin\Users\Home::class)->name('admin-users');
	Route::get('/create', App\Http\Livewire\Admin\Users\Create::class)->name('admin-create-users');
	Route::get('/update/{d}', App\Http\Livewire\Admin\Users\Update::class)->name('admin-update-users');
});
//End Users related route

