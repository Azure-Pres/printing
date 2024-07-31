<?php

namespace App\Http\Livewire\Report\Tables;

use App\Models\PaytmBatchPrint
;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;

class BatchScanTable extends DataTableComponent
{
    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function builder(): Builder
    {
        return PaytmBatchPrint::where('id','!=', '');
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

            // Printing Material filter
            SelectFilter::make('Printing Material', 'printing_material')
            ->options(PaytmBatchPrint::distinct()->pluck('printing_material', 'printing_material')->toArray())
            ->filter(function (Builder $builder, $value) {
                if ($value) {
                    $builder->where('printing_material', $value);
                }
            }),

            //Verified Filter
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
            Column::make('Id'),
            Column::make('Batch Name')->searchable(),
            Column::make('Printing Material')->searchable(),
            Column::make('Scanned At','updated_at')->searchable(),
        ];
    }
}