<?php

namespace App\Http\Livewire\Admin\Tables;

use App\Models\BatchPrint;
use App\Models\ClientUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class BatchReportsTable extends DataTableComponent
{
    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function builder(): Builder
    {
        return BatchPrint::query();
    }

    public function columns(): array
    {
        return [
            Column::make('Batch Name', 'batch')->searchable()
        ];
    }
}