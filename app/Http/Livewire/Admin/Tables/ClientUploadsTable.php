<?php

namespace App\Http\Livewire\Admin\Tables;

use App\Models\ClientUpload;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class ClientUploadsTable extends DataTableComponent
{
    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function builder(): Builder
    {
        return ClientUpload::where('id','!=', '');
    }

    public function columns(): array
    {
        return [
            Column::make('id')->hideIf(true),
            
            Column::make('Client Id'),
            Column::make('Lot Number')
            ->sortable(),
            Column::make('Lot Size')
            ->sortable(),
            Column::make('Category')
            ->sortable(),
            Column::make('Status')
            ->sortable()->format(
                fn($value, $row, Column $column) => uploadStatusText($row->status)
            ),
            Column::make('Created At')
            ->sortable(),
            Column::make('Actions')
            ->label(function($row, Column $column) {
                return view('livewire.admin.clientuploads.actions')->withData($row);
            }),
        ];
    }
}
