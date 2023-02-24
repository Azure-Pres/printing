<?php

use Illuminate\Support\Facades\Route;

Route::get('/', App\Http\Livewire\Client\Dashboard\Home::class)->name('client');