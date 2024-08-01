<?php

namespace App\Exports\Report;

use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\PaytmBatchPrint;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class BatchScanExport implements FromQuery, WithHeadings
{
    protected $selectedIds;

    public function __construct($selectedIds)
    {
        $this->selectedIds = is_array($selectedIds) ? array_flatten($selectedIds) : $selectedIds;
    }

    public function query()
    {
        return PaytmBatchPrint::query()->whereIn('id', $this->selectedIds);
    }

    public function headings(): array
    {
        return [
            'Batch Name',
            'Printing Material',
            'Scanned At',
        ];
    }
}