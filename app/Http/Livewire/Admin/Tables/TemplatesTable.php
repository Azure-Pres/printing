<?php

namespace App\Http\Livewire\Admin\Tables;

use Livewire\Component;
use App\Models\Template;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class TemplatesTable extends DataTableComponent
{
    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function builder(): Builder
    {
        return Template::where('id','!=', '');
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
            Column::make('Name')
            ->sortable(),
            Column::make('Client','client_id')
            ->sortable()->format(
                fn($value, $row, Column $column) => $row->getClient->name??"NA"
            ),
            Column::make('Status')
            ->sortable(),
            Column::make('Actions','id')
            ->format(function($value, $row, Column $column) {
                return view('livewire.admin.templates.actions')->withTemplate($row);
            }),
        ];
    }
}
