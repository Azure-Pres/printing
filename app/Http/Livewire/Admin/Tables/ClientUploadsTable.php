<?php

namespace App\Http\Livewire\Admin\Tables;

use App\Models\ClientUpload;
use App\Models\User;
use App\Models\Code;
use App\Models\PaytmBatchPrint;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use DB;

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
            ->sortable()->searchable(),
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

    public function addBatch($id)
    {
        $codes = Code::where('upload_id', $id)->get();

        $distinctBatchData = DB::table('codes')
        ->selectRaw("JSON_VALUE(code_data, '$.batch_id') as batch_id, 
         JSON_VALUE(code_data, '$.material_name') as printing_material")
        ->where('upload_id', $id)
        ->whereNotNull(DB::raw("JSON_VALUE(code_data, '$.batch_id')"))
        ->distinct()
        ->get();

        $batchSize = 500;
        $data = [];

        foreach ($distinctBatchData as $batchData)
        {
            $exists = DB::table('paytm_batch_prints')->where('batch_name', $batchData->batch_id)->where('printing_material', $batchData->printing_material)->exists();

            if (!$exists)
            {
                $data[] = [
                    'batch_name' => $batchData->batch_id,
                    'printing_material' => $batchData->printing_material,
                    'verified' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            else
            {
                $this->dispatchBrowserEvent('messageTriggered', 
                    [
                        'success' => false,
                        'message' =>'Duplicate batch found.Process aborted'
                    ]
                );
            }

            if (count($data) == $batchSize)
            {
                DB::table('paytm_batch_prints')->insert($data);
                $data = [];
            }
        }

        if (count($data) > 0) {
            DB::table('paytm_batch_prints')->insert($data);
        }

        $this->dispatchBrowserEvent('messageTriggered', 
            [
                'success' => true,
                'message' =>'File updated successfully.'
            ]
        );
    }
}