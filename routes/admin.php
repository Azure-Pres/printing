<?php

use Illuminate\Support\Facades\Route;

Route::get('/', App\Http\Livewire\Admin\Dashboard\Home::class)->name('admin');

//Users related route
Route::group(['prefix' => 'profile'], function() {
	Route::get('/update/{id}', App\Http\Livewire\Admin\Profile\Update::class)->name('admin-update-profile');
});

//Users related route
Route::group(['prefix' => 'users'], function() {
	Route::get('/', App\Http\Livewire\Admin\Users\Home::class)->name('admin-users');
	Route::get('/create', App\Http\Livewire\Admin\Users\Create::class)->name('admin-create-users');
	Route::get('/update/{id}', App\Http\Livewire\Admin\Users\Update::class)->name('admin-update-users');
});

//Users related route
Route::group(['prefix' => 'clients'], function() {
	Route::get('/', App\Http\Livewire\Admin\Clients\Home::class)->name('admin-clients');
	Route::get('/create', App\Http\Livewire\Admin\Clients\Create::class)->name('admin-create-clients');
	Route::get('/update/{id}', App\Http\Livewire\Admin\Clients\Update::class)->name('admin-update-clients');
});
//End Users related route