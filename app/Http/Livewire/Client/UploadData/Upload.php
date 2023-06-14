<?php

namespace App\Http\Livewire\Client\UploadData;

use App\Exports\Client\Samples\UploadSample;
use App\Imports\Client\UploadData\Upload as UploadCode;
use App\Jobs\ImportJob;
use App\Models\ClientUpload;
use Auth;
use Excel;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Artisan;

class Upload extends Component
{
    use WithFileUploads;

    public $file;
    public $batchId;
    public $importFilePath;

    public function __construct()
    {
        // Artisan::call('queue:restart');
    }

    public function render()
    {
        return view('livewire.client.upload-data.upload')->layout('layouts.client');
    }

    public function modify()
    {
        $this->validate();

        $progress_id = uniqid();

        $this->importFilePath = $this->file->store('imports');
        $client_upload = new ClientUpload;
        $client_upload->client_id  = Auth::id();
        $client_upload->file_url   = $this->importFilePath;
        $client_upload->file_name  = $this->file->getClientOriginalName();
        $client_upload->progress_id= $progress_id;
        $client_upload->status     = '0';
        $client_upload->save();

        $data = [
            'client_id'   => Auth::id(),
            'progress_id' => $progress_id,
            'file_path'   => $this->importFilePath 
        ];

        $batch = Bus::batch([
            new ImportJob($data),
        ])->dispatch();

        $this->batchId = $batch->id;
        session()->flash('message', 'Upload progress started. Please check table for the progress.');
        
        userlog('Code','Code Uploaded');
        return redirect('client/upload-data');
    }

    public function rules(){
        return [
            'file'       => getRule('excel',true)
        ];
    }

    public function sample()
    {
        return Excel::download(new UploadSample(), 'upload-data-sample.xlsx');
    }

    public function getImportBatchProperty()
    {
        if (!$this->batchId) {
            return null;
        }

        return Bus::findBatch($this->batchId);
    }

    public function updateImportProgress()
    {
        $this->importFinished = $this->importBatch->finished();

        if ($this->importFinished) {
            Storage::delete($this->importFilePath);
            $this->importing = false;
        }
    }
}
