<?php

namespace App\Http\Livewire\Client\Tables;

use App\Models\ClientUpload;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Auth;

class UploadHistoryTable extends DataTableComponent
{   
    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function builder(): Builder
    {
        return ClientUpload::where('client_id', Auth::id())->orderBy('created_at','DESC');
    }

    public function columns(): array
    {
        return [
            Column::make('id')->hideIf(true),
            Column::make('Progress Id','progress_id')
            ->sortable(),
            Column::make('Date','created_at')
            ->sortable(),
            Column::make('Processed Rows','processed_rows')
            ->sortable(),
            Column::make('Status')
            ->sortable()->format(
                fn($value, $row, Column $column) => uploadStatusText($row->status)
            ),
            Column::make('Actions')
            ->label(function($row, Column $column) {
                return view('livewire.client.upload-data.actions')->withData($row);
            }),
        ];
    }
}
