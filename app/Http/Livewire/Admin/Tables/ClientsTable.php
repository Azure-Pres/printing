<?php

namespace App\Http\Livewire\Admin\Tables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class ClientsTable extends DataTableComponent
{
    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function builder(): Builder
    {
        return User::where('type','=', 'Client');
    }

    public function columns(): array
    {
        return [
            Column::make('Id')
            ->sortable(),
            Column::make('Name')
            ->sortable(),
            Column::make('Email')
            ->sortable(),
            Column::make('Type')
            ->sortable(),
            Column::make('Actions')
            ->label(function($row, Column $column) {
                return view('livewire.admin.users.actions')->withUser($row);
            }),
        ];
    }
}
