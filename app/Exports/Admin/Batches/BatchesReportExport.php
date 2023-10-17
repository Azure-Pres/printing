<?php

namespace App\Exports\Admin\Batches;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class BatchesReportExport implements FromView
{
    public function __construct($batches){
        $this->batches = $batches;
    }

    public function view(): View
    {
        return view('livewire.admin.exports.batches-reports',['batches'=>$this->batches]);
    }
}
