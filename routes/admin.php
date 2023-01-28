<?php

use Illuminate\Support\Facades\Route;

Route::get('/', App\Http\Livewire\Admin\Dashboard\Home::class)->name('admin');
