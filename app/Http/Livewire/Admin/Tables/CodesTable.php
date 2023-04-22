<?php

namespace App\Http\Livewire\Admin\Tables;

use App\Models\Code;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

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
