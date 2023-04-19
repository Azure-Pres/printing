<?php

use Illuminate\Support\Facades\Route;

Route::get('/', App\Http\Livewire\Admin\Dashboard\Home::class)->name('admin');
Route::get('/change-password', App\Http\Livewire\Admin\Profile\ChangePassword::class);

//Profile related route
Route::group(['prefix' => 'profile'], function() {
	Route::get('/update', App\Http\Livewire\Admin\Profile\Update::class)->name('admin-update-profile');
});

//Users related route
Route::group(['prefix' => 'users'], function() {
	Route::get('/', App\Http\Livewire\Admin\Users\Home::class)->name('admin-users');
	Route::get('/create', App\Http\Livewire\Admin\Users\Create::class)->name('admin-create-users');
	Route::get('/update/{id}', App\Http\Livewire\Admin\Users\Update::class)->name('admin-update-users');
});

//Clients related route
Route::group(['prefix' => 'clients'], function() {
	Route::get('/', App\Http\Livewire\Admin\Clients\Home::class)->name('admin-clients');
	Route::get('/create', App\Http\Livewire\Admin\Clients\Create::class)->name('admin-create-clients');
	Route::get('/update/{id}', App\Http\Livewire\Admin\Clients\Update::class)->name('admin-update-clients');
});

//Batches related route
Route::group(['prefix' => 'batches'], function() {
	Route::get('/', App\Http\Livewire\Admin\Batches\Home::class)->name('admin-batches');
	Route::get('/create', App\Http\Livewire\Admin\Batches\Create::class)->name('admin-create-batches');
	Route::get('/update/{id}', App\Http\Livewire\Admin\Batches\Update::class)->name('admin-update-batches');
});

//Codes related route
Route::group(['prefix' => 'codes'], function() {
	Route::get('/', App\Http\Livewire\Admin\Codes\Home::class)->name('admin-codes');
	Route::get('/view/{id}', App\Http\Livewire\Admin\Codes\View::class)->name('admin-view-codes');	
});

//Job card related route
Route::group(['prefix' => 'job-cards'], function() {
	Route::get('/', App\Http\Livewire\Admin\JobCards\Home::class)->name('admin-job-cards');
	Route::get('/create', App\Http\Livewire\Admin\JobCards\Create::class)->name('admin-create-job-cards');
	Route::get('/update/{id}', App\Http\Livewire\Admin\JobCards\Update::class)->name('admin-update-job-cards');
});

//Client upload related route
Route::group(['prefix' => 'client-uploads'], function() {
	Route::get('/', App\Http\Livewire\Admin\ClientUploads\Home::class)->name('admin-client-uploads');
	Route::get('/view/{id}', App\Http\Livewire\Admin\ClientUploads\View::class)->name('admin-client-uploads-view');
});

//User log related route
Route::group(['prefix' => 'user-logs'], function() {
	Route::get('/', App\Http\Livewire\Admin\UserLogs\Home::class)->name('admin-user-logs');
	Route::get('/view/{id}', App\Http\Livewire\Admin\UserLogs\View::class)->name('admin-user-logs-view');
});