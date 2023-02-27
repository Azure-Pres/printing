<?php

use Illuminate\Support\Facades\Route;

Route::get('/', App\Http\Livewire\Client\Dashboard\Home::class)->name('client');
Route::get('/change-password', App\Http\Livewire\Admin\Profile\ChangePassword::class);
