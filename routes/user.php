<?php

use Illuminate\Support\Facades\Route;

Route::get('/scan', App\Http\Livewire\User\Scan\Index::class)->name('user');