<?php

namespace App\Http\Livewire\Admin\Tables;

use App\Models\UserLog;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class UserLogsTable extends DataTableComponent
{
    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function builder(): Builder
    {
        return UserLog::where('id','!=', '');
    }

    public function columns(): array
    {
        return [
            Column::make('User Id')
            ->sortable(),
            Column::make('Event','action')
            ->sortable(),
            Column::make('Datetime','created_at')
            ->sortable(),
            Column::make('Description')->format(function ($description, $row) {
                $description = json_decode($description,true);
                if ($description) {
                    return implode(', ', $description);
                }
                return '-';
            }),
            // Column::make('Actions')
            // ->label(function($row, Column $column) {
            //     return view('livewire.admin.userlogs.actions')->withData($row);
            // }),
        ];
    }
}
