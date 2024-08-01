<?php

namespace App\Http\Livewire\Report\Tables;

use App\Models\PaytmBatchPrint;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use App\Exports\Report\BatchScanExport;
use Maatwebsite\Excel\Facades\Excel;

class BatchScanTable extends DataTableComponent
{
        public $selectedRows = [];

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setBulkActions([
            'exportSelected' => 'Export Selected',
        ]);
    }

    public function exportSelected()
    {
        $selectedIds = $this->getSelectedRows();

        if (!empty($selectedIds)) {
            return Excel::download(new BatchScanExport($selectedIds), 'batch-scan-export.xlsx');
        } else {
            session()->flash('error', 'No rows selected for export.');
        }
    }

    public function builder(): Builder
    {
        return PaytmBatchPrint::query();
    }

    public function filters(): array
    {
        return [
            DateFilter::make('Scanned At', 'updated_at')
            ->filter(function (Builder $builder, $value) {
                if ($value) {
                    $builder->whereDate('updated_at', '=', $value);
                }
            }),

            SelectFilter::make('Printing Material', 'printing_material')
            ->options(PaytmBatchPrint::distinct()->pluck('printing_material', 'printing_material')->toArray())
            ->filter(function (Builder $builder, $value) {
                if ($value) {
                    $builder->where('printing_material', $value);
                }
            }),

            SelectFilter::make('Verified', 'verified')
            ->options([
                '1' => 'Yes',
                '0' => 'No'
            ])
            ->filter(function (Builder $builder, $value) {
                $builder->where('verified', $value);
            }),
        ];
    }

    public function columns(): array
    {
        return [
            CheckboxColumn::make('Select'),
            Column::make('Id'),
            Column::make('Batch Name')->searchable(),
            Column::make('Printing Material')->searchable(),
            Column::make('Scanned At','updated_at')->searchable(),
        ];
    }
}