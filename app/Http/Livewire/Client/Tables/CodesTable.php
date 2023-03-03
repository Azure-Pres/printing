<?php

namespace App\Http\Livewire\Client\Tables;

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
            ->sortable(),
            Column::make('Code Data')
            ->sortable(),
            Column::make('Status')
            ->sortable(),
            Column::make('Actions')
            ->label(function($row, Column $column) {
                return view('livewire.client.codes.actions')->withCode($row);
            }),
        ];
    }
}
