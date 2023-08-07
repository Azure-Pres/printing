<?php

namespace App\Http\Livewire\Admin\Tables;

use App\Models\ClientUpload;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class ClientUploadsTable extends DataTableComponent
{
    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setRefreshTime(2000);
    }

    public function builder(): Builder
    {
        return ClientUpload::orderBy('created_at','DESC');
    }

    public function filters(): array
    {
        $clients = User::where('type','Client')->get();
        $client_options = [];

        foreach ($clients as $key => $client) {
            $client_options[$client->id] = $client->name;
        }

        return [
            SelectFilter::make('Client','client_id')
            ->options($client_options)
            ->filter(function(Builder $builder, string $value) {
                $builder->where('client_id', $value);
            }),
        ];
    }

    public function columns(): array
    {
        return [
            Column::make('id')->hideIf(true),
            Column::make('File Name','file_name'),
            Column::make('Client','client_id')
            ->sortable()->format(
                fn($value, $row, Column $column) => $row->getClient->name??'-'
            ),
            Column::make('Printing Material','printing_material')
            ->sortable(),
            Column::make('Processed Rows','processed_rows')
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
