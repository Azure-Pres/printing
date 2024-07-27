<?php

namespace App\Http\Livewire\Admin\Tables;

use App\Models\PaytmBatchPrints;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class PaytmBatchePrintsTable extends DataTableComponent
{
    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function builder(): Builder
    {
        return PaytmBatchPrints::where('id','!=', '');
    }

    public function filters(): array
    {
        // $clients = User::where('type','Client')->get();
        // $client_options = [];

        // foreach ($clients as $key => $client) {
        //     $client_options[$client->id] = $client->name;
        // }

        // return [
        //     SelectFilter::make('Client','client')
        //     ->options($client_options)
        //     ->filter(function(Builder $builder, string $value) {
        //         $builder->where('client', $value);
        //     }),
        // ];
    }

    public function columns(): array
    {
        return [
            Column::make('Batch Name')
            ->sortable(),
            Column::make('Printing Material')
            ->sortable(),
            Column::make('Actions','id')
            ->format(function($value, $row, Column $column) {
                return view('livewire.admin.paytm+batch_prints.actions')->withPaytmBatchPrint($row);
            }),
        ];
    }
}
