<?php

namespace App\Http\Livewire\Admin\BatchReports;

use Livewire\Component;

class Upload extends Component
{
    public function render()
    {
        return view('livewire.admin.batch-reports.upload')->layout('layouts.app');
    }
}
