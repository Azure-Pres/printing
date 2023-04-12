<?php

namespace App\Http\Livewire\Admin\Tables;

use App\Models\Code;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class CodesTable extends DataTableComponent
{

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function builder(): Builder
    {
        return Code::where('id','!=', '');
    }

    public function columns(): array
    {
        return [
            Column::make('Client','client_id')
            ->sortable()->format(
                fn($value, $row, Column $column) => $row->getClient->name??'-'
            ),
            Column::make('Serial No')
            ->sortable(),
            Column::make('Batch','batch_id')
            ->sortable()->format(
                fn($value, $row, Column $column) => $row->getBatch->batch_code??'-'
            ),
            Column::make('Status')
            ->sortable()->format(
                fn($value, $row, Column $column) => $row->status??'New Uploaded'
            ),
            Column::make('Actions','id')
            ->format(function($value, $row, Column $column) {
                return view('livewire.admin.codes.actions')->withCode($row);
            }),
        ];
    }
}
