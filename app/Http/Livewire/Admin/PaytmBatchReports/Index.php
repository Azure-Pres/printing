<?php

namespace App\Http\Livewire\Admin\PaytmBatchReports;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.admin.paytm-batch-reports.index')->layout('layouts.app');
    }
}
