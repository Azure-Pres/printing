<?php

namespace App\Http\Livewire\Report\BatchScan;

use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Report\BatchScanExport;
use App\Models\PaytmBatchPrint;

class Index extends Component
{
    public $selectedIds = [];

    protected $listeners = [
        'export' => 'exportSelected',
        'updateSelected' => 'updateSelectedIds'
    ];

    public function updateSelectedIds($selectedIds)
    {
        $this->selectedIds = $selectedIds;
    }

    public function exportSelected()
    {
        $selectedIds = $this->getSelected();

        if (!empty($selectedIds)) {
            return Excel::download(new BatchScanExport($selectedIds), 'batch-scan-export.xlsx');
        }
    }

    private function hasFilters()
    {
        return !empty($this->filters);
    }

    private function filteredData()
    {
        $query = PaytmBatchPrint::query();

        foreach ($this->filters as $filter) 
        {
            $filter->apply($query, $this->getFilter($filter->getKey()));
        }

        return $query->get();
    }

    public function render()
    {
        return view('livewire.report.batch-scan.index')->layout('layouts.report');
    }
}