<?php

namespace App\Http\Livewire\Admin\Tables;

use App\Models\JobCard;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class JobCardsTable extends DataTableComponent
{
    public function configure(): void
    {   
        $this->setPrimaryKey('id');
    }

    public function builder(): Builder
    {
        return JobCard::where('id','!=', '');
    }

    public function columns(): array
    {
        return [
            Column::make('Id')
            ->sortable(),
            Column::make('Job Card Id')
            ->sortable(),
            Column::make('Status')
            ->sortable(),
            Column::make('Actions')
            ->label(function($row, Column $column) {
                return view('livewire.admin.jobcards.actions')->withJobCard($row);
            }),
        ];
    }
}