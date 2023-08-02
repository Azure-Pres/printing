<?php

namespace App\Http\Livewire\Client\Tables;

use App\Models\ClientUpload;
use App\Models\Code;
use App\Models\TempCode;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Auth;

class UploadHistoryTable extends DataTableComponent
{   
    public $deleteId = '';

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setRefreshTime(2000);
        $this->setConfigurableAreas([
            'toolbar-right-end' => 'livewire.client.upload-data.delete-modal'
        ]);
    }

    public function builder(): Builder
    {
        return ClientUpload::where('client_id', Auth::id())->orderBy('created_at','DESC');
    }

    public function columns(): array
    {
        return [
            Column::make('id')->hideIf(true),
            Column::make('File Name','file_name'),
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

    public function deleteId($id)
    {
        $this->deleteId = $id;
    }

    public function cancel()
    {
        $clear = TempCode::where('upload_id',$this->deleteId)->delete();
        $delete = Code::where('client_id',Auth::id())->where('upload_id',$this->deleteId)->delete();
        $progress = ClientUpload::where('client_id',Auth::id())->where('id',$this->deleteId)->first();
        
        if($progress){
            $progress->status = '3';
            $progress->save();
        }

        return redirect('client/upload-data');
    }
}
