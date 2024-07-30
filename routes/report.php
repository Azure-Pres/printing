<?php

use Illuminate\Support\Facades\Route;

Route::get('/', App\Http\Livewire\Report\BatchScan\Index::class)->name('/reports');