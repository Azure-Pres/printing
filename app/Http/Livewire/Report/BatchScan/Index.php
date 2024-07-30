<?php

namespace App\Http\Livewire\Report\BatchScan;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.report.batch-scan.index')->layout('layouts.report');
    }
}
