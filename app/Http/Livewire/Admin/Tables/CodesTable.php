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
            Column::make('Id')
            ->sortable(),
            Column::make('Batch Id')
            ->sortable()->format(
                fn($value, $row, Column $column) => $row->batch_id??'-'
            ),
            Column::make('Status')
            ->sortable()->format(
                fn($value, $row, Column $column) => $row->status??'New Uploaded'
            ),
            Column::make('Actions')
            ->label(function($row, Column $column) {
                return view('livewire.admin.codes.actions')->withCode($row);
            }),
        ];
    }
}
