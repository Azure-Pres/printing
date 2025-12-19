<?php

use Illuminate\Support\Facades\Route;

Route::get('/', App\Http\Livewire\Dispatch\Report\Index::class)->name('dispatch');