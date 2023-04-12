<?php

namespace App\Http\Livewire\Admin\Tables;

use App\Models\Batch;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class BatchesTable extends DataTableComponent
{
    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function builder(): Builder
    {
        return Batch::where('id','!=', '');
    }

    public function columns(): array
    {
        return [
            Column::make('Batch Code')
            ->sortable(),
            Column::make('Client','client')
            ->sortable()->format(
                fn($value, $row, Column $column) => $row->getClient->name??"NA"
            ),
            Column::make('From Serial Number')
            ->sortable(),
            Column::make('To Serial Number')
            ->sortable(),
            Column::make('Status')
            ->sortable(),
            Column::make('Actions','id')
            ->format(function($value, $row, Column $column) {
                return view('livewire.admin.batches.actions')->withBatch($row);
            }),
        ];
    }
}
